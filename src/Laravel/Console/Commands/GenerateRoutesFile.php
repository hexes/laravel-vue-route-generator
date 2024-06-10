<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use File;

class GenerateRoutesFile extends Command
{
    protected $signature = 'generate:routes-file';
    protected $description = 'Generate routes.js file from Laravel routes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $routes = collect(Route::getRoutes())->filter(function ($route) {
            // Only include routes with 'web' or 'api' middleware
            return in_array('web', $route->middleware()) || in_array('api', $route->middleware());
        })->mapWithKeys(function ($route) {
            $name = $route->getName();
            // Filter out Telescope routes and generated routes with random strings
            if (str_contains($name, 'generated::') || str_contains($route->uri(), 'telescope')) {
                return [];
            }
            return [$name => $route->uri()];
        })->toArray();

        $routesJson = json_encode($routes, JSON_PRETTY_PRINT);

        $content = <<<EOT
// resources/js/routes.js
export const routes = $routesJson;
EOT;

        File::put(resource_path('js/routes.js'), $content);

        $this->info('Routes file generated successfully.');
    }
}