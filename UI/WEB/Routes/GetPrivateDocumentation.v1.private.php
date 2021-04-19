<?php

use App\Containers\VendorSection\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

if (config('vendorSection-documentation.protect-private-docs')) {
	Route::get(config('vendorSection-documentation.types.private.url'), [Controller::class, 'showPrivateDocs'])
		->name('private_docs')
		->middleware('auth:web');
} else {
	Route::get(config('vendorSection-documentation.types.private.url'), [Controller::class, 'showPrivateDocs'])
		->name('private_docs');
}
