# AWS Site Manager

## Описание
Этот проект автоматически разворачивает сайт и Telegram-бота на AWS с помощью LAMP (Linux, Apache, MySQL, PHP) и Python.

## Функционал
- Автоматическая установка через `setup.sh`
- Лендинг управляется через JSON
- Telegram-бот изменяет контент сайта
- Работает на Amazon Linux 2023

## Установка
Запустите следующую команду на сервере AWS:
```bash
curl -sL -o setup.sh https://raw.githubusercontent.com/KarpuninP/lamp-telegram-deploy/dev/setup.sh
chmod +x setup.sh
sudo bash setup.sh
```
Замените `username/repository` на ваш GitHub-репозиторий.

## Технологии
- PHP + Apache
- Python + Telebot
- JSON для хранения данных

## Структура проекта
```
/project
  ├── /public                # Открытая папка (index.php, assets)
  ├── /app                   # Закрытая серверная логика (контроллеры, модели, вьюхи)
  ├── /bot                   # Telegram-бот
  ├── /storage               # JSON-файлы (НЕ публичные)
  ├── setup.sh               # Скрипт установки
```

## Лицензия
MIT License
```
