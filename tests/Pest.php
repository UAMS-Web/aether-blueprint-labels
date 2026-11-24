<?php

/**
 * Pest configuration for the add-on.
 *
 * Integration tests boot a minimal Statamic through Orchestra Testbench via
 * `Tests\TestCase`; Unit tests stay on PHPUnit's own base class and boot
 * nothing. Shared helpers and custom expectations go here when the suite
 * grows them.
 */

declare(strict_types=1);

use UAMSWeb\Aether\BlueprintLabels\Tests\TestCase;

pest()->extend(TestCase::class)->in('Integration');

/**
 * Set the application's `messages` translations, replacing what was loaded.
 *
 * @param  array<string, mixed>  $messages  The `messages.php` entries, by flat key.
 */
function setMessages(array $messages): void
{
    app('translator')->setLoaded(['*' => ['messages' => ['en' => $messages]]]);
}

/**
 * Set the blueprint query parameter of the current request.
 *
 * @param  mixed  $blueprint  The parameter's value, or null for none.
 */
function requestBlueprint(mixed $blueprint): void
{
    app('request')->query->replace($blueprint === null ? [] : ['blueprint' => $blueprint]);
}
