<?php
namespace JollyBlueMan\UrlValidator;

class Scanner
{
    /**
     * @var array $urls An array of URLs
     */
    protected $urls;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * CsvScanner constructor.
     * @param array $urls An array of URLs to scan
     */
    public function __construct(array $urls)
    {
        $this->urls       = $urls;
        $this->httpClient = new \GuzzleHttp\Client();
    }

    /**
     * Get invalid URLs
     * @return array
     */
    public function getInvalidUrls(): array
    {
        $invalidUrls = [];
        foreach ($this->urls as $url) {
            try {
                $statusCode = $this->getStatusCodeForUrl($url);
            } catch (\Exception $e) {
                $statusCode = 500;
            }

            if ($statusCode >= 400) {
                array_push($invalidUrls, [
                    'url'    => $url,
                    'status' => $statusCode
                ]);
            }
        }

        return $invalidUrls;
    }

    protected function getStatusCodeForUrl($url)
    {
        $httpResponse = $this->httpClient->head($url);

        return $httpResponse->getStatusCode();
    }
}
