<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend
 */

/*
 * Set error reporting to the level to which Zend Framework code must comply.
 */
error_reporting( E_ALL | E_STRICT );

/**
 * Turn off execution time limit
 */
set_time_limit(0);


/*
 * Determine the root, library, and demos directories of the framework
 * distribution.
 */
$zfRoot        = realpath(dirname(__DIR__));
$zfCoreLibrary = "$zfRoot/library";

/*
 * Prepend the Zend Framework library/ and demos/ directories to the
 * include_path. This allows the demos to run out of the box and helps prevent
 * loading other copies of the framework code and demos that would supersede
 * this copy.
 */
$path = array(
    $zfCoreLibrary,
    get_include_path(),
);
set_include_path(implode(PATH_SEPARATOR, $path));

/**
 * Setup autoloading
 */
include_once __DIR__ . '/_autoload.php';

/*
 * Unset global variables that are no longer needed.
 */
unset($zfRoot, $zfCoreLibrary, $path);