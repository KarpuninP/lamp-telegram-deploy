#!/bin/bash

set -e  # Stop execution on errors

# Checking permissions (without sudo -i)
if [ "$EUID" -ne 0 ]; then
    echo "Restart the script with root rights:"
    echo "sudo bash setup.sh"
    exit 1
fi

# === VARIABLES ===
GIT_REPO="https://github.com/KarpuninP/lamp-telegram-deploy.git"
PROJECT_DIR="/var/www/project"
PUBLIC_DIR="$PROJECT_DIR/public"
BOT_DIR="$PROJECT_DIR/bot"
PYTHON_VENV="$BOT_DIR/venv"
CONF_FILE="/etc/httpd/conf.d/project.conf"
SERVICE_FILE="/etc/systemd/system/telegram-bot.service"
ENV_FILE="$PROJECT_DIR/.env"

echo "=== Updating the system ==="
sudo yum update -y

echo "=== Install the necessary packages ==="
sudo yum install -y git httpd php php-cli php-json php-mbstring python3 python3-pip python3-virtualenv unzip

# === Check if Apache is installed ===
if systemctl is-active --quiet httpd; then
    echo "Apache already installed and running. Skip the installation."
else
    echo "=== Install and run Apache ==="
    sudo systemctl enable httpd
    sudo systemctl start httpd
fi

# === Checking if the project exists ===
if [ -d "$PROJECT_DIR" ]; then
    echo "The project already exists. We are updating it...."
    cd "$PROJECT_DIR" && git pull origin master
else
    echo "Clone the project with GitHub..."
    sudo git clone "$GIT_REPO" "$PROJECT_DIR"
fi

# === Setting up access rights ===
echo "=== Checking access rights ==="
sudo chown -R ec2-user:ec2-user "$PROJECT_DIR"
sudo chmod -R 755 "$PROJECT_DIR"

# === Checking if Apache Virtual Host is configured ===
if [ -f "$CONF_FILE" ]; then
    echo "Apache configuration already exists. Skipping setup."
else
    echo "=== Setting up Apache Virtual Host ==="
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

# === Checking if a virtual environment has been created for the bot ===
if [ -d "$PYTHON_VENV" ]; then
    echo "Python venv already exists. Skipping creation."
else
    echo "=== Create a Python Virtual Environment ==="
    python3 -m venv "$PYTHON_VENV"
fi

# === Activate the virtual environment and install dependencies ===
echo "=== Installing dependencies Python ==="
source "$PYTHON_VENV/bin/activate"

# Let's check if python-dotenv is in requirements.txt
if ! grep -q "python-dotenv" "$BOT_DIR/requirements.txt"; then
    echo "python-dotenv" >> "$BOT_DIR/requirements.txt"
fi

pip install --upgrade pip
pip install -r "$BOT_DIR/requirements.txt"
deactivate


# === Request a token from the user if they don't have one ===
if [ ! -f "$ENV_FILE" ]; then
    read -p "Enter Telegram API Token: " TELEGRAM_TOKEN
    echo "TELEGRAM_TOKEN=$TELEGRAM_TOKEN" > "$ENV_FILE"
    echo ".env created in $PROJECT_DIR"
else
    echo ".env already exists, skip creation."
fi


# === Checking if a systemd service exists for the bot ===
if [ ! -f "$SERVICE_FILE" ]; then
    echo "=== Create a systemd service for a Telegram bot ==="
    tee "$SERVICE_FILE" > /dev/null <<EOL
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
    systemctl daemon-reload
    systemctl enable telegram-bot.service
else
    echo "systemd service for the bot already exists. Skipping setup."
fi


echo "=== Launching a Telegram bot ==="
systemctl restart telegram-bot.service

echo "=== Installation is complete! The site is working, the bot is running. ==="
