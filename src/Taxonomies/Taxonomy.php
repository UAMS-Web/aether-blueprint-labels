<?php

declare(strict_types=1);

namespace UAMSWeb\Aether\BlueprintLabels\Taxonomies;

use Statamic\Taxonomies\Taxonomy as BaseTaxonomy;
use UAMSWeb\Aether\BlueprintLabels\Labels\CreateLabel;

/**
 * A taxonomy whose create-term label can differ per blueprint.
 *
 * The service provider binds it in place of Statamic's taxonomy. Statamic reads
 * `createLabel()` for the create-term page's title and button text, and the page
 * is requested with the blueprint as a `blueprint` query parameter.
 */
class Taxonomy extends BaseTaxonomy
{
    /**
     * The create-term label: the translation of
     * `messages.<handle>_taxonomy_create_term.<blueprint>` for the requested
     * blueprint, else of `messages.<handle>_taxonomy_create_term`, else `Create Term`.
     *
     * @return string The label to show.
     */
    #[\Override]
    public function createLabel()
    {
        // Name the key by the taxonomy's handle
        /** @var string $handle */
        $handle = $this->handle;

        return CreateLabel::for(
            "messages.{$handle}_taxonomy_create_term",
            request()->query('blueprint'),
            __('Create Term'),
        );
    }
}
