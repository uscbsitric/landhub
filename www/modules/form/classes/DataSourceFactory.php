<?php defined('SYSPATH') or die('No direct script access.');

abstract class DataSourceFactory
{
    public static function factory($source)
    {
        $class = 'DataSource_'.ucfirst($source);
        return new $class();
    }
}