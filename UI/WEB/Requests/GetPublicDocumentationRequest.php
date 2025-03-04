<?php

namespace App\Containers\Vendor\Documentation\UI\WEB\Requests;

use Apiato\Core\Requests\Request as AbstractRequest;

class GetPublicDocumentationRequest extends AbstractRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [];
    }
}
