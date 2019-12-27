# demo-mongo-application

## Installing
Run `docker-compose up -d`

## Test work with database
1. Install dependencies `docker-compose exec php bash -c "composer install"`
2. Enter in container with php `docker-composer exec php bash`
3. Run artisan tinker `php artisan tinker`
4. Create eloquent model `App\TestModel::create(['name' => 'Test #2'])`
5. Check that model successfully was created `App\TestModel::first()`

##test paragraph
