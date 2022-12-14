# Nova Options Selector

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pavloniym/nova-options-selector.svg?style=flat-square)](https://packagist.org/packages/pavloniym/nova-options-selector)

This [Laravel Nova](https://nova.laravel.com) package adds an options selector to Nova's arsenal of fields.

![Nova Options Selector](https://raw.githubusercontent.com/pavloniym/nova-options-selector/main/.github/assets/screenshot1.png)

## Requirements

- `php: >=8.0`
- `laravel/nova: ^4.1`

## Installation

Install the package in a Laravel Nova project via Composer:

```bash
composer require pavloniym/nova-options-selector
```

## Usage

> Model field should be casted as array

```php
use Pavloniym\OptionsSelector\OptionsSelector;

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
        ->setGridColumnsGap(4)  // set gap between columns
        ->setGridColumnsWidth(250) // set grid columns width in pixels
        ->setMaxRowWidthOnIndex('200px') // set max with on index field
    ];
}
```

## License

This project is open-sourced software licensed under the [MIT license](LICENSE.md).
