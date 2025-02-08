<?php

namespace Vhar\LaravelRobokassa;

use Robokassa\Robokassa;
use Illuminate\Support\Facades\Config;

class RobokassaManager
{
    /**
     * Массив полученных экземпляров класса.
     *
     * @var array
     */
    protected $merchants = [];

    /**
     * Получить экземпляр класса для продавца.
     *
     * @param  string|null  $name
     * @return \Robokassa\Robokassa
     */
    public function merchant(string $name = null): Robokassa
    {
        $name = $name ?: $this->getDefaultMerchant();

        return $this->merchants[$name] = $this->get($name);
    }

    /**
     * Получть экземпляр класса для продавца из локального кэша.
     *
     * @param  string  $name
     * @return \Robokassa\Robokassa
     */
    private function get(string $name): Robokassa
    {
        return $this->merchants[$name] ?? $this->resolve($name);
    }

    /**
     * Получить новый экземпляр класса для продавца.
     *
     * @param  string  $name
     * @return \Robokassa\Robokassa
     *
     * @throws \InvalidArgumentException
     */
    protected function resolve(string $name)
    {
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new \InvalidArgumentException("Robokassa merchant [{$name}] is not defined.");
        }

        $robokassa = new Robokassa($config);

        return $robokassa;
    }

    /**
     * Получить конфигурацию для продавца.
     *
     * @param  string  $name
     * @return array
     */
    protected function getConfig(string $name)
    {
        return Config::get("robokassa.merchants.{$name}");
    }

    /**
     * Получить конфиграцию продавца по умолчанию.
     *
     * @return string
     */
    private function getDefaultMerchant()
    {
        return Config::get('robokassa.default');
    }

    /**
     * Динамический вызов метода для конфигурации продавца по умолчанию.
     *
     * @param  string  $method
     * @param  array  $args
     * @return mixed
     */
    public function __call(string $method, array $args)
    {
        return $this->merchant()->{$method}(...$args);
    }
}
