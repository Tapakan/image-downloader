<?php
/**
 * DriverInterface
 *
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\ImageDownloader;

/**
 * Interface LoaderInterface
 */
interface DriverInterface
{
    /**
     * @param mixed $data Data for download.
     *
     * @return bool|integer
     */
    public function load($data);

    /**
     * Check driver requirements.
     *
     * @return bool
     */
    public function isSupported();
}
