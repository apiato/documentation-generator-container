<?php

namespace App\Containers\Vendor\Documentation\UI\CLI\Commands;

use App\Containers\Vendor\Documentation\Actions\GenerateDocumentationAction;
use Apiato\Core\Abstracts\Commands\ConsoleCommand as AbstractConsoleCommand;

class GenerateApiDocsCommand extends AbstractConsoleCommand
{
	protected $signature = "apiato:apidoc";

	protected $description = "Generate API Documentations with (API-Doc-JS)";

	public function handle(): void
	{
		app(GenerateDocumentationAction::class)->run($this);
	}
}
