<?php
/**
* Report
* Includes type of report: data || error
* and the content generated after a requested action
*/
class Report {
  /**
  * @var string
  */
  private $type;
  /**
  * @var array
  */
  private $content;

  /**
  * @param string $type
  * @param array $content
  */
  public function __construct( $type, $content ) {

    $this->type = $type;
    $this->content = $content;

  }

  /**
  * @return $this->type;
  */
  public function getType() {
    return $this->type;
  }
  /**
  * @return $this->content;
  */
  public function getContent() {
    return $this->content;
  }

}

 ?>
