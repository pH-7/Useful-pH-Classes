<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Ip;
defined('PH7') or exit('Restricted access');

class Ip {

    const IP_SITE = 'http://whatismyipaddress.com/ip/';

    /**
     * Get IP address.
     *
     * @return float IP address.
     */
    public static function get() {
        if ($_SERVER) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $fIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            elseif (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $fIp = $_SERVER['HTTP_CLIENT_IP'];
            }
            else
            {
                $fIp = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR'))
            {
                $fIp = getenv('HTTP_X_FORWARDED_FOR');
            }
            elseif (getenv('HTTP_CLIENT_IP'))
            {
                $fIp = getenv('HTTP_CLIENT_IP');
            }
            else
            {
                $fIp = getenv('REMOTE_ADDR');
            }
        }
         return (float) preg_match('#^[a-z0-9:.]{7,}$#', $fIp) ? $fIp : '127.0.0.1';
    }

    /**
     * Returns the API IP with the IP address.
     *
     * @param float $fIp IP address.
     * @return string URL API with the IP address.
     */
    public static function api($fIp = null) {
      $fIp = (empty($fIp)) ? static::get() : $fIp;
       return static::IP_SITE . $fIp;
    }

}
