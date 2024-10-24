# Twig extension (for) Vite

Built on top of [PHP-Vite](https://github.com/mindplay-dk/php-vite) and heavily inspired
by [vite-php-twig](https://github.com/userfrosting/vite-php-twig).

Adds support for [Vite](https://vite.dev) to [Twig](https://twig.symphony.com).

## Features

### Functions

1) Get URL for entry

```twig
{{ vite_url("src/app.tsx") }}
{* More practically, use in link tag: *}
<link rel="stylesheet" href="{{vite_url("src/app.css")}}" />
```

2) Load all styles/scripts/preloads for entry (entries)

```twig
{*Load all preloads*}
{{ vite_preloads("entryfile.js", "entryfile_2.js") }}

{*Load all styles*}
{{ vite_styles("entryfile.js") }}

{*Load all scripts*}
{{ vite_scripts("entryfile.js") }}
```

### Filters

1) Get URL for entry

```twig
{{"src/index.tsx"|vite}}
```

### Globals

| key            | description                   | default                  |
|----------------|-------------------------------|--------------------------|
| vite.devMode   | Indicates if dev mode is used | `false`                  |
| vite.basePath  | Base path                     | `/`                      |
| vite.devServer | address of dev server         | `http://localhost:5173/` |

## Installation

install via composer (for now not on packagist.org)

``
    composer require danbrada/twig-extenstion-vite
``

## Setup

Add it to your twig environment

```php
$environment = new \Twig\Environment($loader);

$environment->addExtension(new \DanBrada\TwigVite\TwigViteExtension(
    // this is only required parameter
    manifestPath: __DIR__."/path/to/manifest.json",
    // rest is optional, and these are default values
    basePath: "/",
    devServer: "http://localhost:5173/",
    devMode: false, 
));

```


