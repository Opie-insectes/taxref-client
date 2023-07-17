<?php

namespace App\Service;

use App\Model\PagedResources;
use App\Model\Resources;
use App\Model\TaxonsResource;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TaxrefService
{
    public string $baseUrl = 'https://taxref.mnhn.fr/api';

    public function __construct(
        private HttpClientInterface $client,
        protected LoggerInterface $logger,
    ) { }

    public function get(string $path, ?array $params = null): ?ResponseInterface
    {
        $options = [];
        if ($params !== null)
            $options['query'] = $params;

        $url = $this->baseUrl . $path;

        try {
            $response = $this->client->request('GET', $url, $options);
        } catch (HttpExceptionInterface $error) {
            $this->logger->error("HTTP error: {$error->getMessage()}");
            return null;
        } catch (TransportExceptionInterface $error) {
            $this->logger->error("Network error: {$error->getMessage()}");
            return null;
        }

        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            $this->logger->error("Request failed with status $statusCode.");
            return null;
        }

        return $response;
    }

    public function taxaAutocomplete(string $term): ?PagedResources
    {
        $data = $this->get('/taxa/autocomplete', ['term' => $term])?->toArray();
        if ($data === null)
            return null;
        return PagedResources::from($data, 'App\Model\SimpleTaxonsResource::from');
    }

    public function taxaId(int $id): ?TaxonsResource
    {
        $data = $this->get("/taxa/$id")?->toArray();
        if ($data === null)
            return null;
        return TaxonsResource::from($data, 'App\Model\TaxonsResource::from');
    }

    public function taxaIdMedia(int $id): ?Resources
    {
        $data = $this->get("/taxa/$id/media")?->toArray();
        if ($data === null)
            return null;
        return Resources::from($data, 'App\Model\MediaResource::from');
    }
}
