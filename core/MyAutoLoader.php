<?php

class MyAutoLoader
{
    public static function load($className)
    {

        $fileName = BASE_PATH . '/' .  self::toPath($className) . '.php';

        // var_dump($fileName, $className);
    	if ( file_exists($fileName)) {
	        require $fileName;
    	}
    }

    protected static function toNamespace($className)
    {
    	return str_replace('/', '\\', $className);
    }

    protected static function toPath($className)
    {
    	return str_replace('\\', '/', $className);
    }
}

spl_autoload_register(__NAMESPACE__ . "\\MyAutoLoader::load");