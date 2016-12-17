#!/bin/bash


sudo chown -R devow:www-data $HOME/www-dev/ip-project/var/cache/*
sudo chown -R devow:www-data $HOME/www-dev/ip-project/var/logs
sudo chmod -R 775 $HOME/www-dev/ip-project/var/cache/*
sudo chmod -R 775 $HOME/www-dev/ip-project/var/logs