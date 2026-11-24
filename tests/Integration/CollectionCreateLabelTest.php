<?php

declare(strict_types=1);

use Statamic\Facades\Collection as CollectionFacade;
use UAMSWeb\Aether\BlueprintLabels\Entries\Collection;

/**
 * A collection's create-entry label follows the `blueprint` query parameter.
 *
 * The translations are set as flat keys, the way a `lang/en/messages.php` file
 * holds them, because the translator's own `addLines()` would nest a key that
 * contains a dot.
 *
 * @command  vendor/bin/pest tests/Integration/CollectionCreateLabelTest.php
 */
it('makes every collection the add-on subclass', function (): void {
    // Expect Statamic to build the add-on's class, which stock Statamic does not
    expect(CollectionFacade::make('pages'))->toBeInstanceOf(Collection::class);
});

it('shows the stock label when no translation exists', function (): void {
    // Set no translations and no blueprint
    setMessages([]);
    requestBlueprint(null);

    // Expect the stock label
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create Entry');
});

it("shows the plain key's label when the request names no blueprint", function (): void {
    // Set a plain and a per-blueprint translation, and request no blueprint
    setMessages([
        'pages_collection_create_entry' => 'Create Page',
        'pages_collection_create_entry.news' => 'Create News Article',
    ]);
    requestBlueprint(null);

    // Expect the plain label
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create Page');
});

it('shows the per-blueprint label when the request names that blueprint', function (): void {
    // Set a plain and a per-blueprint translation, and request the blueprint
    setMessages([
        'pages_collection_create_entry' => 'Create Page',
        'pages_collection_create_entry.news' => 'Create News Article',
    ]);
    requestBlueprint('news');

    // Expect the per-blueprint label
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create News Article');
});

it('falls back to the plain key when the blueprint has no translation', function (): void {
    // Set only the plain translation, and request a blueprint without one
    setMessages(['pages_collection_create_entry' => 'Create Page']);
    requestBlueprint('news');

    // Expect the plain label
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create Page');
});

it('falls back to Create Entry when the blueprint has no translation and neither does the plain key', function (): void {
    // Set no translations, and request a blueprint
    setMessages([]);
    requestBlueprint('news');

    // Expect the stock label
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create Entry');
});

it('falls back to Create Entry when the plain translation is not a string', function (): void {
    // Set the plain key to an array, which stock Statamic would return as is
    setMessages(['pages_collection_create_entry' => ['news' => 'Create News Article']]);
    requestBlueprint(null);

    // Expect the stock label, never the array
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create Entry');
});

it('falls back to the plain key when the blueprint translation is not a string', function (): void {
    // Set the per-blueprint translation to an array
    setMessages([
        'pages_collection_create_entry' => 'Create Page',
        'pages_collection_create_entry.news' => ['x' => 'y'],
    ]);
    requestBlueprint('news');

    // Expect the plain label
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create Page');
});

it('ignores a blueprint parameter that is not a string', function (): void {
    // Set translations, and request the blueprint as an array
    setMessages([
        'pages_collection_create_entry' => 'Create Page',
        'pages_collection_create_entry.news' => 'Create News Article',
    ]);
    requestBlueprint(['news']);

    // Expect the plain label
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create Page');
});

it('ignores an empty blueprint parameter', function (): void {
    // Set translations, including one under an empty blueprint name
    setMessages([
        'pages_collection_create_entry' => 'Create Page',
        'pages_collection_create_entry.' => 'Never shown',
    ]);
    requestBlueprint('');

    // Expect the plain label
    expect(CollectionFacade::make('pages')->createLabel())->toBe('Create Page');
});

it("reads each collection's own keys", function (): void {
    // Set a translation for one collection only
    setMessages(['pages_collection_create_entry' => 'Create Page']);
    requestBlueprint(null);

    // Expect the other collection to keep the stock label
    expect(CollectionFacade::make('news')->createLabel())->toBe('Create Entry');
});
