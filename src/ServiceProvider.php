<?php

declare(strict_types=1);

namespace UAMSWeb\Aether\BlueprintLabels;

use Statamic\Contracts\Entries\Collection as CollectionContract;
use Statamic\Contracts\Taxonomies\Taxonomy as TaxonomyContract;
use Statamic\Providers\AddonServiceProvider;
use UAMSWeb\Aether\BlueprintLabels\Entries\Collection;
use UAMSWeb\Aether\BlueprintLabels\Taxonomies\Taxonomy;

/**
 * Service provider for the add-on.
 *
 * The host application discovers it through `extra.laravel.providers` in
 * `composer.json`. Register the add-on's tags, fieldtypes, listeners, routes and
 * the like here, using the properties `AddonServiceProvider` documents, or in
 * `bootAddon()` for anything that needs Statamic booted first.
 */
class ServiceProvider extends AddonServiceProvider
{
    /**
     * The Vite build of the Control Panel assets. `input` and `publicDirectory`
     * must match `vite.config.js`; the built files are committed under
     * `resources/dist`.
     *
     * A constant, because a mutation of a property default has no executable line to
     * select a test by, while a constant's mutants run the tests that cover this class.
     */
    private const array VITE = [
        'input' => [
            'resources/js/cp.js',
            'resources/css/cp.css',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    /**
     * The Vite build Statamic registers for the add-on.
     *
     * @var array{input: list<string>, publicDirectory: string}
     */
    protected $vite = self::VITE;

    /**
     * Boot the add-on once Statamic has booted.
     */
    public function bootAddon(): void
    {
        // Make every collection the add-on's subclass, so its create label can follow the blueprint.
        // Done here rather than in register(), which runs before Statamic binds its own collection.
        $this->app->bind(CollectionContract::class, Collection::class);

        // Do the same for every taxonomy, so its create label can follow the blueprint
        $this->app->bind(TaxonomyContract::class, Taxonomy::class);
    }
}
