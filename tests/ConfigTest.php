<?php
/**
 * ConfigTest class.
 *
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\ImageDownloader\Tests;

use PHPUnit_Framework_TestCase;
use Tapakan\ImageDownloader\Config;

/**
 * Class ConfigTest
 **/
class ConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConfig()
    {
        $config = new Config([
            '_key'  => '_value',
            '__key' => '__value'
        ]);

        $this->assertEquals('_value', $config->get('_key'));
        $this->assertEquals('__value', $config->get('__key'));
        $this->assertEquals('default_value', $config->get('___key', 'default_value'));

        $this->assertFalse($config->has('___key'));
        $this->assertTrue($config->has('_key'));
    }
}
