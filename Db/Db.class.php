<?php
/**
 * @author      Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright   (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @link        http://github.com/pH-7
 * @license     CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

namespace PH7\Framework\Db;
defined('PH7') or exit('Restricted access');

/**
 * @class Singleton Class
 */
class Db
{

    const MYSQL = 'MySQL', POSTGRESQL = 'PostgreSQL';

    /**
     * Static attributes of the class.
     * Holds an insance of self with the \PDO class.
     *
     * @var string $_sDsn Data Source Name
     * @var string $_sUsername
     * @var string $_sPassword
     * @var string $_sPrefix
     * @var array $_aDriverOptions
     * @var integer $_iCount
     * @var float $_fTime
     * @var object $_oInstance
     */
    private static $_sDsn, $_sUsername, $_sPassword, $_sPrefix, $_aDriverOptions, $_iCount = 0, $_fTime = 0.0, $_oInstance = NULL;

    /**
     * Static attributes for the backup path of the database and backup type format.
     *
     * @var string $_sBackupPath
     * @var string $_sBackupFormat
     */
    private static $_sBackupPath, $_sBackupFormat;

    /**
     * The constructor is set to private, so nobody can create a new instance using new.
     */
    private function __construct() {}

    /**
     * Return DB instance or create intitial connection.
     *
     * @return object (PDO)
     */
    public static function getInstance($sDsn = NULL, $sUsername = NULL, $sPassword = NULL, $aDriverOptions = NULL, $sPrefix = NULL)
    {
        if(NULL === self::$_oInstance)
        {
            if(!empty($sDsn))
                self::$_sDsn = $sDsn;

            if(!empty($sUsername))
                self::$_sUsername = $sUsername;

            if(!empty($sPassword))
                self::$_sPassword = $sPassword;

            if(!empty($aDriverOptions))
                self::$_aDriverOptions = $aDriverOptions;

            if(!empty($sPrefix))
                self::$_sPrefix = $sPrefix;

            self::$_oInstance = new \PDO(self::$_sDsn, self::$_sUsername, self::$_sPassword, self::$_aDriverOptions);
            self::$_oInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$_oInstance;
    }

    /**
     * Increment function.
     *
     * @return void
     */
    private function increment()
    {
        ++self::$_iCount;
    }

    /**
     * Initiates a transaction.
     *
     * @return bool
     */
    public function beginTransaction()
    {
        return self::$_oInstance->beginTransaction();
    }

    /**
     * Commits a transaction.
     *
     * @return bool
     */
    public function commit()
    {
        return self::$_oInstance->commit();
    }

    /**
     * Fetch the SQLSTATE associated with the last operation on the database handle.
     *
     * @return string
     */
    public function errorCode()
    {
        return self::$_oInstance->errorCode();
    }

    /**
     * Fetch extended error information associated with the last operation on the database handle.
     *
     * @return array
     */
    public function errorInfo()
    {
        return self::$_oInstance->errorInfo();
    }

    /**
     * Execute an SQL statement and return the number of affected rows.
     *
     * @param string $sStatement
     * @return mixed (boolean | integer)
     */
    public function exec($sStatement)
    {
        $fStartTime = microtime(true);
        $mReturn = self::$_oInstance->exec($sStatement);
        $this->increment();
        $this->addTime($fStartTime, microtime(true));
        return $mReturn;
    }

    /**
     * Retrieve a database connection attribute.
     *
     * @param int $iAttribute
     * @return mixed
     */
    public function getAttribute($iAttribute)
    {
        return self::$_oInstance->getAttribute($iAttribute);
    }

    /**
     * Return an array of available PDO drivers.
     *
     * @return array
     */
    public function getAvailableDrivers()
    {
        return self::$_oInstance->getAvailableDrivers();
    }

    /**
     * Returns the ID of the last inserted row or sequence value.
     *
     * @param string $sName Name of the sequence object from which the ID should be returned.
     * @return string
     */
    public function lastInsertId($sName)
    {
        return self::$_oInstance->lastInsertId($sName);
    }

    /**
     * Prepares a statement for execution and returns a statement object.
     *
     * @param string $sStatement A valid SQL statement for the target database server.
     * @return PDOStatement
     */
    public function prepare($sStatement)
    {
        return self::$_oInstance->prepare($sStatement);
    }

    /**
     * Execute an SQL prepared with prepare() method.
     *
     * @param string $sStatement
     * @return boolean
     */
    public function execute($sStatement)
    {
        $fStartTime = microtime(true);
        $bReturn = self::$_oInstance->execute($sStatement);
        $this->increment();
        $this->addTime($fStartTime, microtime(true));
        return $bReturn;
    }

    /**
     * Executes an SQL statement, returning a result set as a PDOStatement object.
     *
     * @param string $sStatement
     * @return mixed (object | boolean) PDOStatement object, or FALSE on failure.
     */
    public function query($sStatement)
    {
        $fStartTime = microtime(true);
        $mReturn = self::$_oInstance->query($sStatement);
        $this->increment();
        $this->addTime($fStartTime, microtime(true));
        return $mReturn;
    }

    /**
     * Execute query and return all rows in assoc array.
     *
     * @param string $sStatement
     * @return array
     */
    public function queryFetchAllAssoc($sStatement)
    {
        return self::$_oInstance->query($sStatement)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Execute query and return one row in assoc array.
     *
     * @param string $sStatement
     * @return array
     */
    public function queryFetchRowAssoc($sStatement)
    {
        return self::$_oInstance->query($sStatement)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Execute query and select one column only.
     *
     * @param string $sStatement
     * @return mixed
     */
    public function queryFetchColAssoc($sStatement)
    {
        return self::$_oInstance->query($sStatement)->fetchColumn();
    }

    /**
     * Quotes a string for use in a query.
     *
     * @param string $sInput
     * @param integer $iParameterType
     * @return string
     */
    public function quote($sInput, $iParameterType = 0)
    {
        return self::$_oInstance->quote($sInput, $iParameterType);
    }

    /**
     * Rolls back a transaction.
     *
     * @return boolean
     */
    public function rollBack()
    {
        return self::$_oInstance->rollBack();
    }

    /**
     * Set an attribute.
     *
     * @param integer $iAttribute
     * @param mixed $mValue
     * @return boolean
     */
    public function setAttribute($iAttribute, $mValue)
    {
        return self::$_oInstance->setAttribute($iAttribute, $mValue);
    }

    /**
     * Count the number of requests.
     *
     * @return float number
     */
    public static function queryCount()
    {
        return self::$_iCount;
    }

    /**
     * Show all tables.
     *
     * @return mixed (object | boolean) PDOStatement object, or FALSE on failure.
     */
    public static function showTables()
    {
        return self::getInstance()->query('SHOW TABLES');
    }

    /**
     * Add Time Query.
     *
     * @param float $fStartTime
     * @param float $fEndTime
     * @return void
     */
    public function addTime($fStartTime, $fEndTime)
    {
        self::$_fTime += round($fEndTime - $fStartTime, 6);
    }

    /**
     * Time Query.
     *
     * @return string
     */
    public static function time()
    {
        return self::$_fTime;
    }

    /**
     * If table name is empty, only prefix will be returned otherwise the table name with its prefix will be returned.
     *
     * @param string $sTable Table name.
     * @param boolean $bTrim With or without a space before and after the table name. Default valut is "false", so with space before and after table name.
     * @return string prefixed table name, just prefix if table name is empty.
     */
    public static function prefix($sTable = '', $bTrim = false)
    {
        $sSpace = (!$bTrim) ? ' ' : '';
        return ($sTable !== '') ? $sSpace . self::$_sPrefix . $sTable . $sSpace : self::$_sPrefix;
    }

    /**
     * Free database.
     *
     * @param object \PDOStatement $rStmt Close cursor of PDOStatement class. Default value NULL
     * @param bool $bCloseConnection Close connection of PDO. Default value TRUE
     * @return void
     */
    public static function free(\PDOStatement &$rStmt = NULL, $bCloseConnection = TRUE)
    {
        // Close Cursor
        if(NULL !== $rStmt)
        {
            $rStmt->closeCursor();
            unset($rStmt);
        }

        // Free instance of the PDO object
        if(TRUE === $bCloseConnection)
            self::$_oInstance = NULL;
    }

    /**
     * Optimizing tables.
     *
     * @return void
     */
    public static function optimize()
    {
        $oAllTables = static::showTables();
        while($aTableNames = $oAllTables->fetch()) self::getInstance()->query('OPTIMIZE TABLE '. $aTableNames[0]);
        unset($oAllTables);
    }

    /**
     * Repair tables.
     *
     * @return void
     */
    public static function repair()
    {
        $oAllTables = static::showTables();
        while($aTableNames = $oAllTables->fetch()) self::getInstance()->query('REPAIR TABLE '. $aTableNames[0]);
        unset($oAllTables);
    }

    /**
     * Create a database backup.
     *
     * @param string $sClass The class name.
     * @param string $sPath The path to the directory where the file will be stored backup.
     * @param string $sFormat The compression format of the file.
     * @throws \RuntimeException If the class is not found (invalid).
     * @return void
     */
    public static function backup($sClass, $sPath, $sFormat)
    {
        switch($sClass)
        {
            case self::MYSQL:
              $sClass = '\PH7\Framework\Db\Util\Backup\MySQL';
            break;

            default:
              throw new \RuntimeException('The class "' . $sClass . '" is invalid!');
        }

        self::$_sBackupPath = $sPath;
        self::$_sBackupFormat = $sFormat;
        $oSQLDump = new $sClass(PH7_DATABASE_HOST, self::$_sUsername, self::$_sPassword, PH7_DATABASE_NAME, self::$_sBackupPath, self::$_sBackupFormat);
        $oSQLDump->backup();
    }

    /**
     * Like the constructor, we make __clone private, so nobody can clone the instance
     */
    private function __clone()
    {
    }

}
