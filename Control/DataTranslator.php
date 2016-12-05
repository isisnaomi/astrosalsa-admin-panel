<?php

require_once '../Domain/Request.php';

class DataTranslator{

  /**
   * Converts a Report into an associative array.
   *
   * @param Report $report
   * @return string[][] $reportAsArray
   */
  public static function translateReport( $report ) {

    $reportAsArray = [

      'type' => $report->getType(),
      'content' => $report->getContent()

    ];

    return $reportAsArray;

  }

  /**
   * Converts an associative array into a Request.
   *
   * @param string[][] $requestAsArray
   * @return Request $request;
   */
  public static function translateRequest ( $requestAsArray ) {

    $requestProperties = [

      'target' => $requestAsArray[ 'target' ],
      'type' => $requestAsArray[ 'type' ],
      'data' => $requestAsArray[ 'data' ]

    ];

    $request = new Request( $requestProperties );

    return $request;

  }

}
