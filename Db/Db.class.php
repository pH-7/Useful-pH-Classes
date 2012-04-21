<?php
/**
 * @author      SORIA Pierre-Henry
 * @email       pierrehs@hotmail.com
 * @link        http://github.com/pH-7
 * @copyright   Copyright pH7 Script All Rights Reserved.
 * @license     CC-BY - http://creativecommons.org/licenses/by/3.0/
 */
 
namespace PH7\Framework\Db;
defined('PH7') or exit('Restricted access');

/**
 * @class Singleton Class
 */
class Db {

    /**
     * @desc static attributes of the class
     * Holds an insance of self
     * $@var $sDsn Data Source Name
     * @var string $sUsername
     * @var string $sPassword
     * @var string $sPrefix
     * @var array $aDriverOptions
     * @var integer $iCount
     * @var integer $iTime
     * @var object $_oInstance
     */
    private static $sDsn, $sUsername, $sPassword, $sPrefix, $aDriverOptions, $iCount = 0, $iTime = 0, $_oInstance = NULL;

    /**
    *
    * @desc The constructor is set to private so,
    * so nobody can create a new instance using new.
    *
    */
    private function __construct() {}

    /**
    * @desc Return DB instance or create intitial connection.
    * @return object (PDO)
    */
        public static function getInstance($sDsn = NULL, $sUsername = NULL, $sPassword = NULL, $aDriverOptions = NULL, $sPrefix = NULL) {
                if(self::$_oInstance === NULL)
                {
                    if(!empty($sDsn))
                    {
                       self::$sDsn = $sDsn;
                    }

                    if(!empty($sUsername))
                    {
                        self::$sUsername = $sUsername;
                    }

                    if(!empty($sPassword))
                    {
                        self::$sPassword = $sPassword;
                    }

                    if(!empty($aDriverOptions))
                    {
                        self::$aDriverOptions = $aDriverOptions;
                    }

                    if(!empty($sPrefix))
                    {
                        self::$sPrefix = $sPrefix;
                    }

                    self::$_oInstance = new \PDO(self::$sDsn, self::$sUsername, self::$sPassword, self::$aDriverOptions);
                    self::$_oInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                }

                return self::$_oInstance;
        }

        /**
         * @desc Increment function.
         * @return void
         */
        private function increment() {
            ++self::$iCount;
        }

    /**
     * @desc Initiates a transaction.
     * @return bool
     */
    public function beginTransaction() {
        return self::$_oInstance->beginTransaction();
    }

    /**
     * @desc Commits a transaction.
     * @return bool
     */
    public function commit() {
        return self::$_oInstance->commit();
    }

    /**
     * @desc Fetch the SQLSTATE associated with the last operation on the database handle.
     * @return string
     */
    public function errorCode() {
        return self::$_oInstance->errorCode();
    }

    /**
     * @desc Fetch extended error information associated with the last operation on the database handle.
     * @return array
     */
    public function errorInfo() {
        return self::$_oInstance->errorInfo();
    }

    /**
     * @desc Execute an SQL statement and return the number of affected rows.
     * @param string $sStatement
     * @return mixed (boolean | integer)
     */
    public function exec($sStatement) {
        $sStartTime = microtime(true);
        $mReturn = self::$_oInstance->exec($sStatement);
        $this->increment();
        $this->addTime($sStartTime, microtime(true));
        return $mReturn;
    }

    /**
     * @desc Retrieve a database connection attribute.
     * @param int $iAttribute
     * @return mixed
     */
    public function getAttribute($iAttribute) {
        return self::$_oInstance->getAttribute($iAttribute);
    }

    /**
     * @desc Return an array of available PDO drivers.
     * @return array
     */
    public function getAvailableDrivers(){
        return self::$_oInstance->getAvailableDrivers();
    }

    /**
     * @desc Returns the ID of the last inserted row or sequence value.
     * @param string $sName Name of the sequence object from which the ID should be returned.
     * @return string
     */
    public function lastInsertId($sName) {
        return self::$_oInstance->lastInsertId($sName);
    }

