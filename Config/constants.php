<?php
/**
 * @author      SORIA Pierre-Henry
 * @email       pierrehs@hotmail.com
 * @link        http://github.com/pH-7
 * @copyright   Copyright pH7 Script All Rights Reserved.
 * @license     CC-BY - http://creativecommons.org/licenses/by/3.0/
 */
 
namespace PH7\Framework\Config;
defined('PH7') or exit('Restricted access');

#################### DATABASE #################### 

define( 'PH7_DATABASE_HOST', '127.0.0.1' );
define( 'PH7_DATABASE_NAME', 'my-database' );
define( 'PH7_DATABASE_USER', 'pierrehs' );
define( 'PH7_DATABASE_PASS', 'my-password' );

#################### OTHERS #################### 

define( 'PH7_DS', DIRECTORY_SEPARATOR );
define( 'PH7_PS', PATH_SEPARATOR );
define( 'PH7_ENCODING', 'UTF-8' );

#################### PATH #################### 

define ( 'PH7_PATH_FRAMEWORK', dirname(__DIR__) . PH7_DS);

#################### URL (PUBLIC) #################### 
