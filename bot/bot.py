import telebot
from dotenv import load_dotenv
import json
import time
import os

# === Загружаем токен из переменной окружения ===
load_dotenv('/var/www/project/.env') 

TOKEN = os.getenv("TELEGRAM_TOKEN")

if not TOKEN:
    print("❌ Ошибка: TELEGRAM TOKEN не найден! Укажите его в .env и перезапустите сервер.")
    exit(1)

bot = telebot.TeleBot(TOKEN)

# Пути к файлам
STORAGE_DIR = "/var/www/project/storage"
DATA_FILE = "/var/www/project/storage/data.json"
IMAGE_DIR = "/var/www/project/public/assets/pic/user-bot"
# === Масив параметров сайта ===
DEFAULT_DATA = {"user_id": None, "title": "", "image": "", "text": "", "footer": ""}


# === Создаем папки, если их нет ===
os.makedirs(STORAGE_DIR, exist_ok=True)
os.makedirs(IMAGE_DIR, exist_ok=True)


# === Проверяем и создаем data.json, если его нет ===
if not os.path.exists(DATA_FILE):
    print(f"🔹 Файл {DATA_FILE} не найден, создаем новый...")
    with open(DATA_FILE, "w", encoding="utf-8") as file:
        json.dump(DEFAULT_DATA, file, indent=4, ensure_ascii=False)

# === Функция загрузки данных ===
def load_data():
    try:
        with open(DATA_FILE, "r", encoding="utf-8") as file:
            return json.load(file)
    except Exception as e:
        print(f"⚠ Ошибка при загрузке JSON: {e}")
        return DEFAULT_DATA

# === Функция сохранения данных ===
def save_data(new_data):
    try:
        with open(DATA_FILE, "w", encoding="utf-8") as file:
            json.dump(new_data, file, indent=4, ensure_ascii=False)
    except Exception as e:
        print(f"⚠ Ошибка при сохранении JSON: {e}")

# === Функция проверки владельца ===
def is_owner(message):
    data = load_data()
    user_id = data.get("user_id")

    # Если ID владельца не установлен — записываем первого пользователя
    if user_id is None:
        data["user_id"] = message.chat.id
        save_data(data)
        return True

    # Проверяем, совпадает ли ID с владельцем
    if user_id == message.chat.id:
        return True
    else:
        bot.send_message(message.chat.id, "🚫 Вы не владелец сайта!")
        return False


# === Стартовая команда `/start` ===
@bot.message_handler(commands=['start'])
def send_welcome(message):
    if not is_owner(message):
            return

    bot.send_message(
        message.chat.id,
        "👋 Здравствуйте! Я управляю вашим сайтом.\n\n"
        "Вы можете изменить заголовок, текст, изображение и футер сайта.\n\n"
        "📜 Для списка команд по изменению данных введите: `/help`"
    )

# === Команда `/help` ===
@bot.message_handler(commands=['help'])
def send_help(message):
    if not is_owner(message):
            return

    help_text = (
        "📜 *Список доступных команд:*\n\n"
        "🔧 *Изменение содержимого сайта:*\n"
        "`/title`  – изменить заголовок сайта\n"
        "`/text`  – изменить текст на сайте\n"
        "`/footer`  – изменить футер сайта\n"
        "`/image` – загрузить новое изображение (отправьте фото после команды)\n\n"
        "⚙ *Дополнительные команды:*\n"
        "`/setup` – запустить установщик \n"
        "`/help` – показать этот список команд\n"
    )

    bot.send_message(message.chat.id, help_text, parse_mode="Markdown")


# === Команда `/title Новый заголовок` ===
@bot.message_handler(commands=['title'])
def set_title(message):
    if not is_owner(message):
            return

    new_title = message.text.replace("/title", "").strip()
    if not new_title:
        bot.reply_to(message, "⚠️ Используйте: `/title Новый заголовок`")
        return

    data = load_data()
    data["title"] = new_title
    save_data(data)

    bot.reply_to(message, f"✅ Заголовок изменен на: *{new_title}*", parse_mode="Markdown")

# === Команда `/text Новый текст` ===
@bot.message_handler(commands=['text'])
def set_text(message):
    if not is_owner(message):
            return

    new_text = message.text.replace("/text", "").strip()
    if not new_text:
        bot.reply_to(message, "⚠️ Используйте: `/text Новый текст`")
        return

    data = load_data()
    data["text"] = new_text
    save_data(data)

    bot.reply_to(message, f"✅ Текст изменен на:\n\n_{new_text}_", parse_mode="Markdown")

# === Команда `/footer Новый футер` ===
@bot.message_handler(commands=['footer'])
def set_footer(message):
    new_footer = message.text.replace("/footer", "").strip()
    if not new_footer:
        bot.reply_to(message, "⚠️ Используйте: `/footer Новый футер`")
        return

    data = load_data()
    data["footer"] = new_footer
    save_data(data)

    bot.reply_to(message, f"✅ Футер изменен на:\n`{new_footer}`", parse_mode="Markdown")

# === Команда `/image` для загрузки фото ===
@bot.message_handler(commands=['image'])
def request_image(message):
    if not is_owner(message):
            return

    bot.reply_to(message, "📸 Отправьте изображение, и я загружу его на сайт.")

# === Обработка загруженного фото ===
@bot.message_handler(content_types=['photo'])
def save_image(message):
    if not is_owner(message):
            return
    file_info = bot.get_file(message.photo[-1].file_id)
    downloaded_file = bot.download_file(file_info.file_path)

    # Генерируем путь для сохранения
    image_path = os.path.join(IMAGE_DIR, f"user_image.jpg")

    # Сохраняем фото
    with open(image_path, "wb") as img:
        img.write(downloaded_file)

    # Обновляем JSON с новым путем
    data = load_data()
    data["image"] = f"assets/pic/user-bot/user_image.jpg"
    save_data(data)

    bot.reply_to(message, f"✅ Изображение сохранено!\nПуть: `{data['image']}`", parse_mode="Markdown")

# === Обработка неизвестных команд ===
@bot.message_handler(func=lambda message: True)
def handle_unknown_command(message):
    if not is_owner(message):
            return

    bot.send_message(
        message.chat.id,
        "⚠️ Команда не распознана.\n"
        "Введите `/help`, чтобы увидеть список доступных команд."
    )


# === Запуск бота ===
if __name__ == "__main__":
    print("🤖 Бот запущен...")
    bot.polling(none_stop=True)

