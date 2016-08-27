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

* Put your application based config files, accordingly modify the env and config files.
```
make putconfigs
```

* Create user's, password reset table.
```
php artisan migrate
```

**Note :** *No configurating file should not be kept in repo.*