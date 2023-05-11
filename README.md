
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

```shell
php bin/console make:fixture
```

```shell
php bin/console doctrine:fixtures:load
```
```;shell
composer require symfony/webpack-encore-bundle
composer require symfony/ux-vue

```

Reinitalisation de ma base de donnée
```;shell
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

```