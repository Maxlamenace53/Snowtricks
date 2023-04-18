
```shell
php -S localhost:8000 -t public
```


```dotenv
DATABASE_URL="mysql://max:@127.0.0.1:3306/snowtricks?serverVersion=8&charset=utf8mb4"
```

```shell
php bin/console make:migration
```

```shell
php bin/console doctrine:migrations:migrate
```