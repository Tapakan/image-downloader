<?php
/**
 * LoaderTest
 *
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\ImageDownloader\Tests;

use PHPUnit_Framework_TestCase;
use Tapakan\ImageDownloader\Manager;

/**
 * Class LoaderTest
 **/
class ImageDownloaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Configure before start.
     */
    public function setUp()
    {
        @mkdir(__DIR__ . '/uploads');
    }

    /**
     * Configure after end.
     */
    public function tearDown()
    {
        @unlink(__DIR__ . '/uploads/Example.png');
        @unlink(__DIR__ . '/uploads/example-slide-350-3.jpg');
        @unlink(__DIR__ . '/uploads/please_see_stamp-34345_Vector_Clipart.png');

        @unlink(__DIR__ . '/uploads/sunset.jpg');
        @unlink(__DIR__ . '/uploads/lake.jpg');
        @unlink(__DIR__ . '/uploads/landscape.jpg');
        @unlink(__DIR__ . '/uploads/GIF%20Example.gif');

        @rmdir(__DIR__ . '/uploads');
    }

    /**
     *
     */
    public function testLoadOneImage()
    {
        $result = $this->getManager()->getDownloader()->load('http://www.slidesjs.com/img/example-slide-350-3.jpg');

        $this->assertEquals(1, $result);
    }

    /**
     *
     */
    public function testLoadFewImages()
    {
        $result = $this->getManager()->getDownloader()->load([
            'http://www.sourcecertain.com/img/Example.png',
            'http://www.clipartsfree.net/vector/large/please_see_stamp-34345_Vector_Clipart.png'
        ]);

        $this->assertEquals(2, $result);
    }

    /**
     *
     */
    public function testLoadInvalidImages()
    {
        $result = $this->getManager()->getDownloader()->load([
            'http://example.com/example.gif',
            'http://example.com/example.png',
            'http://example.com/example.jpeg'
        ]);

        $this->assertEquals(0, $result);
    }

    /**
     *
     */
    public function testChangeParameter()
    {
        $manager = $this->getManager();

        $result = $manager->getDownloader()->load([
            'http://wowslider.com/sliders/demo-93/data1/images/sunset.jpg',
            'http://wowslider.com/sliders/demo-93/data1/images/lake.jpg',
            'http://wowslider.com/sliders/demo-93/data1/images/landscape.jpg',
            'http://www.personal.psu.edu/crd5112/photos/GIF%20Example.gif',
            'https://upload.wikimedia.org/wikipedia/commons/3/30/Vector-based_example.svg'
        ]);

        $this->assertEquals(4, $result);
    }

    /**
     * @expectedException Tapakan\ImageDownloader\Exception\NotWritableException
     */
    public function testNotWritableException()
    {
        $this->getManager()
            ->setParameter('dir', dirname(__DIR__) . '/tests/uploads2')
            ->getDownloader()
            ->load('http://www.sourcecertain.com/img/Example.png');
    }

    /**
     * @expectedException Tapakan\ImageDownloader\Exception\UnknownDriverException
     */
    public function testUnknownDriverException()
    {
        $manager = new Manager([
            'driver' => 'ftp'
        ]);
        $manager->getDownloader();
    }

    /**
     * @return Manager
     */
    private function getManager()
    {
        return new Manager([
            'driver' => 'Http',
            'dir'    => dirname(__DIR__) . '/tests/uploads'
        ]);
    }
}