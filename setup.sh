#!/bin/bash

set -e  # Останавливаем выполнение при ошибках

# Проверка прав (без sudo -i)
if [ "$EUID" -ne 0 ]; then
    echo "Перезапусти скрипт с правами root:"
    echo "sudo bash setup.sh"
    exit 1
fi

# === ПЕРЕМЕННЫЕ ===
GIT_REPO="https://github.com/KarpuninP/lamp-telegram-deploy.git"
PROJECT_DIR="/var/www/project"
PUBLIC_DIR="$PROJECT_DIR/public"
BOT_DIR="$PROJECT_DIR/bot"
PYTHON_VENV="$BOT_DIR/venv"

echo "=== Обновляем систему ==="
sudo yum update -y

echo "=== Устанавливаем необходимые пакеты ==="
sudo yum install -y git httpd php php-cli php-json php-mbstring python3 python3-pip python3-virtualenv unzip

# === Проверяем, установлен ли Apache ===
if systemctl is-active --quiet httpd; then
    echo "Apache уже установлен и запущен. Пропускаем установку."
else
    echo "=== Устанавливаем и запускаем Apache ==="
    sudo systemctl enable httpd
    sudo systemctl start httpd
fi

# === Проверяем, существует ли проект ===
if [ -d "$PROJECT_DIR" ]; then
    echo "Проект уже существует. Обновляем..."
    cd "$PROJECT_DIR" && git pull origin master
else
    echo "Клонируем проект с GitHub..."
    sudo git clone "$GIT_REPO" "$PROJECT_DIR"
fi

# === Настраиваем права доступа ===
echo "=== Проверяем права доступа ==="
sudo chown -R ec2-user:ec2-user "$PROJECT_DIR"
sudo chmod -R 755 "$PROJECT_DIR"

# === Проверяем, настроен ли Apache Virtual Host ===
CONF_FILE="/etc/httpd/conf.d/project.conf"
if [ -f "$CONF_FILE" ]; then
    echo "Конфигурация Apache уже существует. Пропускаем настройку."
else
    echo "=== Настраиваем Apache Virtual Host ==="
    sudo tee "$CONF_FILE" > /dev/null <<EOL
<VirtualHost *:80>
    DocumentRoot "$PUBLIC_DIR"
    <Directory "$PUBLIC_DIR">
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog /var/log/httpd/project-error.log
    CustomLog /var/log/httpd/project-access.log combined
</VirtualHost>
EOL
    sudo systemctl restart httpd
fi

# === Проверяем, создано ли виртуальное окружение для бота ===
if [ -d "$PYTHON_VENV" ]; then
    echo "Python venv уже существует. Пропускаем создание."
else
    echo "=== Создаем виртуальное окружение Python ==="
    python3 -m venv "$PYTHON_VENV"
fi

# === Активируем виртуальное окружение и устанавливаем зависимости ===
echo "=== Устанавливаем зависимости Python ==="
source "$PYTHON_VENV/bin/activate"
pip install --upgrade pip
pip install -r "$BOT_DIR/requirements.txt"

# === Проверяем, существует ли systemd-сервис для бота ===
SERVICE_FILE="/etc/systemd/system/telegram-bot.service"
if [ -f "$SERVICE_FILE" ]; then
    echo "Systemd-сервис для бота уже существует. Пропускаем настройку."
else
    echo "=== Создаем systemd-сервис для Telegram-бота ==="
    sudo tee "$SERVICE_FILE" > /dev/null <<EOL
[Unit]
Description=Telegram Bot
After=network.target

[Service]
User=ec2-user
WorkingDirectory=$BOT_DIR
ExecStart=$PYTHON_VENV/bin/python3 $BOT_DIR/bot.py
Restart=always

[Install]
WantedBy=multi-user.target
EOL
    sudo systemctl daemon-reload
    sudo systemctl enable telegram-bot.service
fi

echo "=== Запускаем Telegram-бот ==="
sudo systemctl start telegram-bot.service

echo "=== Установка завершена! Сайт работает, бот запущен. ==="
