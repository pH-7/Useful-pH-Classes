<?php
/**
 * @author      SORIA Pierre-Henry
 * @email       pierrehs@hotmail.com
 * @link        http://github.com/pH-7
 * @copyright   Copyright pH7 Script All Rights Reserved.
 * @license     CC-BY - http://creativecommons.org/licenses/by/3.0/
 */
 
namespace PH7\Framework;
define('PH7', 1);
            
try {
        require (__DIR__ . '/Config/constants.php');
        //require (PH7_PATH_FRAMEWORK . '/Include/init.inc.php');
        
        /*** Instantiation language ***/
            mb_internal_encoding(PH7_ENCODING);
            mb_http_output(PH7_ENCODING);
            mb_http_input(PH7_ENCODING);
            mb_language('uni');
            mb_regex_encoding(PH7_ENCODING);
            ob_start('mb_output_handler');
            
        require (__DIR__ . '/Loader/Autoloader.php');
        Loader\Autoloader::init(); 
}
catch (\Exception $e) {
	exit($e->getMessage());
}
