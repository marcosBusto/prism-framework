# Prism Framework

Migrations (check [`.env`](./.env)):

```
php prism.php migrate
```

App:

```
cd public
php -S localhost:8000
```

Tests (`.env` not implemented, check [`./tests/Database/RefreshDatabase.php`](./tests/Database/RefreshDatabase.php)):

```
composer run tests
```
