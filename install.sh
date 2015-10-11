#!/bin/bash
###from https://github.com/followtheart/Laravel-5-Starter
echo "一键自动安装脚本 One command installer"
echo "Laravel 环境配置"

echo "###0.安装php5,apache2"
sudo apt-get install php5 php5-cli apache2 curl -y

echo "###Install mysql"
sudo apt-get install mysql-server php5-mysql -y


echo "###1.安装[composer](https://github.com/composer/composer)"

command -v composer > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "composer installed,skip to next step"
else
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
fi

echo "###2.Laravel 配置"

command -v laravel > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "laravel installed,skip to next step"
else
  composer global require "laravel/installer=~1.1"
  echo "#加入环境变量"
  echo 'export PATH=$PATH:"~/.composer/vendor/bin/"' >> ~/.bashrc
  source ~/.bashrc
fi

echo "###3.Install 3rd-party package"
sudo apt-get install php5-mcrypt php5-gd php5-curl -y

composer install
echo "cp .env.example .env..."
cp .env.example .env

php artisan key:generate

echo "create database ..."
sudo mysql -hlocalhost -p123456 -uroot -e"create database robot"

php artisan migrate
php artisan db:seed

echo "Start server,goto localhost:8000"
php artisan serve --host localhost
