<?php

namespace App\Containers\VendorSection\Documentation\Traits;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\AppSection\User\Models\User;

trait HasDocAccessTrait
{
    /**
     * Check if the authenticated user has proper
     * roles/permissions to access the private docs
     */
    public function hasDocAccess(): bool
    {
        if (config('vendorSection-documentation.protect-private-docs')) {
	        $user = app(GetAuthenticatedUserTask::class)->run();
            if ($user !== null) {
                if ($user->hasAnyRole(['admin'])) {
                    return true;
                }
                if ($user->checkPermissionTo('access-private-docs')) {
                    return true;
                }
            }
            return false;
        }

        return true;
    }
}
