# Laravel Vue Route Generator

A package to generate and manage routes for Vue applications from Laravel routes.

## Features

- Generates a JSON file with Laravel routes
- Provides a simple Vue.js utility for accessing these routes
- Includes an Artisan command to regenerate the routes file

## Installation

### 1. Install via NPM

Run the following command to install the package:

npm install vue-route-generator --save

### 2. Add Laravel Service Provider

Add the service provider to the `providers` array in `config/app.php`:

'providers' => [
    // ...
    App\Providers\RouteServiceProvider::class,
],

## Usage

### 1. Run the Artisan Command

To generate the `routes.js` file, run the following Artisan command:

php artisan generate:routes-file

This will create a `routes.js` file in the `resources/js` directory of your Laravel project.

### 2. Import and Use in Vue.js

In your Vue.js components, you can import the route utility and use it to get URLs.

Example Component:

<template>
  <div>
    <a :href="getRoute('auth.signin')">Sign In</a>
  </div>
</template>

<script>
import { route } from 'vue-route-generator/dist/index.js';

export default {
  methods: {
    getRoute(name) {
      return route(name);
    }
  }
}
</script>

### 3. Adding Routes

Make sure your Laravel routes are named appropriately in your `web.php` and `api.php` files.

Example Web Routes (web.php):

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Example API Routes (api.php):

use Illuminate\Support\Facades\Route;

Route::post('/auth/signin', 'AuthController@signin')->name('auth.signin');
Route::post('/auth/signup', 'AuthController@signup')->name('auth.signup');

### 4. Re-generate Routes File

Whenever you add new routes, run the Artisan command again to update the `routes.js` file:

php artisan generate:routes-file

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any bugs or feature requests.

## License

This project is licensed under the MIT License. See the LICENSE file for details.
