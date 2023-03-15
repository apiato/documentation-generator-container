<?php

use App\Containers\Vendor\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

if (config('vendor-documentation.types.public.url')) {
    Route::get(config('vendor-documentation.types.public.url'), [Controller::class, 'showPublicDocs'])
        ->name('public_docs');
}
