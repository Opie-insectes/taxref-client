<?php

namespace App\Model;

use App\Model\Link;
use App\Model\Resources;

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
