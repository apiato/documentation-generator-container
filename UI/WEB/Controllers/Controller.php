<?php

namespace App\Containers\VendorSection\Documentation\UI\WEB\Controllers;

use App\Containers\VendorSection\Documentation\UI\WEB\Requests\GetPrivateDocumentationRequest;
use App\Containers\VendorSection\Documentation\UI\WEB\Requests\GetPublicDocumentationRequest;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function showPrivateDocs(GetPrivateDocumentationRequest $request)
    {
        return view('vendorSection@documentation::documentation.private.index');
    }

    public function showPublicDocs(GetPublicDocumentationRequest $request)
    {
        return view('vendorSection@documentation::documentation.public.index');
    }
}
