<?php
/**
 * @author      SORIA Pierre-Henry
 * @email       pierrehs@hotmail.com
 * @link        http://github.com/pH-7
 * @copyright   Copyright pH7 Script All Rights Reserved.
 * @license     CC-BY - http://creativecommons.org/licenses/by/3.0/
 */
 
namespace PH7\Framework;
defined('PH7') or exit('Restricted access');
use PH7\Framework\Db\Db;

try{      
	    require (__DIR__ . '/Config/constants.php');  
        $aDriverOptions[\PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES UTF8';
        Db::getInstance( 
          /* DSN */      'mysql:host=' . PH7_DATABASE_HOST . ';dbname=' . PH7_DATABASE_NAME,
          /* Username */ PH7_DATABASE_USER, 
          /* Password */ PH7_DATABASE_PASS, 
          /* Driver */   $aDriverOptions
        );
        
} catch (\Exception $e) {
	exit('Could not connect to database server!');
}
