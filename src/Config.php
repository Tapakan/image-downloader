<?php
/**
 * Config
 *
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\ImageDownloader;

use ArrayObject;

/**
 * Class Config
 */
class Config extends ArrayObject
{
    /**
     * Construct a new array object
     *
     * @link  http://php.net/manual/en/arrayobject.construct.php
     *
     * @param array|object $data           The input parameter accepts an array or an Object.
     * @param int          $flags          Flags to control the behaviour of the ArrayObject object.
     * @param string       $iterator_class Specify the class that will be used for iteration of the ArrayObject object.
     *                                     ArrayIterator is the default class used.
     *
     * @since 5.0.0
     *
     */
    public function __construct($data = array(), $flags = 0, $iterator_class = "ArrayIterator")
    {
        parent::__construct((array)$data);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * @param      $key
     * @param null $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        if ($this->offsetExists($key)) {
            return $this->offsetGet($key);
        }

        return $default;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->offsetSet($key, $value);

        return $this;
    }
}
