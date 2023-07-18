<?php

namespace Opie\TaxrefClient\Model;

use Opie\TaxrefClient\Model\SimpleTaxon;

class MediaResource
{
    public function __construct(
        public int $id,
        public SimpleTaxon $taxon,
        public ?string $copyright,
        public ?string $title,
        public ?string $licence,
        public ?string $licenceUrl,
        public ?string $mimeType,
        public ?array $links,
    ) { }

    public function __toString(): string
    {
        $str = "[$this->id]";
        if ($this->title !== null)
            $str .= " « $this->title »";
        if ($this->copyright !== null)
            $str .= ' ' . $this->copyright;
        if ($this->licence !== null)
            $str .= ' ' . $this->licence;
        if ($this->mimeType !== null)
            $str .= ' ' . $this->mimeType;

        $fileHref = $this->getFileHref();
        if ($fileHref !== null)
            $str .= " '$fileHref'";

        return $str;
    }

    /** Return the URL for this media attached file if it exists. */
    public function getFileHref(): ?string
    {
        if ($this->links !== null && array_key_exists('file', $this->links))
            return $this->links['file']->href;
        return null;
    }

    public static function from(array $data): MediaResource
    {
        return new MediaResource(
            $data["id"],
            SimpleTaxon::from($data["taxon"]),
            $data["copyright"] ?? null,
            $data["title"] ?? null,
            $data["licence"] ?? null,
            $data["licenceUrl"] ?? null,
            $data["mimeType"] ?? null,
            isset($data['_links']) ? Link::fromArray($data['_links']) : null,
        );
    }
}
