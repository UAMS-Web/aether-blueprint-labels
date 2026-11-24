Written against the unreleased `main` branch.

## Create-entry labels

A collection's create-entry button and page title read their text from the application's `messages` translations, and the add-on lets a blueprint choose a different text. The Control Panel passes the blueprint to the create page as the `blueprint` query parameter, and the add-on reads it.

| Translation key | Used when | Effect |
| --- | --- | --- |
| `messages.<collection>_collection_create_entry.<blueprint>` | The request's `blueprint` is that blueprint's handle | The label for that blueprint |
| `messages.<collection>_collection_create_entry` | No blueprint is requested, or the blueprint has no translation | The label for the collection |
| (none) | Neither key has a translation | `Create Entry` |

A translation that is not a string, such as a nested array, is skipped as if it were missing, so the label is always text. A `blueprint` parameter that is empty or is not a string is ignored.

## Create-term labels

A taxonomy's create-term button works the same way, with the taxonomy's handle and `_taxonomy_create_term` in place of the collection's and `_collection_create_entry`.

| Translation key | Used when | Effect |
| --- | --- | --- |
| `messages.<taxonomy>_taxonomy_create_term.<blueprint>` | The request's `blueprint` is that blueprint's handle | The label for that blueprint |
| `messages.<taxonomy>_taxonomy_create_term` | No blueprint is requested, or the blueprint has no translation | The label for the taxonomy |
| (none) | Neither key has a translation | `Create Term` |

## Example

Write each key as a flat key, with the blueprint after a dot, in the application's `lang/en/messages.php`:

```php
// lang/en/messages.php
return [
    'pages_collection_create_entry' => 'Create Page',
    'pages_collection_create_entry.news' => 'Create News Article',
];
```

The `pages` collection's create button then reads `Create News Article` for the `news` blueprint and `Create Page` for every other blueprint.

The `tags` taxonomy takes the same shape:

```php
// lang/en/messages.php
return [
    'tags_taxonomy_create_term' => 'Create Tag',
    'tags_taxonomy_create_term.topic' => 'Create Topic Tag',
];
```
