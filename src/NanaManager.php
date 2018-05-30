<?php

namespace ksmz\NanaLaravel;

use ksmz\nana\Fetch;
use Illuminate\Contracts\Foundation\Application;

/** @mixin \ksmz\nana\Fetch */
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
     * @return \ksmz\nana\Fetch|mixed
     */
    public function faucet($name = null)
    {
        $name = $name ?: $this->getDefaultFaucet();

        return $this->faucets[$name] = $this->fetch($name);
    }

    /**
     * @param string $name
     * @return \ksmz\nana\Fetch|mixed
     */
    protected function fetch($name)
    {
        return $this->faucets[$name] ?? $this->resolve($name);
    }

    /**
     * @param $name
     * @return \ksmz\nana\Fetch
     */
    protected function resolve($name)
    {
        return new Fetch($this->getConfig($name));
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
    protected function getConfig($name)
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
