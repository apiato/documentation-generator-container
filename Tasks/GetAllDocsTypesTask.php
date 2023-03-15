<?php

namespace App\Containers\Vendor\Documentation\Tasks;

use App\Containers\Vendor\Documentation\Exceptions\NoDocTypesFoundException;
use Apiato\Core\Abstracts\Tasks\Task as AbstractTask;

class GetAllDocsTypesTask extends AbstractTask
{
    /**
     * @throws NoDocTypesFoundException
     */
    public function run(): array
    {
        if (!$configTypes = config('vendor-documentation.types')) {
            throw new NoDocTypesFoundException();
        }

        $types = [];
        foreach ($configTypes as $key => $value) {
            $types[] = $key;
        }

        // NOTE: type names must be the same as in the objects property (`public static $type = 'private';`)
        return $types;
    }
}
