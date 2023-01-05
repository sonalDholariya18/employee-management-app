## Installing

### Composer

First step is to install `composer` within your system. With below command we can do it.

    sudo apt-get install composer -f

### Packages

Since the composer.json file is already committed, all developers having access to the playbackFileRepository can run below command to install the packages.

    composer install
    
## Setup

Make necessary changes in **.env** file. Create .env file from **.env.example** file

### Generate Artisan Key

The `key:generate` command is used to generate a random key. This command will update the key stored in the application's environment **.env** file.

    php artisan key:generate
    
After generating a key, clear cache by executing `php artisan config:cache`
    
#### Migrations

 Migrations are like version control for your database, allowing your team to easily modify and share the application's database schema.

 Migrations are typically paired with Laravel's schema builder to easily build your application's database schema.

 If you have ever had to tell a teammate to manually add a column to their local database schema, you've faced the problem that database migrations solve.

    php artisan migrate
    
 ##### Local environment

Before work with local environment you must ever run commands:

 `php artisan config:cache`

 `php artisan migrate`

 `php artisan data-inject`
 
 ### Start the server
 
   `php artisan serve`

Open http://localhost:8000/employee to view the app
