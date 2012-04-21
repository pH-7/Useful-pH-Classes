<?php
/**
 * @author      SORIA Pierre-Henry
 * @email       pierrehs@hotmail.com
 * @link        http://github.com/pH-7
 * @copyright   Copyright pH7 Script All Rights Reserved.
 * @license     CC-BY - http://creativecommons.org/licenses/by/3.0/
 */
 
namespace PH7\Framework\Security\Validate;
defined('PH7') or exit('Restricted access');

class Validate {

  public static function url($sUrl) {
    // Check URL valid with HTTP status code '200 OK'
     $aUrl = get_headers($sUrl);
     return (strpos($aUrl[0], '200 OK'));
  }

}
