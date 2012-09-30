<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Ip;
defined('PH7') or exit('Restricted access');

class Ip
{

    const IP_SITE = 'http://whatismyipaddress.com/ip/';

    /**
     * Get IP address.
     *
     * @return string IP address.
     */
    public static function get()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $sIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $sIp = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            $sIp = $_SERVER['REMOTE_ADDR'];
        }

        return preg_match('/^[a-z0-9:.]{7,}$/', $sIp) ? $sIp : '0.0.0.0';
    }

    /**
     * Returns the API IP with the IP address.
     *
     * @param string $sIp IP address.
     * @return string URL API with the IP address.
     */
    public static function api($sIp = null)
    {
        $sIp = (empty($sIp)) ? static::get() : $sIp;
        return static::IP_SITE . $sIp;
    }

}
