<?php

namespace App\Model;

use App\Model\Link;

class PagedResources
{
    public function __construct(
        public array $embedded,
        public array $links,
        public PageMetadata $page,
    ) { }

    public static function from(array $data, string $factory): PagedResources
    {
        return new PagedResources(
            array_map(
                function(array $subDataList) use ($factory) {
                    return array_map(
                        function($subData) use ($factory) {
                            return call_user_func($factory, $subData);
                        },
                        $subDataList
                    );
                },
                $data['_embedded']
            ),
            array_map(fn(array $linkData) => Link::from($linkData), $data['_links']),
            PageMetadata::from($data['page'])
        );
    }
}
