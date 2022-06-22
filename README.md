# Cashierfan (Laravel9 & InertiaJS & VUE3)

Cashierfan is Point of Sales application built with Laravel 9, VueJS3,
PiniaState, TailwindCSS and InertiaJS

## Installation

Cashierfan application require Postgresql database data, install the Postgresql
with docker-compose

```sh
docker-compose -f  dockcompose-pgsql.yaml up -d
```

Install all composer dependencies

```sh
composer install --ignore-platform-reqs
```

Migrate required tables and seed data to tables

```sh
php artisan migrate
php artisan db:seed
```

Generate secret key / hash key

```sh
php artisan key:generate
```

Verify the deployment by navigating to your server address in your preferred
browser.

```sh
127.0.0.1:8000
```

## License

MIT && CASHIERFAN

**Open Source**
