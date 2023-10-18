## Food Inquiry Web App

A test app that allows users look up any recipe. 
Test URL: https://wh1069834.ispot.cc(https://wh1069834.ispot.cc)
To achieve this, the following free api(s) were used:

- Recipe search [Edamam Recipe Search API](https://api.edamam.com/).
- Currency exchange rate [APILAYER Exchange Rates Data API](https://apilayer.com).

## Requirements
You need
* Composer
* PHP
* Laravel
* NodeJs
* Any Database

## Starting the Web App

To start the Website, clone this repository and run the following commands 
```
composer install
```
```
npm install
```
```
npm run dev or npm run build
```

Connect it to a database. You can change the settings in the .env File. After that use the following command
```
php artisan migrate --seed
```
This command will create the database and seed the currency table for the website.

You can now start the project by using the command:
```
php artisan serve
```

To automatically update the currency rates hourly, you're required to setup a cron job to perform the task. Optionally, you can call the following command from your command-line to update the exchange rate.
```
php artisan update-currencies
```
