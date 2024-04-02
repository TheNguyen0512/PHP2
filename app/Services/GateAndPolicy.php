<?php
namespace App\Services;

use Illuminate\Support\Facades\Gate;

class GateAndPolicy{
    public function setGateAndPolicyAccess(){
        $this->defineGateCategory();
        $this->defineGateProduct();
        $this->defineGateSlider();
        $this->defineGateSettings();
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGatePermission();
        $this->defineGateCustomer();
        $this->defineGateOrder();
    }
    public function defineGateCategory(){
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }

    public function defineGateProduct(){
        Gate::define('product-list', 'App\Policies\ProductPolicy@view');
        Gate::define('product-add', 'App\Policies\ProductPolicy@create');
        Gate::define('product-edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product-delete', 'App\Policies\ProductPolicy@delete');
    }

    public function defineGateSlider(){
        Gate::define('slider-list', 'App\Policies\SliderPolicy@view');
        Gate::define('slider-add', 'App\Policies\SliderPolicy@create');
        Gate::define('slider-edit', 'App\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SliderPolicy@delete');
    }

    public function defineGateSettings(){
        Gate::define('settings-list', 'App\Policies\SettingsPolicy@view');
        Gate::define('settings-add', 'App\Policies\SettingsPolicy@create');
        Gate::define('settings-edit', 'App\Policies\SettingsPolicy@update');
        Gate::define('settings-delete', 'App\Policies\SettingsPolicy@delete');
    }

    public function defineGateUser(){
        Gate::define('user-list', 'App\Policies\UserPolicy@view');
        Gate::define('user-edit', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');
    }

    public function defineGateRole(){
        Gate::define('role-list', 'App\Policies\RolePolicy@view');
        Gate::define('role-add', 'App\Policies\RolePolicy@create');
        Gate::define('role-edit', 'App\Policies\RolePolicy@update');
        Gate::define('role-delete', 'App\Policies\RolePolicy@delete');
    }

    public function defineGatePermission(){
        Gate::define('permission-add', 'App\Policies\PermissionPolicy@create');
    }

    public function defineGateCustomer(){
        Gate::define('customer-list', 'App\Policies\CustomerPolicy@view');
    }

    public function defineGateOrder(){
        Gate::define('orders-list', 'App\Policies\OrdersPolicy@view');
        Gate::define('orders-edit', 'App\Policies\OrdersPolicy@update');
    }
}
