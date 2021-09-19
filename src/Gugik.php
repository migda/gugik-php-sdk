<?php

namespace Migda\GugikSdk;

use Migda\GugikSdk\Enums\GugikEndpoint;
use Migda\GugikSdk\Enums\HttpMethod;
use Migda\GugikSdk\HttpClients\HttpClientInterface;
use Migda\GugikSdk\Objects\Req\Gc\Dze\GcReqDze;
use Migda\GugikSdk\Objects\Req\Gc\Jpa\GcReqJpa;
use Migda\GugikSdk\Objects\Req\ReqBaseObject;
use Migda\GugikSdk\Objects\Req\Rgc\Adr\RgcReqAdr;
use Migda\GugikSdk\Objects\Req\Rgc\Dze\RgcReqDze;
use Migda\GugikSdk\Objects\Res\GcResult;
use Migda\GugikSdk\Objects\Res\GcResultCollection;

class Gugik
{
    /**
     * @var null
     */
    protected $client = null;

    /**
     * @var HttpClientInterface|null
     */
    protected $httpClient = null;

    /**
     * @var int
     */
    protected $timeOut = 120;

    /**
     * Gugik constructor.
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct(HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Geokodowanie działek - lpis
     * Geocode plots (lpis) using post
     *
     * http://capap.gugik.gov.pl/api/fts/#_geocodedzelpisusingpost
     *
     * @param GcReqDze $req
     * @return GcResultCollection
     * @throws Exceptions\GugikException
     */
    public function gcDzeLpis(GcReqDze $req): GcResultCollection
    {
        $response = $this->post(GugikEndpoint::GC_DZE_LIPS, $req);

        return GcResultCollection::create($response->getDecodedBody());
    }

    /**
     * Geokodowanie gmin
     * Geocode communes using post
     *
     * http://capap.gugik.gov.pl/api/fts/#_geocodegmiusingpost
     *
     * @param GcReqJpa $req
     * @return GcResultCollection
     * @throws Exceptions\GugikException
     */
    public function gcGmi(GcReqJpa $req): GcResultCollection
    {
        $response = $this->post(GugikEndpoint::GC_GMI, $req);

        return GcResultCollection::create($response->getDecodedBody());
    }

    /**
     * Odwrotne geokodowanie - punkty adresowe
     * Reverse geocode address points using get
     *
     * http://capap.gugik.gov.pl/api/fts/#_d8df035f1b22f89d3c826789834b2d65
     *
     * @param RgcReqAdr $req
     * @return GcResult
     * @throws Exceptions\GugikException
     */
    public function rgcAdr(RgcReqAdr $req): GcResult
    {
        $response = $this->get(GugikEndpoint::RGC_ADR, $req);

        return new GcResult($response->getDecodedBody());
    }

    /**
     * Odwrotne geokodowanie - działki
     * Reverse geocode plots using get
     *
     * http://capap.gugik.gov.pl/api/fts/#_dzeusingget
     *
     * @param RgcReqDze $req
     * @return GcResult
     * @throws Exceptions\GugikException
     */
    public function rgcDze(RgcReqDze $req): GcResult
    {
        $response = $this->get(GugikEndpoint::RGC_DZE, $req);

        return new GcResult($response->getDecodedBody());
    }

    /**
     * @return GugikResponse
     * @throws Exceptions\GugikException
     */
    public function test()
    {
        return $this->get(GugikEndpoint::RGC_DZE);
    }

    /**
     * @param HttpClientInterface $httpClient
     * @return $this
     */
    public function setHttpClient(HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    /**
     * @param int $timeOut
     *
     * @return $this
     */
    public function setTimeOut(int $timeOut): self
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * @return GugikClient
     */
    public function getClient(): GugikClient
    {
        if ($this->client === null) {
            $this->client = new GugikClient($this->httpClient);
        }

        return $this->client;
    }

    /**
     * @param string $endpoint
     * @param ReqBaseObject|null $req
     * @return GugikResponse
     * @throws Exceptions\GugikException
     */
    protected function get(string $endpoint, ReqBaseObject $req = null): GugikResponse
    {
        $params = $req ? $req->toArray() : [];

        return $this->sendRequest(HttpMethod::GET, $endpoint, $params);
    }

    /**
     * @param string $endpoint
     * @param ReqBaseObject $req
     * @return GugikResponse
     * @throws Exceptions\GugikException
     */
    protected function post(string $endpoint, ReqBaseObject $req): GugikResponse
    {
        $params = ['json' => $req->toArray()];

        return $this->sendRequest(HttpMethod::POST, $endpoint, $params);
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $params
     *
     * @return GugikResponse
     * @throws Exceptions\GugikException
     */
    protected function sendRequest(string $method, string $endpoint, array $params = []): GugikResponse
    {
        $request = $this->resolveRequest($method, $endpoint, $params);

        return $this->getClient()->sendRequest($request);
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $params
     * @return GugikRequest
     * @throws Exceptions\GugikException
     */
    protected function resolveRequest(string $method, string $endpoint, array $params = []): GugikRequest
    {
        return (new GugikRequest($method, $endpoint, $params))->setTimeOut($this->getTimeOut());
    }
}
