<?php

declare(strict_types=1);

use Statamic\Facades\Addon;
use Statamic\Statamic;

/**
 * The add-on boots inside a minimal Statamic.
 *
 * @command  vendor/bin/pest tests/Integration/ServiceProviderTest.php
 */
it('is discovered by Statamic as an add-on', function (): void {
    // Expect the add-on among those Statamic booted
    expect(Addon::all()->map->package()->all())->toContain('uams-web/aether-blueprint-labels');
});

it('registers the Control Panel build with Statamic', function (): void {
    // Read what Statamic holds for the add-on's Vite build; the key is the package name,
    // which Testbench resolves without the vendor prefix
    /** @var array<string, array<string, mixed>> $builds */
    $builds = Statamic::availableVites(request());
    $vite = $builds['aether-blueprint-labels'] ?? $builds['uams-web/aether-blueprint-labels'] ?? [];

    // Expect both entry files and the hot file beside the built files
    expect($vite['input'] ?? null)->toBe(['resources/js/cp.js', 'resources/css/cp.css'])
        ->and($vite['hotFile'] ?? null)->toBeString()->toEndWith('/resources/dist/hot');
});
