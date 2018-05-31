<?php

namespace ksmz\NanaLaravel;

use Illuminate\Contracts\Foundation\Application;

/** @mixin \ksmz\NanaLaravel\LaravelFetch */
class NanaManager
{
    /**
     * @var array
     */
    protected $faucets = [];

    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Create a new NanaManager instance.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Retrieve a faucet instance.
     *
     * @param string $name
     * @return \ksmz\NanaLaravel\LaravelFetch
     */
    public function faucet($name = null)
    {
        $name = $name ?: $this->getDefaultFaucet();

        return $this->faucets[$name] = $this->fetch($name);
    }

    /**
     * Attempt to retrieve the faucet from the local cache.
     *
     * @param string $name
     * @return \ksmz\NanaLaravel\LaravelFetch
     */
    protected function fetch(string $name)
    {
        return $this->faucets[$name] ?? $this->resolve($name);
    }

    /**
     * Resolve the given faucet.
     *
     * @param string $name
     * @return \ksmz\NanaLaravel\LaravelFetch
     */
    protected function resolve(string $name)
    {
        return new LaravelFetch($this->getGuzzleConfig($name), $name);
    }

    /**
     * @return string
     */
    public function getDefaultFaucet()
    {
        return $this->app['config']['nana.default'] ?? 'default';
    }

    /**
     * Retrieve the configuration for the respective faucet.
     *
     * @param $name
     * @return mixed
     */
    protected function getGuzzleConfig($name)
    {
        return $this->app['config']["nana.faucets.{$name}.guzzle_config"];
    }

    /**
     * Forward calls to the default faucet.
     *
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->faucet()->{$name}(...$arguments);
    }
}
