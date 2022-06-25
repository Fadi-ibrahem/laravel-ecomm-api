<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Front\SizeRepository;
use App\Repositories\Front\UserRepository;
use App\Repositories\Front\ColorRepository;
use App\Repositories\Front\OrderRepository;
use App\Repositories\Front\CouponRepository;
use App\Repositories\Front\ProductRepository;
use App\Repositories\Front\ShipperRepository;
use App\Repositories\Front\CategoryRepository;
use App\Repositories\Front\FeedbackRepository;
use App\Interfaces\Front\SizeRepositoryInterface;
use App\Interfaces\Front\UserRepositoryInterface;
use App\Interfaces\Front\ColorRepositoryInterface;
use App\Interfaces\Front\OrderRepositoryInterface;
use App\Interfaces\Front\PhoneRepositoryInterface;
use App\Repositories\Front\CancellationRepository;
use App\Repositories\Front\UserCustomerRepository;
use App\Repositories\Front\UserSupplierRepository;
use App\Interfaces\Front\CouponRepositoryInterface;
use App\Interfaces\Front\ProductRepositoryInterface;
use App\Interfaces\Front\ShipperRepositoryInterface;
use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Interfaces\Front\FeedbackRepositoryInterface;
use App\Interfaces\Front\CancellationRepositoryInterface;
use App\Interfaces\Front\UserCustomerRepositoryInterface;
use App\Interfaces\Front\UserSupplierRepositoryInterface;
use App\Repositories\Front\PhoneRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackRepository::class);
        $this->app->bind(UserSupplierRepositoryInterface::class, UserSupplierRepository::class);
        $this->app->bind(UserCustomerRepositoryInterface::class, UserCustomerRepository::class);
        $this->app->bind(ShipperRepositoryInterface::class, ShipperRepository::class);
        $this->app->bind(CancellationRepositoryInterface::class, CancellationRepository::class);
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ColorRepositoryInterface::class, ColorRepository::class);
        $this->app->bind(SizeRepositoryInterface::class, SizeRepository::class);
        $this->app->bind(PhoneRepositoryInterface::class, PhoneRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
