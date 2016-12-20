#!/bin/bash


sudo setfacl -R -m u:www-data:rwX -m u:devow:rwX var/cache var/logs
sudo setfacl -dR -m u:www-data:rwx -m u:devow:rwx var/cache var/logs