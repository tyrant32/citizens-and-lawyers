<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\AppointmentsStatusRepository;
use App\Repositories\AppointmentsStatusRepositoryEloquent;
use App\Repositories\Lawyers\АppointmentRepository;
use App\Repositories\Lawyers\АppointmentRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\UsersRoleRepository;
use App\Repositories\UsersRoleRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsersRoleRepository::class, UsersRoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Citizens\АppointmentRepository::class,
            \App\Repositories\Citizens\АppointmentRepositoryEloquent::class);
        $this->app->bind(АppointmentRepository::class,
            АppointmentRepositoryEloquent::class);
        $this->app->bind(AppointmentsStatusRepository::class, AppointmentsStatusRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
