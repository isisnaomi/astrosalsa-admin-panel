<?php

  class DataBase {

    /**
    * @var string
    */
    private $name;

    /**
    * @var string
    */
    private $server;

    /**
    * @var mysql_link_ID
    */
    private $connection;

    /**
    * @param string $name
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
    * @return string The most recent mysql error
    */
    public function getErrorMessage() {
      return mysql_error( $this->connection );
    }

    /**
    * @param  string  $serverName
    * @param  string  $username
    * @return string  $password
    */
    public function connect( $username, $password = null ) {

      $isPasswordDefined = ! is_null( $password );

      if ( $isPasswordDefined ) $this->connection = mysql_connect( $this->server, $username, $password );
      else $this->connection = mysql_connect( $this->server, $username );

      $isConnectionEstablished = mysql_select_db( $this->name, $this->connection );

      return $isConnectionEstablished;

    }

    /**
    * @return boolean
    */
    public function disconnect() {

      $isDisconnected = mysql_close( $this->connection );
      return $isDisconnected;

    }

    /**
    * @param  string  $tableName
    * @param  string[]  $attributes
    * @param  string  $rowFilters
    * @return ON FAIL: false, ON SUCCESS: [ attributeName => attributeValue ][]
    */
    public function selectRows( $tableName, $attributes, $rowFilters ) {

      $query = 'SELECT';
      $query .= ' ';
      $indexAttributes = 0;

      foreach ( $attributes as $attribute ) {

        if ( $indexAttributes > 0 ) $query .= ', ';

        $query .= $attribute;
        $indexAttributes++;

      }

      $query .= ' ';
      $query .= "FROM $tableName WHERE $rowFilters";

      $areRowsFetched = mysql_query( $query, $this->connection );

      if ( $areRowsFetched ) {

        $fetchedRows = $areRowsFetched;
        $selectedRows = array();

        while ( $row = mysql_fetch_assoc( $fetchedRows ) ) array_push( $selectedRows, $row );

        return $selectedRows;

      } else return false;

    }

    /**
    * @param  string  $tableName
    * @param  [ attribute => attributeValue, ... ]  $row
    * @return boolean
    */
    public function insertRow( $tableName, $row ) {

      $query .= "INSERT INTO $tableName (";
      $indexAttributes = 0;

      foreach ( $row as $attribute => $attributeValue ) {

        if ( $indexAttributes > 0 ) $query .= ', ';

        $query .= $attribute;
        $indexAttributes++;

      }

      $query .= ') VALUES (';
      $indexAttributesValues = 0;

      foreach ( $row as $attribute => $attributeValue ) {

        if ( $indexAttributesValues > 0 ) $query .= ', ';

        $query .= "'$attributeValue'";
        $indexAttributesValues++;

      }

      $query .= ')';

      $isRowInserted = mysql_query( $query, $this->conexion );

      return $isRowInserted;

    }

    /**
    * @param  string  $tableName
    * @param  string  $rowFilters
    * @return boolean
    */
    public function deleteRow( $tableName, $rowFilters ) {

      $query = "DELETE FROM $tableName WHERE $rowFilters";
      $isRowDeleted = mysql_query( $query, $this->connection );

      return $isRowDeleted;

    }

  }
