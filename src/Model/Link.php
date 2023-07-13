<?php

namespace App\Model;

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
}
