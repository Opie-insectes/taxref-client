<?php

namespace Opie\TaxrefClient\Model;

class SimpleTaxon
{
    public function __construct(
        public int $id,
        public string $scientificName,
        public string $fullNameHtml,
        public int $referenceId,
        public ?int $parentId,
        public string $referenceNameHtml,
    ) { }

    public static function from(array $data): SimpleTaxon
    {
        return new SimpleTaxon(
            $data["id"],
            $data["scientificName"],
            $data["fullNameHtml"],
            $data["referenceId"],
            $data["parentId"] ?? null,
            $data["referenceNameHtml"],
        );
    }
}
