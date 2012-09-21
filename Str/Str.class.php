<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Str;
defined('PH7') or exit('Restricted access');

class Str {

    /**
     * Escape function, uses the PHP native htmlspecialchars but improves.
     *
     * @param string $sText
     * @param boolean $bStrip If true, the text will be passed through the strip_tags function PHP
     * @return string text to HTML entities
     */
    public static function escape($sText, $bStrip = false) {
        return ($bStrip) ? strip_tags($sText) : htmlspecialchars($sText, ENT_QUOTES, PH7_ENCODING);
    }

}
