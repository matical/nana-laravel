<?php

namespace ksmz\NanaLaravel;

use ksmz\nana\Consume;
use Psr\Http\Message\ResponseInterface;

class LaravelConsume extends Consume
{
    /**
     * @var string identifier for the current faucet in use
     */
    protected $faucet;

    /**
     * Response constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string                              $faucet
     */
    public function __construct(ResponseInterface $response, string $faucet)
    {
        parent::__construct($response);
        $this->faucet = $faucet;
    }

    /**
     * Write the contents of a file.
     *
     * @param string       $path
     * @param string|null  $disk
     * @param string|array $options
     * @return bool true on success, false on failure
     */
    public function store($path, $disk = null, $options = [])
    {
        $disk = $disk ?? $this->resolveDisk();

        return app('filesystem')->disk($disk)
                                ->put($path, $this->stream(), $options);
    }

    protected function resolveDisk()
    {
        return config("nana.faucets.{$this->faucet}.default_disk");
    }
}
