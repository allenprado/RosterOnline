<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{

    //Variables Interface
    private $IUserRepository = 'App\Repositories\Contracts\IUserRepository';
    private $IPermissionRepository = 'App\Repositories\Contracts\IPermissionRepository';
    private $IRoleRepository = 'App\Repositories\Contracts\IRoleRepository';
    private $ICompanyRepository = 'App\Repositories\Contracts\ICompanyRepository';
    private $IShiftRepository = 'App\Repositories\Contracts\IShiftRepository';
    private $ISpecialHourRepository = 'App\Repositories\Contracts\ISpecialHourRepository';
    private $IConsolidateRepository = 'App\Repositories\Contracts\IConsolidateRepository';

    //Variables Class
    private $UserRepository = 'App\Repositories\Eloquent\UserRepository';
    private $PermissionRepository = 'App\Repositories\Eloquent\PermissionRepository';
    private $RoleRepository = 'App\Repositories\Eloquent\RoleRepository';
    private $CompanyRepository = 'App\Repositories\Eloquent\CompanyRepository';
    private $ShiftRepository = 'App\Repositories\Eloquent\ShiftRepository';
    private $SpecialHourRepository = 'App\Repositories\Eloquent\SpecialHourRepository';
    private $ConsolidateRepository = 'App\Repositories\Eloquent\ConsolidateRepository';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //Registration
        $this->app->bind($this->IUserRepository,$this->UserRepository);
        $this->app->bind($this->IPermissionRepository,$this->PermissionRepository);
        $this->app->bind($this->IRoleRepository,$this->RoleRepository);
        $this->app->bind($this->ICompanyRepository,$this->CompanyRepository);
        $this->app->bind($this->IShiftRepository,$this->ShiftRepository);
        $this->app->bind($this->ISpecialHourRepository,$this->SpecialHourRepository);
        $this->app->bind($this->IConsolidateRepository,$this->ConsolidateRepository);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.alert', 'alert_');
        Blade::component('components.breadcrumb', 'breadcrumb_');
        Blade::component('components.search', 'search_');
        Blade::component('components.table', 'table_');
        Blade::component('components.paginate', 'paginate_');
        Blade::component('components.page', 'page_');
        Blade::component('components.form', 'form_');
    }
}
