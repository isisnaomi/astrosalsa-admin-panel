<?php

/**
* Report
* Includes type of report: data || error
* and the content generated after a requested action
* in php language.
*/
class Report {

  /**
  * @var string
  */
  private $type;

  /**
  * @var string[][]
  */
  private $content;

  /**
   * @param string $type
   * @param string[][] $content
   */
  public function __construct( $type, $content ) {

    $this->type = $type;
    $this->content = $content;

  }

  /**
  * @return string $this->type;
  */
  public function getType() {

    return $this->type;

  }

  /**
  * @return string[][] $this->content;
  */
  public function getContent() {

    return $this->content;

  }



}
