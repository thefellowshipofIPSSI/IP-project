#!/bin/bash


read -p "What distribution based ? [debian/arch]" distr
case $distr in
    debian )
        sudo setfacl -R -m u:www-data:rwX -m u:$USER:rwX var/cache var/logs web/uploads
        sudo setfacl -dR -m u:www-data:rwx -m u:$USER:rwx var/cache var/logs web/uploads
        ;;

    arch )
        sudo chown -R devow:http ./var/cache/* ./var/logs/* ./web/uploads
        sudo chmod -R 770 ./var/cache/* ./var/logs/* ./web/uploads
        ;;

    * ) echo "Please answer debian or arch.";;
esac