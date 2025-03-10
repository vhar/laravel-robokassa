
# Робокасса для Laravel

Пакет позволяет производить оплату через сервис [Робокасса](https://docs.robokassa.ru/) в фреймворке Laravel.  
Пакет является фасадом к [Robokassa PHP](https://github.com/vhar/robokassa-php)
>Программа для ЭВМ «Сервис-провайдер Robokassa для фрэймворка Laravel» внесена в Реестр программ для ЭВМ, регистрационный № [2025615311](https://fips.ru/registers-doc-view/fips_servlet?DB=EVM&rn=7886&DocNumber=2025615311&TypeFile=html) от 03.04.2025.



## Установка

```bash
$ composer require vhar/laravel-robokassa
```


## Конфигурация

Установите параметры для подключения к Робокасса в файле `.env`

**Параметры:** 
```bash
ROBOKASSA_LOGIN=логин  
ROBOKASSA_PASSWORD1=пароль_1  
ROBOKASSA_PASSWORD2=пароль_2  
ROBOKASSA_TEST_PASSWORD1=тестовый_пароль_1  
ROBOKASSA_TEST_PASSWORD2=тестовый_пароль_2  
ROBOKASSA_IS_TEST=true|false //Тестовый платеж  
ROBOKASSA_HASH_TYPE=md5|ripemd160|sha1|sha256|sha384|sha512 //алгоритм расчета хэша  
```

Если в приложении необходимо использовать более одного подключения, опубликуйте конфигурационный файл:  
```bash
$ php artisan vendor:publish --provider="Vhar\LaravelRobokassa\Providers\RobokassaServiceProvider" 
```

Добавьте в массив `merchants` файла `config/robokassa.php` настройки для остальных подключений, например:  
```php
    'merchants' => [
        ...
        'merchant2' => [
            'login' => 'merchant2_login',
            'password1' => 'merchant2_password_1',
            'password2' => 'merchant2_password_2',
            'test_password1' => 'merchant2_test_password_1',
            'test_password2' => 'merchant2_test_password_2',
            'is_test' => false,
            'hashType' => 'md5',
        ],
    ],

```

Также, вы можете добавить параметр `ROBOKASSA_DEFAULT` с именем конфигурации подключения по умолчанию в ваш файл `.env`, например: 
```bash
ROBOKASSA_DEFAULT=merchant2
```


## Использование

Для использования подключения с конфигурацией по умолчанию, просто вызывайте методы класса [`Vhar\Robokassa`](https://github.com/vhar/robokassa-php) через фасад   
Для использования определенной конфигурации подключения, добавьте вызов метода `merchant()` перед вызовом нужного метода, например:  
```php
<?php

use Vhar\LaravelRobokassa\Facades\Robokassa;

$link = Robokassa::merchant('merchant2')
    ->createPaymentLink([
        'OutSum' => 123.45,
        'Description' => 'Описание',
        'InvoiceID' => 7,
    ]);
```
