Written against the unreleased `main` branch.

A taxonomy's create-term label follows its blueprint the same way a collection's create-entry label does. This guide gives the `tags` taxonomy a "Create Topic Tag" label for its `topic` blueprint.

## Steps

1. Open `lang/en/messages.php` in the site.
2. Add the plain label, named `<taxonomy handle>_taxonomy_create_term`:

   ```php
   'tags_taxonomy_create_term' => 'Create Tag',
   ```

3. Add the label for the blueprint, the same key with a dot and the blueprint's handle:

   ```php
   'tags_taxonomy_create_term.topic' => 'Create Topic Tag',
   ```

4. Open the `tags` taxonomy in the Control Panel and choose the `topic` blueprint. The create page reads "Create Topic Tag"; every other blueprint reads "Create Tag".

Leave out step 2 and the other blueprints read Statamic's stock `Create Term`.

## Reference

- [Reference](Reference.md): the keys, the order they are read in, and what is skipped.
