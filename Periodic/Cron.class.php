<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Periodic;
defined('PH7') or exit('Restricted access');
use PH7\Framework\Db\Db;

class Cron {

    public function __construct() {
        $this->backup();
        $this->optimize();
        $this->repair();
    }

    protected function backup() {
        try {
            Db::backup(Db::MYSQL, PH7_PATH_BACKUP_SQL, PH7_BACKUP_FORMAT_TYPE);
            echo gettext('Backup of the Database... Ok!') . '<br />';
        } catch (\RuntimeException $oE) {
            exit($oE->getMessage());
        }
    }

    protected function optimize() {
        Db::optimize();
        echo gettext('Optimizing tables... OK!') . '<br />';
    }

    protected function repair() {
        Db::repair();
        echo gettext('Repair of the Database... Ok!') . '<br />';
    }

}
