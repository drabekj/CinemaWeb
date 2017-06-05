#!/bin/bash

echo "Provisioning virtual machine..."
    export DEBIAN_FRONTEND=noninteractive
    sudo apt-get update > /dev/null
    sudo apt-get -y upgrade > /dev/null

# Installing GIT
echo "Installing Git"
    sudo apt-get install git -y > /dev/null

# Installing Nginx
echo "Installing Nginx"
    sudo apt-get install nginx -y > /dev/null

# Installing PHP
echo "Installing PHP"
    sudo apt-get install php5-common php5-dev php5-cli php5-fpm -y > /dev/null

echo "Installing PHP extensions"
    sudo apt-get install curl php5-curl php5-gd php5-mcrypt php5-mysql -y > /dev/null

# Installing MySQL
sudo apt-get install debconf-utils -y > /dev/null
debconf-set-selections <<< "mysql-server mysql-server/root_password password 1234"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password 1234"

sudo apt-get install mysql-server -y > /dev/null

# Configure Nginx
echo "Configuring Nginx"
 # clean /var/www
sudo rm -Rf /var/www

 # symlink /var/www => /vagrant
ln -s /vagrant /var/www

sudo cp /var/www/.provision/config/nginx_vhost /etc/nginx/sites-available/nginx_vhost > /dev/null
ln -s /etc/nginx/sites-available/nginx_vhost /etc/nginx/sites-enabled/
rm -rf /etc/nginx/sites-available/default

service nginx restart > /dev/null
