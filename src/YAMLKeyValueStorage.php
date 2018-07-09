<?php

namespace App\Storage;

use Symfony\Component\Yaml\Yaml;

class YAMLKeyValueStorage implements KeyValueStorageInterface
{
    private $fileN;

    public function __construct($fileN)
    {
        $this->fileN=$fileN;
    }

    public function setData($arr):void
    {
        $yaml=Yaml::dump($arr);
        file_put_contents($this->fileN,$yaml,LOCK_EX);
    }

    public function getData():?array
    {
        $yaml=Yaml::parseFile($this->fileN);
        return $yaml;

    }

    public function set(string $key, $value):void
    {
        $arr=$this->getData();
        if(!$this->has($key))
            $arr[$key]=$value;
        $this->setData($arr);
    }

    public function get(string $key)
    {
        $arr=$this->getData();
        if(!$this->has($key)){
            return 'Empty!';
            }
        return $arr[$key];
    }

    public function has(string $key)
    {
        $arr=$this->getData();
        return isset($arr[$key]);
    }

    public function remove(string $key):void
    {
        $arr=$this->getData();
        if($this->has($key))
            unset($arr[$key]);
        $this->setData($arr);
    }

    public function clear():void
    {
        $arr = [];
        $this->setData($arr);
    }
}

