# Курс валют в Laravel

Этот проект представляет собой консольную команду Laravel для получения курсов валют (EUR, USD, KGS) за текущую неделю с сайта Центрального Банка России.

## Установка

1. Склонируйте репозиторий на свой локальный компьютер:

   ```bash
   git clone https://github.com/Xachik-del/GetCurrencyRatesCommand.git
   ```
   
2. Перейдите в каталог проекта:
   ```bash
      cd currency-exchange
   ```
3. Установите зависимости с помощью Composer:
    ```bash
       composer install
    ```
4. Создайте копию файла .env.example и назовите его .env:
    ```bash
       cp .env.example .env
    ```
5. Сгенерируйте ключ приложения:
    ```bash
       php artisan key:generate
    ```
6. Укажите настройки базы данных в файле .env, если это необходимо.
7. Запустите миграции (если вы используете базу данных):
    ```bash
       php artisan migrate
    ```
   
## Использование
После успешной установки вы можете выполнить команду для получения курсов валют:
```bash
        php artisan currency:rates
```

Команда получит курсы валют за текущую неделю и выведет результат в виде таблицы в консоль.
