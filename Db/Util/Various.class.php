<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Db\Util;
defined('PH7') or exit('Restricted access');
use PH7\Framework\Db\Db;

class Various
{

    /**
     * Private constructor to prevent instantiation of class since it is a private class.
     *
     * @access private
     */
    private function __construct() {}

    /**
     * Executes SQL queries.
     *
     * @param string $sSqlFile File SQL.
     * @return mixed (boolean | string) Returns "true" if no error, otherwise returns "the error message".
     */
    public static function execFileQuery($sSqlFile)
    {
        if(!is_file($sSqlFile)) return false;

        $sSqlContent = file_get_contents($sSqlFile);
        $sSqlContent = str_replace(PH7_TABLE_PREFIX,  Db::prefix(), $sSqlContent);
        $rStmt = Db::getInstance()->exec($sSqlContent);
        unset($sSqlContent);

        return ($rStmt === false) ? $rStmt->errorInfo() : true;
    }

    /**
     * Block cloning.
     *
     * @access private
     */
    private function __clone() {}

}
