<?php
/**
 * Manager
 *
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\ImageDownloader;

use Tapakan\ImageDownloader\Http\Driver;
use Tapakan\ImageDownloader\Exception\UnknownDriverException;
use Tapakan\ImageDownloader\Exception\DriverNotSupportedException;

/**
 * Class Manager
 */
class Manager
{
    /**
     * @var Config|array
     */
    protected $config = [
        'driver' => self::DEFAULT_DRIVER,
        'dir'    => __DIR__ . '/uploads',
        'Http'   => [
            'whitelist' => ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'],
        ]
    ];

    const DEFAULT_DRIVER = 'Http';

    /**
     * Manager constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->setConfig($config);
    }

    /**
     * Set new config
     *
     * @param array $config Array of parameters
     *
     * @return $this
     */
    public function setConfig(array $config = [])
    {
        $this->config = new Config(array_replace((array)$this->config, $config));

        return $this;
    }

    /**
     * Set new parameter in config.
     *
     * @param string $key   Config key
     * @param mixed  $value Config value
     *
     * @return $this
     */
    public function setParameter($key, $value)
    {
        $this->config->set($key, $value);

        return $this;
    }

    /**
     * @throws DriverNotSupportedException If driver requirements is not supported
     * @throws UnknownDriverException      When driver not found
     * @return Downloader
     *
     */
    public function getDownloader()
    {
        $driver    = $this->config->get('driver', self::DEFAULT_DRIVER);
        $className = __NAMESPACE__ . "\\{$driver}\\Driver";

        if (!class_exists($className)) {
            throw new UnknownDriverException("Class {$className} not exists");
        }

        $driver = new Driver($this->config);

        if (!$driver->isSupported()) {
            throw new DriverNotSupportedException(
                "Driver " . $className . ' is not supported'
            );
        }

        return new Downloader($driver);
    }
}
