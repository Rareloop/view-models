**This package is deprecated. View Models are now baked into the Lumberjack core.**

# View Models

Here, a `ViewModel` refers to something that takes data and transforms it into the correct format for a specific view. They are **input-output machines**.

For example, for this `twig` view:

```twig
{% for link in links %}
    <a href="{{ link.url }}">{{ link.title }}</a>
{% endfor %}
```

You will need to construct an array that looks like this (e.g. in your controller):

```php
// Get pages from the database somehow
$pages = Page::all();

$data = ['links' => []];

foreach ($pages as $page) {
    // Map the page to the correct structure for the view
    $data['links'][] = [
        'url' => $page->permalink,
        'title' => $page->post_title,
    ];
}
```

**  ViewModels abstract away that transformation. This means you don't have to duplicate that transformation logic across multiple controllers, making your code eaiser to change.**

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: 12 Basepoint, Andersons Road, Southampton, Hampshire, SO14 5FE.

## Installation

You can install the package via composer:

```bash
composer require rareloop/view-models
```

### View Model Usage

They should always return an array. The easiest way to achieve this is to run your data through the `compose` method on the View Model.

They should **not** fetch data from anywhere (e.g. database). This is the job of a `ViewModelComposer`.

Using an example `ViewModel` (e.g. in a controller):

``` php
$params = new ParameterBag([
    'links' => [
        'https://google.com',
        'https://rareloop.com',
    ],
]);

$context['links'] = \App\ViewModels\Links::make($params);
```

Here is an example `ViewModel` implementation:

```php
namespace App\ViewModels\Links;

use Rareloop\ViewModels\ParameterBag;
use Rareloop\ViewModels\ViewModel;

class Links extends ViewModel
{
    public static function make(ParameterBag $params): array
    {
        // Transform the data into the correct structure
        $data = array_map(function ($item) {
            return [
                'url' => $item['ID'],
            ];
        }, $params->links);

        // Make sure the data is an array
        return static::compose($data);
    }
}
```

### Introducing View Model Composers

A `ViewModelComposer` is simply a wrapper around a `ViewModel`, but is only concerned how to get data ready for a `ViewModel`.

These should be used instead of duplicating logic when creating `ViewModel`s (e.g. in controllers).

Example `ViewModelComposer` implementation:

```php
class RelatedLinks
{
    public static function make(): array
    {
        // e.g. you could get the data out of the database for the related links for this page
        $args = new ParameterBag([
            'links' => [
                'http://google.com',
                'https://rareloop.com',
            ],
        ]);

        return Links::make($args);
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email info@rareloop.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
