# Laravel Exercise

> [Back-end exercise](https://jubiwee.notion.site/Back-end-exercise-774229d74e3641509369489514f00c48)
>
> This task was implemented in two versions.:

### Install project
Run this command in terminal:
```bash
# install composer packages
$ composer install
# Install all npm packages
$ npm install
# Create link to public
$ php artisan storage:link
```

### Version 1 (with Laravel CLI):
Run command in terminal for format 'users.csv' to 'result.json',
store this new file 'result.json' in storage
and see result in terminal
```bash
$ php artisan data:format users.csv --locale=en
```

### Version 2 (with Front End):
Run this command in terminal for starting local development:
```bash
# start local server
$ php artisan serve
# Start watch mode
$ npm run watch
```
Open [Home Page](http://127.0.0.1:8000/),
add your 'users.csv' file and get 'result.json' file in your browser
