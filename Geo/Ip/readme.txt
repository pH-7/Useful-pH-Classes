Please download the MaxMind (http://www.maxmind.com) API PHP GeoIP.

URL Geo Data: http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz
PHP API: http://geolite.maxmind.com/download/geoip/api/php/php-1.11.tar.gz

--- Files --- 
Rename "geoip.inc" to "geoip.inc.php"
Rename "geoipcity.inc" to "geoipcity.inc.php"

geoipregionvars.php
GeoLiteCity.dat


--- Code ---
Remove the code below in the geoipcity.inc.php file:
<code>
require_once 'geoip.inc';
require_once 'geoipregionvars.php';
</code>


Done!
