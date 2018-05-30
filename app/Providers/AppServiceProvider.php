<?php

namespace App\Providers;

use App\Validators\IdNumberValidator;
use App\Validators\PhoneValidator;
use App\Validators\PhoneVerifyCodeValidator;
use App\Validators\PolyExistsValidator;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $validators = [
        'poly_exists' => PolyExistsValidator::class,
        'phone' => PhoneValidator::class,
        'id_no' => IdNumberValidator::class,
        'verify_code' => PhoneVerifyCodeValidator::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Resource::withoutWrapping();

        $this->registerValidators();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Register validators.
     */
    protected function registerValidators()
    {
        foreach ($this->validators as $rule => $validator) {
            Validator::extend($rule, "{$validator}@validate");
        }
    }
}