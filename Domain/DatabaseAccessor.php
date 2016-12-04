<?php

require_once '../Domain/QueryGenerator.php';

/**
 * Database
 * Black box Class
 * Provides an interface for the access for a specified database.
 * Uses PHP 5 standard functions.
 */
class DatabaseAccessor {

  /**
   * @var
   */
  private $name;

  /**
   * @var
   */
  private $tableName;

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
   *
   * @param $dataBaseName
   * @param $tableName
   * @param string $serverName
   */
  public function __construct( $dataBaseName, $tableName, $serverName = '127.0.0.1:8889' ) {

    $this->name = $dataBaseName;
    $this->tableName = $tableName;
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

    if ( $this->connection ) {
      mysql_select_db( $this->name, $this->connection );
      $isConnectionEstablished = true;
    } else {
      $isConnectionEstablished = false;
    }

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
   * @param  string[] $attributes
   * @param  string $rowFilters
   * @return array|bool
   * ] | false
   */
  public function selectRows( $attributes= NULL, $rowFilters = NULL ) {

  	$query = QueryGenerator::generateSelectRowsQuery( $this->tableName, $attributes, $rowFilters );

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
   * @param  [ attribute => attributeValue ][]  $row
   * @return bool $isRowInserted
   */
  public function insertRow( $row ) {

    $query = QueryGenerator::generateInsertRowQuery( $this->tableName, $row );

    $isRowInserted = mysql_query( $query, $this->connection );

    if ( $isRowInserted ) return true;
    else return false;

  }

  /**
   * @param  string  $rowFilters
   * @return boolean $isRowDeleted
   */
  public function deleteRow( $rowFilters ) {

    $query = QueryGenerator::generateDeleteRowQuery( $this->tableName, $rowFilters );

    $isRowDeleted = mysql_query( $query, $this->connection );

    if ( $isRowDeleted ) return true;
    else return false;

  }

  /**
   * @param string[] $attributes
   * @param string $rowFilters
   * @return bool|resource
   */
  public function updateRow( $attributes, $rowFilters ) {

    $query = QueryGenerator::generateUpdateRowQuery( $this->tableName, $attributes, $rowFilters );

    $isRowUpdated = mysql_query( $query );

    if ( $isRowUpdated ) {
      return $isRowUpdated;
    } else {
      return false;
    }

  }

  public function getLastInsertedId(){
      $lastId = mysql_insert_id();
      return $lastId;
  }

}
