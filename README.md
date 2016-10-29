# Laravel Social Authentication

### Minimum [requirments](https://www.laravel.com/docs/5.3#server-requirements) for installation.

* php >=5.5.9
* Apache / Nginx
* Mysql 5.6

### Follow the steps for proper installation.

* For setting up vhost
```
sudo cp dev/nginx/laravel-social.conf /opt/local/etc/nginx/sites/laravel-social.conf
```

* Accordingly modify the hosts.
```
sudo vim /etc/hosts
```

* Install the dependencies via package manager.
```
make vendor
```

* Put your application specific config files, accordingly modify the env and config files.
```
make putconfigs
```

### Frequently used commands

* Create user's, password reset table.
```
php artisan migrate
```

* Creating migration table.
```
php artisan make:migration migration_name --create="table_name"
```

* Create model with artisan
```
php artisan make:model ModelName
```

* Refresh migration if new fields are added.
```
php artisan migrate:refresh
```

**Note :** *No configurating file should be kept in repo.*