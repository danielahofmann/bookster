<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Session;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
	    /**
	     * Definition of macros
	     *
	     * For the Routing, it's necessary to define macros, which then can be used in the age-specific routing files.
	     * They are used like functions, which you can call from routing files and so reduce code massively.
	     * They need to be defined, so the routes for each age-group are defined and can be used in templates.
	     * Please always make sure, that the call for parent to boot happens lastly.
	     */

	    Route::macro('home', function ($age) {
		    Route::get( '/', 'HomeController@index')->name($age.'-home');
	    });

		Route::macro('login', function ($age) {
			Route::get( '/login', 'Auth\LoginController@showLoginForm')->name( $age . '-login' );
		});

	    Route::macro('dashboard', function ($age) {
		    Route::get( '/dashboard', 'HomeController@customerDashboard')->name($age . '-dashboard');
	    });

	    Route::macro('dashboardUser', function ($age) {
		    Route::get( '/dashboard/user', 'CustomerController@show')->name($age . '-dashboard-user');
	    });

	    Route::macro('dashboardOrders', function ($age) {
		    Route::get( '/dashboard/orders', 'OrderController@showCustomerOrders')->name($age . '-dashboard-order');
	    });

	    Route::macro('dashboardOrderDetails', function ($age) {
		    Route::get( '/dashboard/orders-details/{id}', 'OrderController@showOrder')->name($age . '-order-details');
	    });

	    Route::macro('category', function ($age) {
		    Route::get( '/category/{category_id}', 'CategoryController@show')->name($age . '-category');
	    });

	    Route::macro('author', function ($age) {
		    Route::get( '/author/{id}', 'ProductController@getBooksOfAuthor')->name($age . '-author');
	    });

	    Route::macro( 'product', function ($age) {
		    Route::get('/product/{id}', 'ProductController@show')->name($age . '-product');
	    });

	    Route::macro( 'wishlist', function ($age) {
		    Route::get( '/wishlist', 'WishlistController@index' )->name( $age . '-wishlist' );
	    });

	    Route::macro( 'cart', function ($age) {
		    Route::get( '/cart', 'CartController@index' )->name( $age . '-cart' );
	    });

	    Route::macro( 'checkout', function ($age) {
		    Route::get( '/checkout', 'HomeController@checkout' )->name( $age . '-checkout' );
	    });

	    Route::macro( 'register', function ($age) {
		    Route::get( '/register', 'Auth\RegisterController@showRegistrationForm' )->name( $age . '-register' );
		    Route::post('register', 'Auth\RegisterController@register');
	    });

	    Route::macro( 'order', function ($age) {
		    Route::get( '/order', 'OrderController@showOrderForm' )->name( $age . '-order' );
		    Route::get( '/order-success', 'OrderController@showSuccess' )->name( $age . '-order-success' );
	    });

	    Route::macro( 'help', function ($age) {
		    Route::get('/help', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.help');
		    })->name($age . '-help');

		    Route::get('/help/delivery', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.help-delivery');
		    })->name($age . '-help-delivery');

		    Route::get('/help/payment', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.help-payment');
		    })->name($age . '-help-payment');

		    Route::get('/help/retoure', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.help-retoure');
		    })->name($age . '-help-retoure');

		    Route::get('/help/order', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.help-order');
		    })->name($age . '-help-order');
	    });

	    Route::macro( 'results', function ($age) {
		    Route::get( '/results', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.results');
		    })->name( $age . '-results' );
	    });

	    Route::macro( 'contact', function ($age) {
		    Route::get( '/contact', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.contact');
		    })->name( $age . '-contact' );
	    });

	    Route::macro( 'about', function ($age) {
		    Route::get( '/about', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.about');
		    })->name( $age . '-about' );
	    });

	    Route::macro( 'sendWishlist', function ($age) {
		    Route::get( '/send', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.send');
		    })->name( $age . '-send-wishlist' );
	    });

	    Route::macro( 'imprint', function ($age) {
		    Route::get('/imprint', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.imprint');
		    })->name($age . '-imprint');

		    Route::get('/privacy', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.privacy');
		    })->name($age . '-privacy');

		    Route::get('/agb', function (){
			    return view('age-layouts.' . Session::get('ageGroup') . '.agb');
		    })->name($age . '-agb');
	    });

	    parent::boot();

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //Map the routes for the different ageGroups
        $this->mapToddlerRoutes();
        $this->mapKidRoutes();
        $this->mapTeenRoutes();
        $this->mapElderlyRoutes();
        $this->mapSeniorRoutes();
        $this->mapDefaultRoutes();

        //Map routes for admin
	    $this->mapAdminRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

	/**
	 * These routes are for the toddlers ageGroup
	 *
	 * @return void
	 */
	protected function mapToddlerRoutes()
	{
		Route::middleware('web')
		     ->namespace($this->namespace)
		     ->group(base_path('routes/toddlers.php'));
	}

	/**
	 * These routes are for the kids ageGroup
	 *
	 * @return void
	 */
	protected function mapKidRoutes()
	{
		Route::middleware('web')
		     ->namespace($this->namespace)
		     ->group(base_path('routes/kids.php'));
	}

	/**
	 * These routes are for the teens ageGroup
	 *
	 * @return void
	 */
	protected function mapTeenRoutes()
	{
		Route::middleware('web')
		     ->namespace($this->namespace)
		     ->group(base_path('routes/teens.php'));
	}

	/**
	 * These routes are for the elderly ageGroup
	 *
	 * @return void
	 */
	protected function mapElderlyRoutes()
	{
		Route::middleware('web')
		     ->namespace($this->namespace)
		     ->group(base_path('routes/elderly.php'));
	}

	/**
	 * These routes are for the seniors ageGroup
	 *
	 * @return void
	 */
	protected function mapSeniorRoutes()
	{
		Route::middleware('web')
		     ->namespace($this->namespace)
		     ->group(base_path('routes/seniors.php'));
	}

	/**
	 * These routes are for the seniors ageGroup
	 *
	 * @return void
	 */
	protected function mapDefaultRoutes()
	{
		Route::middleware('web')
		     ->namespace($this->namespace)
		     ->group(base_path('routes/default.php'));
	}

	/**
	 * These routes are for the admins
	 *
	 * @return void
	 */
	protected function mapAdminRoutes()
	{
		Route::middleware('web')
		     ->namespace($this->namespace)
		     ->group(base_path('routes/admin.php'));
	}
}
