<?php

namespace AuthorsWorkPlugin;

abstract class Book
{
    protected static $instance;

    abstract protected function __construct();

    private function __clone(){}

    public static function getInstance(){
        if(static::$instance == null){
            static::$instance = new static();
        }

        return static::$instance;
    }
}