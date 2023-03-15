<?php

use App\Containers\Vendor\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

if (config('vendor-documentation.types.private.url')) {
    if (config('vendor-documentation.protect-private-docs')) {
        Route::get(config('vendor-documentation.types.private.url'), [Controller::class, 'showPrivateDocs'])
            ->name('private_docs')
            ->middleware('auth:web');
    } else {
        Route::get(config('vendor-documentation.types.private.url'), [Controller::class, 'showPrivateDocs'])
            ->name('private_docs');
    }
}
