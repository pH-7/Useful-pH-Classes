<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Config;
defined('PH7') or exit('Restricted access');

#################### DATABASE ####################

define( 'PH7_DATABASE_HOST', '127.0.0.1' );
define( 'PH7_DATABASE_NAME', 'my-database' );
define( 'PH7_DATABASE_USER', 'pierrehs' );
define( 'PH7_DATABASE_PASS', 'my-password' );
define( 'PH7_TABLE_PREFIX', 'prefix_' );

#################### OTHERS ####################

define( 'PH7_DS', DIRECTORY_SEPARATOR );
define( 'PH7_PS', PATH_SEPARATOR );
define( 'PH7_DOT', '.' );
define( 'PH7_ENCODING', 'UTF-8' );

// BACKUP FORMAT TYPE
define ( 'PH7_BACKUP_FORMAT_TYPE', 'bz2' ); // 'gz', 'gzip' or 'bz2'

#################### PATH ####################

define ( 'PH7_PATH_FRAMEWORK', dirname(__DIR__) . PH7_DS);
define ( 'PH7_PATH_BACKUP_SQL', PH7_PATH_FRAMEWORK . '_Data/Backup/SQL/' );

#################### URL (PUBLIC) ####################
