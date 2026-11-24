<?php

declare(strict_types=1);

namespace UAMSWeb\Aether\BlueprintLabels\Entries;

use Statamic\Entries\Collection as BaseCollection;
use UAMSWeb\Aether\BlueprintLabels\Labels\CreateLabel;

/**
 * A collection whose create-entry label can differ per blueprint.
 *
 * The service provider binds it in place of Statamic's collection. Statamic reads
 * `createLabel()` for the create-entry page's title and button text, and the page
 * is requested with the blueprint as a `blueprint` query parameter.
 */
class Collection extends BaseCollection
{
    /**
     * The create-entry label: the translation of
     * `messages.<handle>_collection_create_entry.<blueprint>` for the requested
     * blueprint, else of `messages.<handle>_collection_create_entry`, else `Create Entry`.
     *
     * @return string The label to show.
     */
    #[\Override]
    public function createLabel()
    {
        // Name the key by the collection's handle
        /** @var string $handle */
        $handle = $this->handle;

        return CreateLabel::for(
            "messages.{$handle}_collection_create_entry",
            request()->query('blueprint'),
            __('Create Entry'),
        );
    }
}
