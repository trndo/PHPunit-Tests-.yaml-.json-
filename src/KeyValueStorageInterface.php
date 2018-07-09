<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 21.06.18
 * Time: 14:05
 */

namespace App\Storage;


interface KeyValueStorageInterface
{

    /**
     * Store value by key.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set(string $key, $value):void;

    /**
     * Gets value by key.
     *
     * @param string $key
     */
    public function get(string $key);

    /**
     * Check whether value is exist by key.
     */
    public function has(string $key);

    /**
     * Removes value by key.
     *
     * @param string $key
     */
    public function remove(string $key):void ;

    /**
     * Clear storage.
     *
     * @param string $key
     */
    public function clear():void;
}