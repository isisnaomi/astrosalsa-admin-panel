<?php

require_once '../Domain/QueryGenerator.php';

/**
 * Database
 * Black box Class
 * Provides an interface for the access for a specified database.
 * Uses PHP 5 standard functions.
 */
class DataBase {

  /**
   * @var
   */
  private $name;

  /**
   * @var
   */
  private $server;

  /**
   * @var
   */
  private $connection;


  /**
   * DataBase constructor.
   * @param $dataBaseName
   * @param string $serverName
   */
  public function __construct( $dataBaseName, $serverName = 'localhost' ) {

    $this->name = $dataBaseName;
    $this->server = $serverName;

  }

  /**
  * @return string $this->name
  */
  public function getName() {

    return $this->name;

  }

  /**
  * @return string $lastDatabaseErrorMessage
  */
  public function getErrorMessage() {

    $lastDatabaseErrorMessage = mysql_error( $this->connection );
    return $lastDatabaseErrorMessage;

  }

  /**
  * @param  string  $username
  * @param  string  $password = null
  * @return string  $isConnectionEstablished
  */
  public function connect( $username, $password = null ) {

    $isPasswordDefined = ! is_null( $password );

    if ( $isPasswordDefined ) {

      $this->connection = mysql_connect( $this->server, $username, $password );

    } else {

      $this->connection = mysql_connect( $this->server, $username );

    }

    $isConnectionEstablished = mysql_select_db( $this->name, $this->connection );

    return $isConnectionEstablished;

  }

  /**
  * @return boolean $isDisconnected
  */
  public function disconnect() {

    $isDisconnected = mysql_close( $this->connection );
    return $isDisconnected;

  }

  /**
   * @param  string $tableName
   * @param  string[] $attributes
   * @param  string $rowFilters
   * @return array|bool
   * ] | false
   */
  public function selectRows( $tableName, $attributes, $rowFilters = null ) {

  	$query = QueryGenerator::generateSelectRowsQuery( $tableName, $attributes, $rowFilters );

    $areRowsFetched = mysql_query( $query, $this->connection );

    if ( $areRowsFetched ) {

      $fetchedRows = $areRowsFetched;
      $selectedRows = array();

      while ( $row = mysql_fetch_assoc( $fetchedRows ) ) {

        array_push( $selectedRows, $row );

      }

      return $selectedRows;

    } else {

      return false;

    }

  }

  /**
   * @param  string  $tableName
   * @param  [ attribute => attributeValue ][]  $row
   * @return boolean $isRowInserted
   */
  public function insertRow( $tableName, $row ) {

    $query = QueryGenerator::generateInsertRowQuery( $tableName, $row );

    $isRowInserted = mysql_query( $query, $this->connection );

    if ( $isRowInserted ) return true;
    else return false;

  }

  /**
   * @param  string  $tableName
   * @param  string  $rowFilters
   * @return boolean $isRowDeleted
   */
  public function deleteRow( $tableName, $rowFilters ) {

    $query = QueryGenerator::generateDeleteRowQuery( $tableName, $rowFilters );

    $isRowDeleted = mysql_query( $query, $this->connection );

    if ( $isRowDeleted ) return true;
    else return false;

  }

  /**
   * @param string $tableName
   * @param string[] $attributes
   * @param string $rowFilters
   * @return bool
   */
  public function updateRow( $tableName, $attributes, $rowFilters ) {

    $query = QueryGenerator::generateUpdateRowQuery( $tableName, $attributes, $rowFilters );

    $isRowUpdated = mysql_query( $query );

    if ( $isRowUpdated ) {
      return true;
    } else {
      return false;
    }

  }

}
