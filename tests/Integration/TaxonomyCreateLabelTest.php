<?php

declare(strict_types=1);

use Statamic\Facades\Taxonomy as TaxonomyFacade;
use UAMSWeb\Aether\BlueprintLabels\Taxonomies\Taxonomy;

/**
 * A taxonomy's create-term label follows the `blueprint` query parameter.
 *
 * The translations are set as flat keys, the way a `lang/en/messages.php` file
 * holds them, because the translator's own `addLines()` would nest a key that
 * contains a dot.
 *
 * @command  vendor/bin/pest tests/Integration/TaxonomyCreateLabelTest.php
 */

/**
 * The create-term label of a taxonomy made by Statamic.
 *
 * @param  string  $handle  The taxonomy's handle.
 * @return string The label.
 */
function taxonomyLabel(string $handle): string
{
    /** @var Taxonomy $taxonomy */
    $taxonomy = TaxonomyFacade::make($handle);

    return $taxonomy->createLabel();
}

it('makes every taxonomy the add-on subclass', function (): void {
    // Expect Statamic to build the add-on's class, which stock Statamic does not
    expect(TaxonomyFacade::make('tags'))->toBeInstanceOf(Taxonomy::class);
});

it('shows the stock label when no translation exists', function (): void {
    // Set no translations and no blueprint
    setMessages([]);
    requestBlueprint(null);

    // Expect the stock label
    expect(taxonomyLabel('tags'))->toBe('Create Term');
});

it("shows the plain key's label when the request names no blueprint", function (): void {
    // Set a plain and a per-blueprint translation, and request no blueprint
    setMessages([
        'tags_taxonomy_create_term' => 'Create Tag',
        'tags_taxonomy_create_term.topic' => 'Create Topic Tag',
    ]);
    requestBlueprint(null);

    // Expect the plain label
    expect(taxonomyLabel('tags'))->toBe('Create Tag');
});

it('shows the per-blueprint label when the request names that blueprint', function (): void {
    // Set a plain and a per-blueprint translation, and request the blueprint
    setMessages([
        'tags_taxonomy_create_term' => 'Create Tag',
        'tags_taxonomy_create_term.topic' => 'Create Topic Tag',
    ]);
    requestBlueprint('topic');

    // Expect the per-blueprint label
    expect(taxonomyLabel('tags'))->toBe('Create Topic Tag');
});

it('falls back to the plain key when the blueprint has no translation', function (): void {
    // Set only the plain translation, and request a blueprint without one
    setMessages(['tags_taxonomy_create_term' => 'Create Tag']);
    requestBlueprint('topic');

    // Expect the plain label
    expect(taxonomyLabel('tags'))->toBe('Create Tag');
});

it('falls back to Create Term when the blueprint has no translation and neither does the plain key', function (): void {
    // Set no translations, and request a blueprint
    setMessages([]);
    requestBlueprint('topic');

    // Expect the stock label
    expect(taxonomyLabel('tags'))->toBe('Create Term');
});

it('falls back to Create Term when the plain translation is not a string', function (): void {
    // Set the plain key to an array, which stock Statamic would return as is
    setMessages(['tags_taxonomy_create_term' => ['topic' => 'Create Topic Tag']]);
    requestBlueprint(null);

    // Expect the stock label, never the array
    expect(taxonomyLabel('tags'))->toBe('Create Term');
});

it('falls back to the plain key when the blueprint translation is not a string', function (): void {
    // Set the per-blueprint translation to an array
    setMessages([
        'tags_taxonomy_create_term' => 'Create Tag',
        'tags_taxonomy_create_term.topic' => ['x' => 'y'],
    ]);
    requestBlueprint('topic');

    // Expect the plain label
    expect(taxonomyLabel('tags'))->toBe('Create Tag');
});

it('ignores a blueprint parameter that is not a string', function (): void {
    // Set translations, and request the blueprint as an array
    setMessages([
        'tags_taxonomy_create_term' => 'Create Tag',
        'tags_taxonomy_create_term.topic' => 'Create Topic Tag',
    ]);
    requestBlueprint(['topic']);

    // Expect the plain label
    expect(taxonomyLabel('tags'))->toBe('Create Tag');
});

it('ignores an empty blueprint parameter', function (): void {
    // Set translations, including one under an empty blueprint name
    setMessages([
        'tags_taxonomy_create_term' => 'Create Tag',
        'tags_taxonomy_create_term.' => 'Never shown',
    ]);
    requestBlueprint('');

    // Expect the plain label
    expect(taxonomyLabel('tags'))->toBe('Create Tag');
});

it("reads each taxonomy's own keys", function (): void {
    // Set a translation for one taxonomy only
    setMessages(['tags_taxonomy_create_term' => 'Create Tag']);
    requestBlueprint(null);

    // Expect the other taxonomy to keep the stock label
    expect(taxonomyLabel('topic'))->toBe('Create Term');
});
