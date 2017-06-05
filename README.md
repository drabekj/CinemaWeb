# CinemaWeb
Semester project for the CS course E-Business_COMP2121 class (Hong Kong Polytechnic University)

## Dependencies
You need Vagrant installed (requires VirtualBox).

## SetUp
In the project folder there is Vagrantfile with necessary configuration for Vagrant to spin up a VM and installing dependencies.

In project root folder, run:
```
vagrant up
```
a VM will be created and run.

The VM listens on localhost port 1234.
To connect to the website, go to address:
```
 localhost:1234
```

## Remove
To remove the installed files, you need to remove the vagrant box.
Run:
```
 vagrant box remove ubuntu/trusty64
```
CAREFUL: you can further specify the box version to ensure that indeed the box installed for this app is removed.

## Description
This project should demonstrate the acquired bacis knowledge during the COMP2121 course, regarding HTML, CSS, PHP and MySQL.
The app is not finished and a lot of core functionality is missing.
