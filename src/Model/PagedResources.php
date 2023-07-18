<?php

namespace Opie\TaxrefClient\Model;

use Opie\TaxrefClient\Model\Link;
use Opie\TaxrefClient\Model\Resources;

class PagedResources extends Resources
{
    public function __construct(
        array $embedded,
        array $links,
        public PageMetadata $page,
    ) {
        parent::__construct($embedded, $links);
    }

    public static function from(array $data, string $factory): PagedResources
    {
        $resources = Resources::from($data, $factory);
        return new PagedResources(
            $resources->embedded,
            $resources->links,
            PageMetadata::from($data['page']),
        );
    }
}
