<?php
namespace PH7\Framework\Geo\Ip;
defined('PH7') or exit('Restricted access');

include_once(__DIR__ . '/geoip.inc.php');
include_once(__DIR__ . '/geoipcity.inc.php');
include_once(__DIR__ . '/geoipregionvars.php');

$gi = geoip_open(__DIR__ . '/GeoLiteCity.dat', GEOIP_STANDARD);
