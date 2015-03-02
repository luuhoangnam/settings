# Getting Stared

Provide a very flexible way to interact with app settings (not laravel config).

**Note**: The package is only support Laravel 5

# Installation

**Step 1**: Install package
```bash
composer require namest/settings
```

**Step 2**: Register service provider in your `config/app.php`
```php
return [
    ...
    'providers' => [
        ...
        'Namest\Settings\SettingsServiceProvider',
    ],
    ...
    'aliases' => [
        ...
        'Setting' => 'Namest\Settings\Facades\Setting',
    ],
];
```

**Step 3**: Publish package resources, include: configs, migrations. Open your terminal and type:
```bash
php artisan vendor:publish --provider="Namest\Settings\SettingsServiceProvider"
```

**Step 4**: Migrate the migration that have been published
```bash
php artisan migrate
```

**Step 5**: Add some setting key/value pairs in `settings` table in your database

**Step 6**: Read API below and start _happy_

# API

Three way to start to use:

**First way**: New setting instance
```
$settings = new Namest\Settings\Repository;
```

**Second way**: Via facade like this
```
Setting::get($key);
Setting::set($key, $value);
```

**Third way**: Via injected contract. For example in controller:
```
namespace ...;

use Namest\Settings\Contracts\Repository as Settings;

class UsersController extends Controller 
{
    private $settings;

    public function __construct(Settings $settings) 
    {
        $this->settings = $settings;
    }
    
    public function index()
    {
        $limit = $this->settings->limit;
    }
    
    // Or injects via method
    public function show(Settings $settings) 
    {
        $limit = $settings->limit;
    }
    
}
```

```php
// Return all settings
Setting::all();
$settings->all();

// Check setting exists
Setting::has($key);
isset($settings[$key]);
array_key_exists($key, $settings);

// Get setting value from key
Setting::get($key, $default); // Via facade
setting($key, $default); // Via helper function
$settings[$key]; // Via array access
$settings->$key; // Via object access. Example: $limit = $settings->limit;

// Set setting value
Setting::set($key, $value);
$settings[$key] = $value;
$settings->$key = $value;
```

```php
// Reload preloaded settings
Setting::preload();
```