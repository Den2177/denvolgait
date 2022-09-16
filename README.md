#Установка
1. ```git clone https://github.com/Den2177/denvolgait.git```
2. ```composer install```
3. ``` создать в корне проекта .env файл, скопировать туда данные из .env.example ```
4. ``` Установить в файле .env имя, пароль от базы данных ```
5. ``` php artisan key:generate ```
6. ``` php artisan migrate ```
7. ```php artisan serve```

##использование
1. для загрузки файла в базу данных использовавть комманду
   ```php artisan push:products {path}```
2. получить продукт по айди можно по адресу http://127.0.0.1:8000/getProduct/{productId}
