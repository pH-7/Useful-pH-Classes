<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Security\Validate;
defined('PH7') or exit('Restricted access');

class Validate {

    const MAX_URL_LENGTH = 150;

    /**
     * Validate URL.
     *
     * @param string $sUrl
     * @param boolean $bRealUrl Checks whether the URL actually exists. Default FALSE
     * @return boolean
     */
    public function url($sUrl, $bRealUrl = false) {
        $sUrl = filter_var($sUrl, FILTER_SANITIZE_URL);

        if(!(filter_var($sUrl, FILTER_VALIDATE_URL) && mb_strlen($sUrl) <= static::MAX_URL_LENGTH)) return false;

        if($bRealUrl)
        {
            /**
             * Checks if the URL is valid with the HTTP status code '200 OK' or '301 Moved Permanently'
             */
            $aUrl = @get_headers($sUrl);
            return (strpos($aUrl[0], '200 OK') || strpos($aUrl[0], '301 Moved Permanently'));
        }
        else
        {
            return true;
        }
    }

}
