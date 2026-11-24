Written against the unreleased `main` branch.

By the end of this page the `pages` collection's create page reads "Create News Article" when it is opened for the `news` blueprint, and "Create Page" for every other blueprint.

It assumes the add-on is installed (see [Installation (README)](https://github.com/UAMS-Web/aether-blueprint-labels#installation)) in a Statamic 6 site with a `pages` collection that has two blueprints, one with the handle `news`. Use your own collection and blueprint handles in place of those.

## 1. Add the plain label

Open `lang/en/messages.php` in the site and add a key named from the collection's handle:

```php
return [
    'pages_collection_create_entry' => 'Create Page',
];
```

The key is `<collection handle>_collection_create_entry`. It is the label for every blueprint of the collection that has none of its own. Without it the label is Statamic's stock `Create Entry`.

## 2. Add the label for one blueprint

Add a second key, the same name with a dot and the blueprint's handle after it:

```php
return [
    'pages_collection_create_entry' => 'Create Page',
    'pages_collection_create_entry.news' => 'Create News Article',
];
```

**Note:** write the key flat, exactly as shown. A nested array (`'pages_collection_create_entry' => ['news' => '...']`) is skipped, and the label falls back.

## 3. Open the create page

In the Control Panel, open the `pages` collection and choose the `news` blueprint. The create page opens with `?blueprint=news` in its address, and its label reads "Create News Article". Any other blueprint reads "Create Page".

**Note:** this page was written from the add-on's tests and Statamic's source, not from a Control Panel run. Report a difference on the [issue tracker](https://github.com/UAMS-Web/aether-blueprint-labels/issues).

## Go further

- [Label a taxonomy's create button](Label-a-taxonomys-create-button.md): the same for a taxonomy.
- [Reference](Reference.md): every key and the order they are read in.
- [Troubleshooting](Troubleshooting.md): the label does not change.
