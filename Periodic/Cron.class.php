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

class Cron
{

    public function __construct()
    {
        // Checks the security hash cron
        if(empty($_GET['secret_word']) || strcmp($_GET['secret_word'], PH7_CRON_SECURITY_HASH) != 0) {
            header('HTTP/1.1 403 Forbidden');
            exit(gettext('Secret word is invalid for the cron hash!'));
        }

        if(!empty($_GET['option'])) {
            switch($_GET['option']) {

                // Backup
                case 'backup':
                  $this->backup();
                break;

                // Optimization Tables
                case 'optimize':
                  $this->optimize();
                break;

                // Repair Tables
                case 'repair':
                  $this->repair();
                break;

                default:
                  header('HTTP/1.1 400 Bad Request');
                  exit(gettext('Bad Request Error!'));
            }
        }

        echo '<br />' . gettext('Done!') . '<br />';
    }

    protected function backup()
    {
        try
        {
            Db::backup(Db::MYSQL, PH7_PATH_BACKUP_SQL, PH7_BACKUP_FORMAT_TYPE);
            echo gettext('Backup of the Database... Ok!') . '<br />';
        }
        catch (\RuntimeException $oE)
        {
            header('HTTP/1.1 500 Internal Server Error');
            exit($oE->getMessage());
        }
    }

    protected function optimize()
    {
        Db::optimize();
        echo gettext('Optimizing tables... OK!') . '<br />';
    }

    protected function repair()
    {
        Db::repair();
        echo gettext('Repair of the Database... Ok!') . '<br />';
    }

}
