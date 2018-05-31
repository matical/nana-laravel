<?php

namespace ksmz\NanaLaravel;

use ksmz\nana\Fetch;
use Psr\Http\Message\ResponseInterface;

/**
 * @method LaravelConsume get(string $url, array $queryParams = [])
 * @method LaravelConsume post(string $url, array $params = [])
 * @method LaravelConsume patch(string $url, array $params = [])
 * @method LaravelConsume put(string $url, array $params = [])
 * @method LaravelConsume delete(string $url, array $params = [])
 */
class LaravelFetch extends Fetch
{
    /**
     * @var string identifier for the current faucet in use
     */
    protected $faucet;

    /**
     * Fetch constructor.
     *
     * @param array  $options
     * @param string $faucet
     */
    public function __construct(array $options = [], string $faucet)
    {
        parent::__construct($options);
        $this->faucet = $faucet;
    }

    /**
     * Build a new response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \ksmz\nana\Consume
     */
    protected function buildResponse(ResponseInterface $response)
    {
        return new LaravelConsume($response, $this->faucet);
    }
}
