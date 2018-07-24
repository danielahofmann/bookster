<?php

Route::prefix('default')->group(function() {
	Route::home('default');
	Route::login('default');
	Route::dashboard('default');
	Route::dashboardUser('default');
	Route::dashboardOrders('default');
	Route::dashboardOrderDetails('default');
	Route::category('default');
	Route::product('default');
	Route::wishlist('default');
	Route::cart('default');
	Route::checkout('default');

	Route::get( '/register', function () {
		return view( 'age-layouts.default.register' );
	} )->name( 'default-register' );

	Route::post('register', 'Auth\RegisterController@register');


	Route::get('/order', function() {
		$oldCart = Session::get('cart');
		$cart = new App\Cart($oldCart);

		$customer_id = \Illuminate\Support\Facades\Auth::user()->id;
		$customer = \App\Customer::find($customer_id);

		$billAddress = null;
		$deliveryAddress = null;

		if(Session::has('billAddress')){
			$billAddress = Session::get('billAddress');
		}

		if(Session::has('deliveryAddress')){
			$deliveryAddress = Session::get('deliveryAddress');
		}


		return view('age-layouts.default.order', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'customer' => $customer, 'bill' => $billAddress, 'delivery' => $deliveryAddress]);
	})->name('default-order');

	Route::get('/order-success', function (){
		return view('age-layouts.default.order-success');
	})->name('default-order-success');

	Route::get('/help', function (){
		return view('age-layouts.default.help');
	})->name('default-help');

	Route::get('/help/delivery', function (){
		return view('age-layouts.default.help-delivery');
	})->name('default-help-delivery');

	Route::get('/help/payment', function (){
		return view('age-layouts.default.help-payment');
	})->name('default-help-payment');

	Route::get('/help/retoure', function (){
		return view('age-layouts.default.help-retoure');
	})->name('default-help-retoure');

	Route::get('/help/order', function (){
		return view('age-layouts.default.help-order');
	})->name('default-help-order');

	Route::get('/results', function (){
		return view('age-layouts.default.results');
	})->name('default-results');

	Route::get('/contact', function (){
		return view('age-layouts.default.contact');
	})->name('default-contact');

	Route::get('/about', function (){
		return view('age-layouts.default.about');
	})->name('default-about');

});
