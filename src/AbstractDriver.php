<?php
/**
 * AbstractDriver
 *
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\ImageDownloader;

use Tapakan\ImageDownloader\Exception\DriverNotSupportedException;
use Tapakan\ImageDownloader\Exception\NotWritableException;

/**
 * Class AbstractDriver
 */
abstract class AbstractDriver
{
    /**
     * Config for driver.
     *
     * @var Config
     */
    protected $config;

    /**
     * AbstractDriver constructor.
     *
     * @param Config|array $config
     *
     * @throws DriverNotSupportedException
     */
    public function __construct(Config $config)
    {
        $path = $config->get('dir');
        if (!$this->isWritable($path)) {
            throw new NotWritableException("Dir is not writable ({$path})");
        }

        $this->config = $config;
    }

    /**
     * Check if directory is writable.
     *
     * @param  string $dir Path to directory.
     *
     * @return bool
     */
    protected function isWritable($dir)
    {
        return is_writable($dir);
    }
}
