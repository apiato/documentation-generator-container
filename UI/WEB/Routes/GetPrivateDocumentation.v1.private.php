<?php

use App\Containers\VendorSection\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

if (config('vendorSection-documentation.protect-private-docs')) {
    Route::get('docs/private', [Controller::class, 'showPrivateDocs'])
        ->name('private_docs')
        ->middleware('auth:web');
} else {
    Route::get('docs/private', [Controller::class, 'showPrivateDocs'])
        ->name('private_docs');
}
