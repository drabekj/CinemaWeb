# CinemaWeb
Semester project for the CS course E-Business_COMP2121 class (Hong Kong Polytechnic University)
Unfortunately the web is no longer live, because I no longer have access to my PolyU school account in HongKong.

## Overview
This web application shows some the most basic example how a cinema reservation system could work. It is possible to register/login, look through the move selection, select desired movie, pick time and date to see the screening, pick seat in the cinema and pay via credit card.

**Disclaimer** Because of the limited scope of the class, not all features are fully implemented.

### Screenshots
<img src="/promo_img/welcome_screen.png" width="600">
<figcaption>Fig1. - Landing Page (screenshot)</figcaption>

<img src="/promo_img/offer.png" width="600">
<figcaption>Fig2. - Movies available for reservation (screenshot)</figcaption>

<img src="/promo_img/pick_seat.png" width="600">
<figcaption>Fig3. - Select desired seat in cinema (screenshot)</figcaption>

<img src="/promo_img/payment.png" width="600">
<figcaption>Fig4. - Payment screen (screenshot)</figcaption>

## Description
This project should demonstrate the acquired bacis knowledge during the COMP2121 course, regarding HTML, CSS, PHP and MySQL.
The app is not finished and a lot of core functionality is missing.

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

### Needs to be fixed
Database is not set up, to get a fully working version it needs to get set up. Fill the connection information into the configDB.php file.
