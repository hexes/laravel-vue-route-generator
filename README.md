# Laravel Vue Route Generator

A package to generate and manage routes for Vue applications from Laravel routes.

## Features

- Generates a JSON file with Laravel routes
- Provides a simple Vue.js utility for accessing these routes
- Supports dynamic route parameters
- Includes an Artisan command to regenerate the routes file

## Installation

### 1. Install via NPM

Run the following command to install the package:
```bash
npm install laravel-vue-route-generator --save
```
### 2. Add Laravel Service Provider

Add the service provider to the `providers` array in `config/app.php`:
```php
'providers' => [
    // ...
    App\Providers\RouteServiceProvider::class,
],
```
## Usage

### 1. Set Up Directory Structure

Run the following command to set up the necessary directory structure:

npm run setup

This will copy the example `services` directory to `resources/js/services`.

### 2. Run the Artisan Command

To generate the `routes.js` file, run the following Artisan command:
```bash
php artisan generate:routes-file
```
This will create a `routes.js` file in the `resources/js` directory of your Laravel project.

### 3. Import and Use the Plugin in `app.js`

In your `app.js` file, import and use the plugin:
```js
// resources/js/app.js
import { createApp } from 'vue';
import App from './App.vue';
import { laravelVueRoute } from 'laravel-vue-route-generator';

const app = createApp(App);

app.use(laravelVueRoute);

app.mount('#app');
```
### 4. Use the Global Route Function in Your Components

You can now use the global `route` function in your components without needing to import it each time:
```php
<template>
  <div>
    <a :href="route('home')">Home</a>
    <a :href="route('contact')">Contact</a>
    <a :href="route('profile', { userId: '12345' })">Profile</a>
  </div>
</template>
```
### 5. Adding Routes

Make sure your Laravel routes are named appropriately in your `web.php` and `api.php` files.

#### Example Web Routes (`web.php`)
```php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/profile/{userId}', function ($userId) {
    // Profile logic here
})->name('profile');
```
#### Example API Routes (`api.php`)
```php
use Illuminate\Support\Facades\Route;

Route::post('/auth/signin', 'AuthController@signin')->name('auth.signin');
Route::post('/auth/signup', 'AuthController@signup')->name('auth.signup');
```
### 6. Re-generate Routes File

Whenever you add new routes, run the Artisan command again to update the `routes.js` file:
```bash
php artisan generate:routes-file
```
## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any bugs or feature requests.

## License

This project is licensed under the MIT License. See the LICENSE file for details.
