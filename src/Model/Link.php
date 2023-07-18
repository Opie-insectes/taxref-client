<?php

namespace Opie\TaxrefClient\Model;

class Link
{
    public function __construct(
        public string $href,
        public ?string $deprecation,
        public ?string $hreflang,
        public ?string $media,
        public ?string $rel,
        public ?string $title,
        public ?string $type,
        public ?bool $templated,
    ) { }

    /** Return a Link parsed from Link data. */
    public static function from(array $data): Link
    {
        return new Link(
            $data["href"],
            $data["deprecation"] ?? null,
            $data["hreflang"] ?? null,
            $data["media"] ?? null,
            $data["rel"] ?? null,
            $data["title"] ?? null,
            $data["type"] ?? null,
            $data["templated"] ?? null,
        );
    }

    /** Return a list of Links parsed from an array of link data. */
    public static function fromArray(array $linksData): array
    {
        return array_map(fn(array $linkData) => Link::from($linkData), $linksData);
    }
}
