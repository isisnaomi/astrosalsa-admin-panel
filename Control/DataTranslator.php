<?php


class DataTranslator{
	
  /**
  * Converts a Report into an associative array
  * @param Report $report
  * @return string[][] $reportAsArray
  */
  public static function translateReport( $report ) {

    /* TODO: Check for valid $report */

    $array = [
      'type' => $report->getType(),
      'content' => $report->getContent()
    ];

    return $array;

  }

  /**
  * Converts an assoiative array into a Request
  * @param string[][] $requestAsArray
  * @return Request $request;
  */
  public static translateRequest( $requestAsArray ) {

    /* TODO: Check for valid $array */

    $requestPropierties = [
      'target' => $requestAsArray['target'],
      'type' => $requestAsArray['type'],
      'data' => $requestAsArray['data']
    ];

    $request = new Request( $requestPropierties );
    return $request;

  }


}