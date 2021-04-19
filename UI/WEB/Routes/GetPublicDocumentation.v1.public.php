<?php

use App\Containers\VendorSection\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get(config('vendorSection-documentation.types.public.url'), [Controller::class, 'showPublicDocs'])
	->name('public_docs');
