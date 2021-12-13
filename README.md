Online fájlkezelő alkalmazás
=============================
### MAGYAR
    - A projekt egy webes alkalmazás megvalósítása, amibe felhasználók tetszőleges fájlokat tölthetnek fel és le, továbbá szöveges fájlokat hozhatnak létre és szerkeszthetnek is.

### ENGLISH
    - It's a Web Application where you can upload, download, edit and delete files. You have an opportunity to send files to other users. Files are stored in local public storage. User and file information are stored in database.

General Setup
=============

- https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/

Sort Own Setup
==============
### 1. Clone GitHub repo for this project locally
```
git clone 
```

### 2. Install Composer and Dependencies
- https://getcomposer.org/download/
```
composer install
```

### 3. Install NPM Dependencies
```
npm install
```

### 4. Create a copy of your .env file
```
cp .env.example .env
```
- If you prefer other database you can change "DB_DATABASE=" name parameter's value.

### 5. Generate an app encryption key
```
php artisan key:generate
```

### 6. Create an empty database for our application 
- In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created.

### 7. Migrate the database
- Migrate first:
```
php artisan migrate
```
- Or migrate refresh (truncate data):
```
php artisan migrate:fresh
```

### 8. Start project
```
php artisan serve
```
- Web Application is available at: http://127.0.0.1:8000/