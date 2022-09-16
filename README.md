#Установка
1. ```git clone https://github.com/Den2177/denvolgait.git```
2. ``` скопировать .env.example в .env файл ```
3. ``` Установить имя, пароль от базы данных ```
4.

``` php artisan key:generate ```
5. ``` php artisan migrate ```
6. ```php artisan serve```

##использование
1. для загрузки файла в базу данных использовавть комманду
   ```php artisan push:products {path}```
2. получить продукт по айди можно по адресу http://127.0.0.1:8000/getProduct/{productId}
