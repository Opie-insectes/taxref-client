<?php

namespace App\Model;

use App\Model\PageMetadata;

class PageMetadata
{
    public function __construct(
        public int $number,
        public int $size,
        public int $totalElements,
        public int $totalPages,
    ) { }

    public static function from(array $data): PageMetadata
    {
        return new PageMetadata(
            $data['number'],
            $data['size'],
            $data['totalElements'],
            $data['totalPages'],
        );
    }
}
