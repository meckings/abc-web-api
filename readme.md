###Intro

This contains both the web app and the api for the abc co moie ticketing company.

####config

To run first configure environment variables by creating a .env file in the root directory of the project.
The .env.example is a guid to this.

Set up your database and add the name, username and password to access the database in the .env file

That is all, make sure you have php installed in your pc, then run _*php artisan serve*_ from your terminal in the root directory of the project.

####Admin User/Ticketing Officer

To create the admin user, follow the registerion procedure as you would create a normal user, then from your database, locate the user under the _users_ table
and change the _admin_ column of this user to _1_
