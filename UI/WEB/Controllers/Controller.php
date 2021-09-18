<?php

namespace Apiato\Containers\Documentation\UI\WEB\Controllers;

use Apiato\Containers\Documentation\UI\WEB\Requests\GetPrivateDocumentationRequest;
use Apiato\Containers\Documentation\UI\WEB\Requests\GetPublicDocumentationRequest;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function showPrivateDocs(GetPrivateDocumentationRequest $request)
    {
        return view('vendor@documentation::documentation.private.index');
    }

    public function showPublicDocs(GetPublicDocumentationRequest $request)
    {
        return view('vendor@documentation::documentation.public.index');
    }
}
