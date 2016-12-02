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
  * @var string
  */
  private $stamp;


  /**
   * @param string $type
   * @param string[][] $content
   * @param $stamp
   */
  public function __construct( $type, $content, $stamp ) {

    $this->type = $type;
    $this->content = $content;
    $this->stamp = $stamp;

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

  /**
  * @return string $this->stamp;
  */
  public function getStamp() {

    return $this->stamp;

  }


}
