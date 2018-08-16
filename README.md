# Laravel Eloquent Approval

Approval process for Laravel's Eloquent models.

## How it works?

New entities are created in the 'approval' table as _pending_ and then can become _approved_ or _rejected_.

## Install

```sh
$ composer require traknpay/laravel-eloquent-approval
```

### Version Compatibility

| Laravel Version | Package Version |
|:---------------:|:---------------:|
|      5.6.*      |       ^1.0      |


## Setup

### Registering the service provider

By default the service provider is registered automatically by Laravel package
discovery otherwise you need to register it in your `config\app.php`

```php
TraknPay\LaravelEloquentApproval\ApprovalServiceProvider::class
```

Run the following commands to migrate the 'approval' table:
```php
php artisan vendor:publish --provider='TraknPay\LaravelEloquentApproval\ApprovalServiceProvider'

php artisan migrate
```
### Model

Add `ApprovalTrait` trait to the model and override the `isApprover()` function as per your need.

```php    
use Illuminate\Database\Eloquent\Model;
use TraknPay\LaravelEloquentApproval\ApprovalTrait;

class Entity extends Model
{
    use ApprovalTrait;
    
    public static function isApprover(): bool
    {
        return true;
    }
}
```

By default `isApprover()` is true and if you use this trait, it will not put the new entities in the `approval` table. You can override this functionality based on your need. If `isApprover()` function returns false then entities are added to `approval` table and mark the transaction as false.
Hence, if 'isApprover()' returns false the model will not be persited to database instead added to 'approval' table for approval.
For example, in this function you can check whether user has permission to approve or not.


## Inspirations

I got some inspiration from [mtvs/eloquent-approval](https://github.com/mtvs/eloquent-approval) package.
Even though , I wrote my own package for my project purpose I got some insights on how to write my own package from this.