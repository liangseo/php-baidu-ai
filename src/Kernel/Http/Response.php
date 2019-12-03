<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Http;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;
use BaiduAi\Kernel\Support\Collection;

class Response extends GuzzleResponse
{
    public function getBodyContents() {
        $this->getBody()->rewind();
        $contents = $this->getBody()->getContents();
        $this->getBody()->rewind();

        return $contents;
    }

    public static function buildFromPrsResponse(ResponseInterface $response) {
        return new static (
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }


    public function toJson() {
        return json_encode($this->toArray());
    }

    public function toArray() {
        $content = $this->removeControlCharacters($this->getBodyContents());

        if (false !== stripos($this->getHeaderLine('Content-Type'), 'xml') || 0 === stripos($content, '<xml')) {
            //return XML::parse($content);
            return [];
        }

        $array = json_decode($content, true, 512, JSON_BIGINT_AS_STRING);

        if (JSON_ERROR_NONE === json_last_error()) {
            return (array) $array;
        }

        return [];
    }

    public function toCollection()
    {
        return new Collection($this->toArray());
    }

    public function toObject()
    {
        return json_decode($this->toJson());
    }

    public function __toString()
    {
        return $this->getBodyContents();
    }

    /**
     * 去除控制符
     * @param string $content
     * @return null|string|string[]
     */
    protected function removeControlCharacters(string $content)
    {
        return \preg_replace('/[\x00-\x1F\x80-\x9F]/u', '', $content);
    }

}