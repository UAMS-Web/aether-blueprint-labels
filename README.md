# Aether Blueprint Labels

A Statamic add-on that shows a label chosen by the blueprint on the Control Panel's create-entry and create-term buttons, without patching `statamic/cms`.

It is the interim home for two behaviors that `UAMS-Web/patches-statamic-cms` carries as patches while they are offered upstream, so a site can drop the patches before a `statamic/cms` release carries the behavior. The create-entry label is built; the create-term label lands in its own ticket.

## Requirements

- PHP 8.4 or later
- Statamic 6.35 or later

## Installation

```bash
composer require uams-web/aether-blueprint-labels
```

The floors are under [Requirements](#requirements). Statamic discovers the add-on through `extra.statamic` and the service provider through `extra.laravel.providers` in `composer.json`; there is nothing to register by hand. The add-on has no settings, so it publishes no configuration file.

## Create-entry labels

A collection's create-entry label reads `messages.<collection>_collection_create_entry.<blueprint>` for the blueprint the Control Panel passes in the `blueprint` query parameter, then `messages.<collection>_collection_create_entry`, then `Create Entry`. Write the keys as flat keys in `lang/en/messages.php`:

```php
return [
    'pages_collection_create_entry' => 'Create Page',
    'pages_collection_create_entry.news' => 'Create News Article',
];
```

The wiki's [Reference](docs/wiki/Reference.md) lists the cases.

## Documentation

- [Development guide](docs/DEVELOPMENT.md): exercising the add-on in a Statamic host, and running the host-bound tests.
- [Submission checklist](docs/SUBMISSION.md): the Packagist and Marketplace steps.
- [Decision log](docs/DECISIONS.md): why the repository is the way it is, with the alternatives that lost.
- The wiki, published from [`docs/wiki/`](docs/wiki/) on each release.

Contributions follow [`CONTRIBUTING.md`](CONTRIBUTING.md). The add-on's license is MIT. See [`LICENSE`](LICENSE).
