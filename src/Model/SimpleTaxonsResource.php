<?php

namespace App\Model;

use App\Model\Link;

class SimpleTaxonsResource
{
    public function __construct(
        public int $id,
        public int $referenceId,
        public ?int $parentId,
        public string $scientificName,
        public string $fullNameHtml,
        public string $referenceNameHtml,
        public ?array $links,
    ) { }

    public static function from(array $data): SimpleTaxonsResource
    {
        return new SimpleTaxonsResource(
            $data["id"],
            $data["referenceId"],
            $data["parentId"] ?? null,
            $data["scientificName"],
            $data["fullNameHtml"],
            $data["referenceNameHtml"],
            isset($data["_links"]) ? Link::fromArray($data['_links']) : null,
        );
    }
}
