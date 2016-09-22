<?php
/**
 * Downloader
 *
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\ImageDownloader;

/**
 * Class Downloader
 */
class Downloader
{
    /**
     * @var DriverInterface
     */
    private $driver;

    /**
     * Downloader constructor.
     *
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param mixed $data
     *
     * @return bool|int
     */
    public function load($data)
    {
        return $this->driver->load($data);
    }
}
