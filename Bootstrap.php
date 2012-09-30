<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework;
define('PH7', 1);

try
{
    require __DIR__ . '/Config/constants.php';
    //require PH7_PATH_FRAMEWORK . '/Include/init.inc.php';

    /*** Instantiation language ***/
    mb_internal_encoding(PH7_ENCODING);
    mb_http_output(PH7_ENCODING);
    mb_http_input(PH7_ENCODING);
    mb_language('uni');
    mb_regex_encoding(PH7_ENCODING);
    ob_start('mb_output_handler');

    require __DIR__ . '/Loader/Autoloader.php';
    Loader\Autoloader::init();

    // Your code here and declaring your classes.
}
catch (\Exception $oE)
{
    exit($oE->getMessage());
}
