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
$ cd Ip-project
 ```
- run composer install to get the vagrant box : Homestead
``` 
$ ./composer.phar install
 ```
- Edit `Homestead.yaml` file to configure the vagrant box if necessary
- add the project's ip defined in `Homestead.yaml` to your `/etc/hosts` file
``` 
$ nano /etc/hosts

  192.168.10.10    www.ip-project.dev
```
- run the vagrant box
 ```
$ vagrant up 
 ```
- if SSH error print, generate a key 
```
$ ssh-keygen -t rsa -C "your@email.com")
 ```
- if NFS is missing, install NFS
 ```
$ sudo apt-get install nfs-kernel-server
```
- if an error print, check your Vagrant and VirtualBox versions

## Server and application deployment

https://github.com/Raydicul/Ansible-symfony3