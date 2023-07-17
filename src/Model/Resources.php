<?php

namespace App\Model;

use App\Model\Link;

class Resources
{
    public function __construct(
        public array $embedded,
        public array $links,
    ) { }

    public static function from(array $data, string $factory): Resources
    {
        return new Resources(
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
            Link::fromArray($data['_links']),
        );
    }
}
