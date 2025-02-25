#!/bin/bash

set -e  # Останавливаем выполнение при ошибках

# === ПЕРЕМЕННЫЕ ===
GIT_REPO="https://github.com/KarpuninP/lamp-telegram-deploy.git"  # Замени на свой репозиторий
PROJECT_DIR="/var/www/project"
PUBLIC_DIR="$PROJECT_DIR/public"
BOT_DIR="$PROJECT_DIR/bot"
PYTHON_VENV="$BOT_DIR/venv"

echo "=== Обновляем систему ==="
sudo yum update -y

echo "=== Устанавливаем необходимые пакеты ==="
sudo yum install -y git httpd php php-cli php-json php-mbstring python3 python3-pip python3-virtualenv unzip curl

# === Клонируем репозиторий ===
if [ -d "$PROJECT_DIR" ]; then
    echo "Проект уже существует. Обновляем..."
    cd "$PROJECT_DIR" && git pull
else
    echo "Клонируем проект с GitHub..."
    sudo git clone "$GIT_REPO" "$PROJECT_DIR"
fi

# === Настраиваем права доступа ===
echo "=== Настраиваем права ==="
sudo chmod -R 755 "$PROJECT_DIR"
sudo chown -R apache:apache "$PROJECT_DIR"

echo "=== Настраиваем Apache ==="
sudo tee /etc/httpd/conf.d/project.conf > /dev/null <<EOL
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

echo "=== Перезапускаем Apache ==="
sudo systemctl restart httpd
sudo systemctl enable httpd

# === Устанавливаем зависимости для Python-бота ===
echo "=== Устанавливаем зависимости Python ==="
if [ ! -d "$PYTHON_VENV" ]; then
    python3 -m venv "$PYTHON_VENV"
fi
source "$PYTHON_VENV/bin/activate"
pip install --upgrade pip
pip install -r "$BOT_DIR/requirements.txt"

# === Создаем systemd-сервис для Telegram-бота ===
echo "=== Создаем systemd сервис для бота ==="
sudo tee /etc/systemd/system/telegram-bot.service > /dev/null <<EOL
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

echo "=== Перезапускаем systemd и запускаем бота ==="
sudo systemctl daemon-reload
sudo systemctl enable telegram-bot.service
sudo systemctl start telegram-bot.service

echo "=== Установка завершена! Сайт работает, бот запущен. ==="
