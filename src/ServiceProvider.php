<?php

declare(strict_types=1);

namespace UAMSWeb\Aether\BlueprintLabels;

use Statamic\Contracts\Entries\Collection as CollectionContract;
use Statamic\Providers\AddonServiceProvider;
use UAMSWeb\Aether\BlueprintLabels\Entries\Collection;

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
     * @var array{input: list<string>, publicDirectory: string}
     */
    // A property default holds no executable line, so coverage reports each item as uncovered
    // although tests/Unit/ViteBuildTest.php pins the whole array against vite.config.js.
    // @pest-mutate-ignore: RemoveArrayItem
    protected $vite = [
        'input' => [
            'resources/js/cp.js',
            'resources/css/cp.css',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    /**
     * Boot the add-on once Statamic has booted.
     */
    public function bootAddon(): void
    {
        // Make every collection the add-on's subclass, so its create label can follow the blueprint.
        // Done here rather than in register(), which runs before Statamic binds its own collection.
        $this->app->bind(CollectionContract::class, Collection::class);
    }
}
