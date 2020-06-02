To use this package you have to add to cofig/app the serviceProvider

Xbugs\Crud\CrudServiceProvider::class,

run php artisan make:crud car

Follow the wizard to add properties to the car
Edit the migration/model and controller to your taste
run
php artisan migrate
php artisan serve
go to
http://127.0.0.1:8000/car and enjoy
