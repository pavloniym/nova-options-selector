# Nova Options Selector

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pavloniym/nova-options-selector.svg?style=flat-square)](https://packagist.org/packages/pavloniym/nova-options-selector)

This [Laravel Nova](https://nova.laravel.com) package adds an options selector to Nova's arsenal of fields.

## Requirements

- `php: >=8.0`
- `laravel/nova: ^4.1`

## Installation

Install the package in a Laravel Nova project via Composer:

```bash
composer require pavloniym/nova-options-selector
```

## Usage

```php
use Pavlonym\OptionsSelector\OptionsSelector;

public function fields(Request $request)
{
    return [
      OptionsSelector::make('Permissions', 'permissions')
        ->options([
            [
                'group' => [
                    'title' => 'Account permissions',
                ],
                'entries' => [
                    [
                        'key' => 'account:update',
                        'title' => 'Update account',
                        'description' => 'User can update any account in database'
                    ],
                    [
                        'key' => 'account:selfDelete',
                        'title' => 'Delete self account'
                    ],
                ]
            ],
            // ...
        ])

        // Optional:
         ->searchable() // show search bar on form and detail views
        ->setGridColumns(5) // set columns of groups
        ->setGridColumnsGap('2rem')  // set gap between columns
        ->setMaxRowWidthOnIndex('200px') // set max with on index field
    ];
}
```

## License

This project is open-sourced software licensed under the [MIT license](LICENSE.md).