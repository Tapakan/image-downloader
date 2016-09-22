<?php
/**
 * Http Driver. Downloading images from remote host.
 *
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\ImageDownloader\Http;

use finfo;
use Tapakan\ImageDownloader\AbstractDriver;
use Tapakan\ImageDownloader\DriverInterface;

/**
 * Class Driver
 */
class Driver extends AbstractDriver implements DriverInterface
{
    /**
     * @param mixed $data
     *
     * @return bool
     */
    public function load($data)
    {
        $dir    = $this->config->get('dir');
        $result = 0;

        $data = (array)$data;

        if (!empty($data)) {
            foreach ($data as $key => $path) {
                $filename = basename($path);

                if ($this->isExists($path) &&
                    $this->isSupportedType($this->getMimeType($path)) &&
                    copy($path, $dir . '/' . $filename)
                ) {
                    $result++;
                }
            }
        }

        return $result;
    }

    /**
     * Check if driver supported.
     *
     * @return bool
     */
    public function isSupported()
    {
        return extension_loaded('fileinfo');
    }

    /**
     * Check if image mimy type is supported.
     *
     * @param string $type Image mime type
     *
     * @return bool
     */
    protected function isSupportedType($type)
    {
        $config = $this->config->get('Http');

        return in_array($type, $config['whitelist']);
    }

    /**
     * Return mime type of image
     *
     * @param  string $path Path to image
     *
     * @return mixed
     */
    protected function getMimeType($path)
    {
        $info = new finfo(FILEINFO_MIME_TYPE);

        return $info->buffer(file_get_contents($path));
    }

    /**
     * Check if file exists.
     *
     * @param  string $file Path to file
     *
     * @return bool
     */
    protected function isExists($file)
    {
        $headers = get_headers($file);

        return stripos($headers[0], "200 OK") ? true : false;
    }
}
