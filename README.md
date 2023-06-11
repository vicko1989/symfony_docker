Za ovaj projekt sam koristio Docker, Symfony i MySQL.

Postavljanje projekta:

Za kreiranje symfony projekta sam koristio tutorial sa linka:
https://medium.com/@meherbensalah4/how-to-dockerize-symfony-project-f06bcd735308

Za upravljanjem dockermo sam koristio Docker Desktop.

Kreirao sam docker-compose.yml i kopirao podatke iz tutoriala. Zbog toga containare imaju naziv tutorial.
Sada kada bolje se razumijem u postavljanje dockera shvacam da sam mogao promjeniti naziv.

Nakon ovoga sam kreirao DockerFile i ubacio kod iz tutoriala.

Kreirao sam vhost.conf, i ubacio kod sa infom za vhost-a.

Nakon što sam kreirao sve potrebne config datoteke pokrenuo sam komandu 
docker-compose up --build koja je kreirala containere za mysql, symfony i phpmyadmin.

Nakon toga sam kreirao symfony projekt koji se nalazi unutar project foldera.

Nakon što je kreiran symfony projekt, preko docker terminala sam prvo koristio komandu cd project da se prebacim na
taj folder.

Nakon toga sam kreirao entity sa komandom php bin/console make:entity.

Nakon što je entity kreiran koristeći migraciju sa komandama:
php bin/console make:migration
php bin/console doctrine:migrations:migrate

sam kreirao potrebne tablice u bazi podataka za podatke o nekretnini.

Nakon kreiranja entiteta i migracije sam pokrenuo komandu php bin/console make:crud Nekretnina
koja je kreirala sve CRUD elemente i omogučila upravljanjem podataka o nekretnini.

Nakon ovoga sam kreirao user entity za spremanje podataka o korisniku.

Nakon kreiranja usera i migracije sam kreirao formu za registraciju sa komandom php bin/console make:registration.

Nakon ovoga sam kreira login formu sa komandom php bin/console make:auth.

Na kraju sam još dodao u Nekretnina entitet ime slike i mogučnost spremanja i promjene slike.
Slike se spremaju u folder public/uploads/images.

Admin stranica:

Prije nego što se može pristupiti adminu potrebno je registrirati korinika.
Registracija se izvršava preko registracijske forme na adresi http://localhost:8741/register

Nakon registracije korisnika možemo se logirati na stranici http://localhost:8741/login

Ako je login bio uspješan pozvat ce se stranica http://localhost:8741/nekretnina/ na kojoj se nalazi lista nekretnina i
opcije editiranja, dodavanja i brisanja nekretnine.

Ako nismo logirani samo će biti prikaza prazna stranica.

Za pozivanja phpadmina i baze podataka potrebno je otvoriti stranicu http://localhost:8080/
Username: root
Password:

Za otvoriti frontend potrebno je ici na url:
http://localhost:8741/nekretnina/front

Klikom na 'Dohvati podatke o nekretninama' će se otvoriti tablica sa podacima o nekretninama.

Za pisanje koda sam koristio PHPStorm koji sam spojio sa githubom i preko njega radio push na github.


