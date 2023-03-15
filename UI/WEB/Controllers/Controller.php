<?php

namespace App\Containers\Vendor\Documentation\UI\WEB\Controllers;

use App\Containers\Vendor\Documentation\UI\WEB\Requests\GetPrivateDocumentationRequest;
use App\Containers\Vendor\Documentation\UI\WEB\Requests\GetPublicDocumentationRequest;
use Apiato\Core\Abstracts\Controllers\WebController as AbstractWebController;

class Controller extends AbstractWebController
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
