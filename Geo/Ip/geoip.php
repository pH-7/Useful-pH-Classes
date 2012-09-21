<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Geo\Ip;
defined('PH7') or exit('Restricted access');

require_once __DIR__ . '/geoip.inc.php';
include_once __DIR__ . '/geoipcity.inc.php';
include_once __DIR__ . '/geoipregionvars.php';

$oGi = geoip_open(__DIR__ . '/GeoLiteCity.dat', GEOIP_STANDARD);
