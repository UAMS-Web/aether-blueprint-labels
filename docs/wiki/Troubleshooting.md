Written against the unreleased `main` branch.

One entry per symptom, as you meet it: the behavior, its cause, and the fix.

- [The create page still says Create Entry or Create Term](#the-create-page-still-says-create-entry-or-create-term)
- [A blueprint shows the plain label instead of its own](#a-blueprint-shows-the-plain-label-instead-of-its-own)
- [Another package also replaces the collection or taxonomy class](#another-package-also-replaces-the-collection-or-taxonomy-class)
- [Fixed](#fixed)

## The create page still says Create Entry or Create Term

The create page shows Statamic's stock text although `lang/en/messages.php` holds a key.

**Cause:** no key matches. The key is built from the handle, not the title: `<collection handle>_collection_create_entry` for a collection and `<taxonomy handle>_taxonomy_create_term` for a taxonomy. A key whose value is not a string, such as a nested array, is skipped as if it were missing.

**Fix:** check the handle in the collection's or taxonomy's configuration, write the key flat in the `messages` file for the Control Panel's locale, and give it a string value. See [Reference](Reference.md).

## A blueprint shows the plain label instead of its own

The create page reads the plain label (for example "Create Page") for a blueprint that has its own key.

**Cause:** the key's last part is not the blueprint's handle, or the key is nested. The add-on reads `<key>.<blueprint>` as one flat key, using the `blueprint` parameter in the page's address.

**Fix:** copy the handle from the address (`?blueprint=news`) into the key, and write the key flat:

```php
'pages_collection_create_entry.news' => 'Create News Article',
```

## Another package also replaces the collection or taxonomy class

The label never changes, and the application or another add-on also replaces how Statamic builds collections or taxonomies.

**Cause:** the add-on rebinds `Statamic\Contracts\Entries\Collection` and `Statamic\Contracts\Taxonomies\Taxonomy` to its own classes. When two packages bind the same contract, the one that binds last wins.

**Fix:** keep one package binding each contract. The reasoning is in the [decision log](https://github.com/UAMS-Web/aether-blueprint-labels/blob/main/docs/DECISIONS.md).

## Fixed

Problems fixed in a release stay here, with the release that fixed them, instead of being deleted. None yet.
