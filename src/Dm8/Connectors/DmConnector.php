<?php

namespace LaravelDm8\Dm8\Connectors;

use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;
use Illuminate\Support\Arr;
use PDO;

class DmConnector extends Connector implements ConnectorInterface
{
    /**
     * The default PDO connection options.
     *
     * @var array
     */
    protected $options = [
        PDO::ATTR_CASE               => PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS       => PDO::NULL_NATURAL,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ];

    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return PDO
     */
    public function connect(array $config)
    {
        $tns = ! empty($config['tns']) ? $config['tns'] : $this->getDsn($config);

        $options = $this->getOptions($config);

        $connection = $this->createConnection($tns, $config, $options);

        return $connection;
    }

    /**
     * Create a DSN string from a configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        if (! empty($config['tns'])) {
            return $config['tns'];
        }

        // parse configuration
        $config = $this->parseConfig($config);

        // return generated tns
        return $config['tns'];
    }

    /**
     * Parse configurations.
     *
     * @param  array  $config
     * @return array
     */
    protected function parseConfig(array $config)
    {
        $config = $this->setHost($config);
        $config = $this->setPort($config);
        $config = $this->setTNS($config);
        $config = $this->setCharset($config);

        return $config;
    }

    /**
     * Set host from config.
     *
     * @param  array  $config
     * @return array
     */
    protected function setHost(array $config)
    {
        $config['host'] = isset($config['host']) ? $config['host'] : $config['hostname'];

        return $config;
    }

    /**
     * Set port from config.
     *
     * @param  array  $config
     * @return array
     */
    private function setPort(array $config)
    {
        $config['port'] = isset($config['port']) ? $config['port'] : '1521';

        return $config;
    }

    /**
     * Set tns from config.
     *
     * @param  array  $config
     * @return array
     */
    protected function setTNS(array $config)
    {
        $config['tns'] = "dm:host={$config['host']};dbname={$config['database']};port={$config['port']};";

        return $config;
    }

    /**
     * Set charset from config.
     *
     * @param  array  $config
     * @return array
     */
    protected function setCharset(array $config)
    {
        if (! isset($config['charset'])) {
            $config['charset'] = 'UTF8';
        }

        return $config;
    }

    /**
     * Create a new PDO connection.
     *
     * @param  string  $tns
     * @param  array  $config
     * @param  array  $options
     * @return PDO
     */
    public function createConnection($tns, array $config, array $options)
    {
        // add fallback in case driver is not set, will use pdo instead
        if (! in_array($config['driver'], ['dm'])) {
            return parent::createConnection($tns, $config, $options);
        }

        $config = $this->setCharset($config);
        $options['charset'] = $config['charset'];

        return new PDO($tns, $config['username'], $config['password'], $options);
    }
}
