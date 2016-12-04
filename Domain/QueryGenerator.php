<?php

/**
 * QueryGenerator
 * Generates queries about a specific action.
 * Provides a static interface. 
 * Does not require instantiation.
 * Uses PHP 5 standard functions.
 */
class QueryGenerator {

  /**
   * @param  string $tableName
   * @param  string[] $attributes
   * @param  string $rowFilters
   * @return string $query
   */
  public static function generateSelectRowsQuery( $tableName, $attributes = NULL, $rowFilters = null ) {

    $query = 'SELECT';
    $query .= ' ';

    $indexAttributes = 0;

    if( $attributes ) {

      foreach ( $attributes as $attribute ) {

        if ( $indexAttributes > 0 ) {

          $query .= ', ';

        }

        $query .= $attribute;
        $indexAttributes++;

      }

    } else {

      $query .= '*';

    }

    $query .= ' ';

    if( $rowFilters === null ){

      $query .= "FROM $tableName";

    } else {

      $query .= "FROM $tableName WHERE $rowFilters";

    }

    return $query;

  }

  /**
   * @param  string  $tableName
   * @param  [ attribute => attributeValue ][]  $row
   * @return string $query
   */
  public static function generateInsertRowQuery( $tableName, $row ) {

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

    return $query;

  }

  /**
   * @param  string  $tableName
   * @param  string  $rowFilters
   * @return string $query
   */
  public static function generateDeleteRowQuery( $tableName, $rowFilters ) {

    $query = "DELETE FROM $tableName WHERE $rowFilters";

    return $query;

  }

  /**
   * @param string $tableName
   * @param string[] $attributes
   * @param string $rowFilters
   * @return string
   */
  public static function generateUpdateRowQuery( $tableName, $attributes, $rowFilters ) {

    $query = "UPDATE $tableName SET ";

    $indexAttributes = 0;

    foreach ( $attributes as $attribute => $attributeValue ) {

      if ( $indexAttributes > 0 ) {
        $query .= ', ';
      }

      $isOperatorsRequired = strpos( $attributeValue, '-' );

      if ( $isOperatorsRequired ) {

        $query .= "$attribute=$attributeValue";

      } else {

        $query .= "$attribute='$attributeValue'";

      }

      $indexAttributes++;

    }

    $query .= " WHERE $rowFilters";
    return $query;

  }


}