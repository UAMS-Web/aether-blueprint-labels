<?php

declare(strict_types=1);

namespace UAMSWeb\Aether\BlueprintLabels\Labels;

/**
 * Chooses the label of a create button from the application's translations.
 *
 * A translation key can carry a per-blueprint variant: for the key
 * `messages.pages_collection_create_entry`, the variant for the `news` blueprint
 * is `messages.pages_collection_create_entry.news`, written as a flat key in
 * `lang/<locale>/messages.php`.
 */
final class CreateLabel
{
    /**
     * The label for a key, preferring the translation for the requested blueprint.
     *
     * A variant or a plain translation that is missing, or is not a string (an
     * array, because the key names a nested group), is skipped, so the label
     * always falls through to the fallback rather than returning a non-string.
     *
     * @param  string  $key  The plain translation key, such as `messages.pages_collection_create_entry`.
     * @param  mixed  $blueprint  The `blueprint` query parameter, which a request can make an array.
     * @param  string  $fallback  The label when no translation applies.
     * @return string The label to show.
     */
    public static function for(string $key, mixed $blueprint, string $fallback): string
    {
        // Prefer the translation for the requested blueprint, when the request names one
        if (is_string($blueprint) && $blueprint !== '') {
            $variant = self::translated("{$key}.{$blueprint}");

            if ($variant !== null) {
                return $variant;
            }
        }

        // Otherwise use the plain translation, or the fallback when there is none
        return self::translated($key) ?? $fallback;
    }

    /**
     * The translation of a key, or null when it is missing or is not a string.
     *
     * @param  string  $key  The translation key.
     * @return ?string The translated string, or null.
     */
    private static function translated(string $key): ?string
    {
        // Look the key up; Laravel returns the key itself for a missing translation
        $translation = __($key);

        return is_string($translation) && $translation !== $key ? $translation : null;
    }
}
