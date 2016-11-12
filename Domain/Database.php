<?php

/**
* Database
* Black box Class
* Provides an interface for the access for a specified database.
* Uses PHP 5 standard functions.
*/
class DataBase {

  /**
  * @var string
  */
  private $databaseName;

  /**
  * @var string
  */
  private $serverName;

  /**
  * @var mysql_link_ID
  */
  private $connection;


  /**
  * @param string $databaseName
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
  * @param  string  $tableName
  * @param  string[]  $attributes
  * @param  string  $rowFilters
  * @return ON SUCCESS: [ attributeName => attributeValue ][], ON FAIL: false
  */
  public function selectRows( $tableName, $attributes, $rowFilters ) {

    $query = 'SELECT';
    $query .= ' ';

    $indexAttributes = 0;

    foreach ( $attributes as $attribute ) {

      if ( $indexAttributes > 0 ) {

        $query .= ', ';

      }

      $query .= $attribute;
      $indexAttributes++;

    }

    $query .= ' ';


    if( $rowFilters === null ){

      $query .= "FROM $tableName";

    } else {

      $query .= "FROM $tableName WHERE $rowFilters";

    }

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

    $query = "INSERT INTO $tableName (";

    $indexAttributes = 0;

    foreach ( $row as $attribute => $attributeValue ) {

      if ( $indexAttributes > 0 ) {

        $query .= ', ';

      }

      $query .= $attribute;
      $indexAttributes++;

    }

    $query .= ') VALUES (';
    $indexAttributesValues = 0;

    foreach ( $row as $attribute => $attributeValue ) {

      if ( $indexAttributesValues > 0 ) {

        $query .= ', ';

      }

      $query .= "'$attributeValue'";
      $indexAttributesValues++;

    }

    $query .= ')';

    $isRowInserted = mysql_query( $query, $this->connection );

    return $isRowInserted;

  }

  /**
  * @param  string  $tableName
  * @param  string  $rowFilters
  * @return boolean $isRowDeleted
  */
  public function deleteRow( $tableName, $rowFilters ) {

    $query = "DELETE FROM $tableName WHERE $rowFilters";
    $isRowDeleted = mysql_query( $query, $this->connection );

    return $isRowDeleted;

  }

}
