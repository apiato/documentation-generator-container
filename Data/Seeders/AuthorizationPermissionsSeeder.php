<?php

namespace App\Containers\VendorSection\Documentation\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationPermissionsSeeder extends Seeder
{
	public function run(): void
	{
		app(CreatePermissionTask::class)->run('access-private-docs', 'Access the private docs.');
	}
}
