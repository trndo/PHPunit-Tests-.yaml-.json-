<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 09.07.18
 * Time: 17:47
 */

namespace Velvet\Storage\Tests;


use App\Storage\YAMLKeyValueStorage;
use App\Storage\KeyValueStorageInterface;
use PHPUnit\Framework\TestCase;

class YAMLKeyValueStorageTest extends TestCase
{
    /**
     * @var KeyValueStorageInterface
     */
    private $storage;

    public function setUp()
    {
        $this->storage = new YAMLKeyValueStorage(__DIR__.'/../data/test.yaml');
    }

    public function testSet()
    {
        $this->storage->set('11111','data');

        $this->assertEquals("data",$this->storage->get("11111"));
    }

    public function testGet()
    {
        $this->assertNull($this->storage->get('Exemplificant'));
    }

    public function testHas()
    {
        $this->storage->set('one', 'piece');

        $this->assertTrue($this->storage->has('one'));
        $this->assertFalse($this->storage->has('Exemplificant'));
    }

    public function testRemove()
    {
        $this->storage->set("third","idea");

        $this->storage->remove("third");

        $this->assertFalse($this->storage->has("third"));
    }

    public function testClear()
    {
        $this->storage->set("first","identification");
        $this->storage->set("second","directory");

        $this->storage->clear();

        $this->assertEquals('identification', $this->storage->get('first'));
        $this->assertEquals('directory', $this->storage->get('second'));

    }
}

