IpssiProject
============


A Symfony project created on April 15, 2016, 11:05 am.

## Requirements


- Vagrant 1.9.0
- VirtuelBox 5.1.10

## Local Installation


- Clone or download repository
- Move to the `Ip-project` folder
``` 
$ cd Ip-project/
 ``` 
- Run composer install to get the vagrant box : Homestead
``` 
$ ./composer.phar install
 ```
- Edit `Homestead.yaml` file to configure the vagrant box if necessary
- Add the project's ip defined in `Homestead.yaml` to your `/etc/hosts` file (optional : add adminer's ip if you want to use it)
``` 
$ nano /etc/hosts

  192.168.10.10    www.ip-project.app
  (192.168.10.10    www.adminer.app)
```
- Run the vagrant box

 ```
$ vagrant up 
 ```
- If SSH error print, generate SSH keys 
```
$ ssh-keygen -t rsa -C "your@email.com")
 ```
- If NFS is missing, install NFS
 ```
$ sudo apt-get install nfs-kernel-server
```
- If an error print, check your Vagrant and VirtualBox versions
- Connect to the box
 ```
 $ vagrant ssh 
 ```
- Move to the project folder
 ```
 $ cd IP-project/
  ```
- Run composer install on the box to ensure there is no missing dependencies
```
 $ composer install
```
- Run doctrine's migrations
```
 $ php bin/console doctrine:migration:migrate
```
- Run doctrine's fixtures
```
 $ php bin/console doctrine:fixtures:load
```
- Go to `www.ip-project.app` to see the application running
- Go to `www.adminer.app` to see the application's database


## Server and application deployment


https://github.com/Raydicul/Ansible-symfony3