    /**
     * @desc Prepares a statement for execution and returns a statement object.
     * @param string $sStatement A valid SQL statement for the target database server.
     * @return PDOStatement
     */
    public function prepare ($sStatement) {
        return self::$_oInstance->prepare($sStatement);
    }

    /**
     * @desc Execute an SQL prepared with prepare()
     * @param string $sStatement
     * @return boolean
     */
    public function execute($sStatement) {
        $sStartTime = microtime(true);
        $bReturn = self::$_oInstance->execute($sStatement);
        $this->increment();
        $this->addTime($sStartTime, microtime(true));
        return $bReturn;
    }

    /**
     * @desc Executes an SQL statement, returning a result set as a PDOStatement object.
     * @param string $sStatement
     * @return mixed (object | boolean) PDOStatement object, or FALSE on failure.
     */
    public function query($sStatement) {
        $sStartTime = microtime(true);
        $mReturn = self::$_oInstance->query($sStatement);
        $this->increment();
        $this->addTime($sStartTime, microtime(true));
        return $mReturn;
    }

    /**
     * @desc Execute query and return all rows in assoc array.
     * @param string $sStatement
     * @return array
     */
    public function queryFetchAllAssoc($sStatement) {
        return self::$_oInstance->query($sStatement)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @desc Execute query and return one row in assoc array.
     * @param string $sStatement
     * @return array
     */
    public function queryFetchRowAssoc($sStatement) {
        return self::$_oInstance->query($sStatement)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @desc Execute query and select one column only.
     * @param string $sStatement
     * @return mixed
     */
    public function queryFetchColAssoc($sStatement) {
        return self::$_oInstance->query($sStatement)->fetchColumn();
    }

    /**
     * @desc Quotes a string for use in a query.
     * @param string $sInput
     * @param integer $iParameterType
     * @return string
     */
    public function quote($sInput, $iParameterType = 0) {
        return self::$_oInstance->quote($sInput, $iParameterType);
    }

    /**
     * @desc Rolls back a transaction.
     * @return boolean
     */
    public function rollBack() {
        return self::$_oInstance->rollBack();
    }

    /**
     * @desc Set an attribute.
     * @param integer $iAttribute
     * @param mixed $mValue
     * @return boolean
     */
    public function setAttribute($iAttribute, $mValue) {
        return self::$_oInstance->setAttribute($iAttribute, $mValue);
    }

       /**
        * @desc Count the number of requests.
        * @return float number
       */
      public static function queryCount() {
        return self::$iCount;
      }

      /**
       * @desc Add Time Query.
       * @param integer $iStartTime
       * @param integer $iEndTime
       * @return void
       */
      public function addTime($iStartTime, $iEndTime) {
        self::$iTime += round($iEndTime - $iStartTime, 6);
      }

      /**
       * @desc Time Query.
       * @return string
       */
      public static function time() {
        return self::$iTime;
      }

    /**
     * @desc If table name is empty, only prefix will be returned otherwise the table name with its prefix will be returned.
     * @param string $sTable Table name.
     * @param boolean $bTrim With or without a space before and after the table name. Default valut is "false", so with space before and after table name.
     * @return string prefixed table name, just prefix if table name is empty.
     */
   public static function prefix($sTable = '', $bTrim = false) {
           $sSpace = (!$bTrim) ? ' ' : '';
           return ($sTable !== '') ? $sSpace . self::$sPrefix . $sTable . $sSpace : self::$sPrefix;
    }

     /**
     * @desc Free database.
     * @param bool $bCloseCursor for method closeCursor of PDOStatement class.
     * @param bool $bCloseConnection for close connection of PDO.
     */
    public static function free($bCloseCursor = NULL, $bCloseConnection = TRUE)
    {
      // Close Cursor
      if(!empty($bCloseCursor)) {
      $bCloseCursor->closeCursor();
      }
      // Free instance object PDO
      if($bCloseConnection === TRUE) {
      return self::$_oInstance = NULL;
      }
    }

    /**
    *
    * @desc Like the constructor, we make __clone private so,
    * nobody can clone the instance
    *
    */
    private function __clone()
    {
    }

}
