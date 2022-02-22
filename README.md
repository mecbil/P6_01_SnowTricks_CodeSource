Code source du Projet 6 de la formation Développeur d'application - PHP / Symfony d'OpenClassrooms, intitulé "Développez de A à Z le site communautaire SnowTricks"

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/aa6e8433d4e94f8c9b944715214ad528)](https://www.codacy.com/gh/mecbil/SnowTricks/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=mecbil/SnowTricks&amp;utm_campaign=Badge_Grade)

<a href="https://codeclimate.com/github/mecbil/SnowTricks/maintainability"><img src="https://api.codeclimate.com/v1/badges/8203585276a0769a9d2b/maintainability" /></a>

Installation :

Pour utiliser ce Site, il faut suivre les étapes suivantes :

    Télécharger 

    git clone https://github.com/mecbil/SnowTricks.git

    Installation

     1 - Installer Compositeur

        https://getcomposer.org/download/

     2 - Installer Symfony

        https://symfony.com/download

        https://symfony.com/doc/current/setup.html

     3 - Importer la base de données

     Un exemple de fichier SQL peut être trouvé dans le répertoire racine.

     4 - Modifier la connexion dans .env

     Vous trouverez le fichier .env dans le répertoire racine. 

    Créer une base de données nomée "snowtricks" et importer le fichier snowtricks.sql 
    situé à la racine du projet 

    Entrez vos informations d'identification de connexion à la base de données dans le fichier .env situé à la racine du projet

         Remplacez la ligne 22 par : MAILER_DSN=smtp://localhost:1025
         Remplacez la ligne 30 par : DATABASE_URL="mysql://root@127.0.0.1:3306/snowtricks?serverVersion=5.7"
    
     N'oubliez pas d'utiliser download Mail Hog et de l'utiliser 

    Amusez-vous avec ce Site !

To use this blog, you must follow this steps :

    Installation

    1 - Install Composer

    https://getcomposer.org/download/

    2 - Install Symfony

    https://symfony.com/download

    https://symfony.com/doc/current/setup.html

    3 - Import Database

    An SQL sample file can be find in the root directory.
    
    4 - Modify Connection in .env

    You will find the .env file in the root directory.

    Create a database named 'snowtricks "and import the snowtricks.sql file 
    located at the root of the project

    Enter your database connection credentials in the .env file located at 
    the root of the project

        Change line 22 to : MAILER_DSN=smtp://localhost:1025
        Change line 30 to : DATABASE_URL="mysql://root@127.0.0.1:3306/snowtricks?serverVersion=5.7"
    
    Don't forget to use download Mail Hog and to use it


    Have fun using this Site !

Environnement

    PHP 7.3
    Architecture MVC
    Programmation Orientée Objet
    Bootstrap 5
    MySQL
    jQuery
