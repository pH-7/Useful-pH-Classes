<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Loader;
defined('PH7') or exit('Restricted access');

class Autoloader
{

    /**
     * Autoload Classes.
     *
     * @access protected
     * @param string $sClass
     * @return void
     */
    protected static function loadClass($sClass)
    {
        $sClass = static::clean($sClass);

        // To include Classes
        if(is_file(PH7_PATH_FRAMEWORK . $sClass . '.class.php')) {
            require_once PH7_PATH_FRAMEWORK . $sClass . '.class.php';
        }

        // To include Interfaces
        else if(is_file(PH7_PATH_FRAMEWORK . $sClass . '.interface.php')) {
            require_once PH7_PATH_FRAMEWORK . $sClass . '.interface.php';
        }

        // To include Traits
        else if(is_file(PH7_PATH_FRAMEWORK . $sClass . '.trait.php')) {
            require_once PH7_PATH_FRAMEWORK . $sClass . '.trait.php';
        }
    }

    /**
     * For all classes, hack to remove the namespace, slash and backslash.
     *
     * @access protected
     * @param string The class name to clean.
     * @return string The class cleaned.
     */
    protected static function clean($sClass)
    {
        return $sClass = str_replace (array('PH7\Framework', '\\', '//'), array('/', '/', ''), $sClass);
    }

    /**
     * Autoloader Class.
     *
     * @access public
     * @return void
     */
    public static function init()
    {
        spl_autoload_register(null, false);
        spl_autoload_extensions('.class.php, .interface.php, .trait.php');
        spl_autoload_register(array('self', 'loadClass'));
    }

}
