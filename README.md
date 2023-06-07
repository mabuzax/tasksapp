# Tasks Application

This is a Laravel application to manages tasks for projects, built with MySQL and Laravel. 

## Requirements

1. PHP 7.4 or greater
2. Composer
3. Node.js & NPM
4. MySQL

## Installation

Follow these steps to set up the project.

### Step 1: Clone the Repository

Clone this repository to your local machine:
```bash
git clone https://github.com/yourusername/tasksapp.git
```

### Step 2: Install Dependencies
```bash
cd tasksapp
composer install
npm install
npm install axios
```

### Step 3: Configure Environment
Make a copy of .env.example file:
```bash
cp .env.example .env
```

Update the .env file with your database information. Here is an example configuration:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tasksapp_db
DB_USERNAME=yourusername
DB_PASSWORD=yourpassword
```

Generate a new application key:
```bash
php artisan key:generate
```

### Step 4: Create the Database
Use your favourite DB tool, or
```bash
sudo mysql -u yourdbusername -p -e "CREATE DATABASE tasksapp_db;"
```

### Step 5: Run Migrations
Run the migration command to create the DB tables:
```bash
php artisan migrate
```

### Step 6: Start the Server
```bash
php artisan serve
```
Access the Tasks Application
```bash
http://localhost:8000
```
