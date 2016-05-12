# Инструкция по установке приложения diglot #

[Readme](https://github.com/pvolyntsev/diglot/blob/master/README.md)


####Минимальные требования####
- PHP 5.5+
- MySQL 5.0+
- [Composer](https://getcomposer.org/download/)
- php5-curl

####Скопировать репозиторий####
```
cd /var/www/diglot
git clone https://github.com/pvolyntsev/diglot.git
composer update
```


#### Миграция таблиц ####
```
yii migrate/up --migrationPath=@vendor/budyaga/yii2-users/migrations
yii migrate/up
```

#### Создание БД ####
```
DROP DATABASE IF EXISTS `diglot`;
CREATE DATABASE IF NOT EXISTS `diglot` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON diglot.* TO diglot_rw@localhost IDENTIFIED BY '123456';
```