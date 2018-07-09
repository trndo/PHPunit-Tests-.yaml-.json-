<?php

namespace App\Storage;


class JsonKeyValueStorage implements KeyValueStorageInterface
{
    private $fileN;

    public function __construct($fileN)
    {
        $this->fileN=$fileN;
    }

    public function setData($arr):void
    {
        $json=json_encode($arr);
        file_put_contents($this->fileN, $json, LOCK_EX);
    }

    public function getData():?array
    {
        $data=file_get_contents($this->fileN);
        return json_decode($data,true);

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
        if(!$this->has($key)) {
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
        $arr=[];
        $this->setData($arr);
    }
}