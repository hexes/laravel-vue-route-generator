<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class GenerateRoutesFile extends Command
{
    protected $signature = 'generate:routes-file
                            {--middleware=web,api : Comma-separated list of middleware to include (default: web,api)}
                            {--output=resources/js/routes.js : The output file for the routes (default: resources/js/routes.js)}';

    protected $description = 'Generate routes.js file from Laravel routes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $middleware = $this->option('middleware') ?: 'web,api';
        $middlewares = explode(',', $middleware);

        $outputPath = $this->option('output') ?: resource_path('js/routes.js');

        $routes = collect(Route::getRoutes())->filter(function ($route) use ($middlewares) {
            return count(array_intersect($middlewares, $route->middleware())) > 0;
        })->mapWithKeys(function ($route) {
            $name = $route->getName();
            if (str_contains($name, 'generated::') || str_contains($route->uri(), 'telescope')) {
                return [];
            }
            return [$name => $route->uri()];
        })->toArray();

        $routesJson = json_encode($routes, JSON_PRETTY_PRINT);

        $content = <<<EOT
export const routes = $routesJson;

export default function route(name, params = {}) {
    let path = routes[name] || '#';

    // Replace placeholders with actual values from params
    Object.keys(params).forEach(key => {
        path = path.replace(`{` + key + `}`, params[key]);
    });

    return path;
}
EOT;

        File::put($outputPath, $content);

        $this->info('Routes file generated successfully.');
    }
}
