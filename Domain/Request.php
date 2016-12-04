<?php

/**
 * Request
 * Includes the target, the type and data of the request
 * in php language.
 */
class Request {
  
  /**
   * @var string
   */
  private $target;

  /**
   * @var string
   */
  private $type;

  /**
   * @var string[][]
   */
  private $data;


  /**
   * Request constructor.
   * @param $properties
   */
  public function __construct( $properties ) {

    $this->target = $properties['target'];
    $this->type = $properties['type'];
    $this->data = $properties['data'];

  }

  /**
   * @return string $this->target
   */
  public function getTarget() {

    return $this->target;

  }

  /**
   * @return string $this->type
   */
  public function getType() {

    return $this->type;

  }

  /**
   * @return string[][] $this->data
   */
  public function getData() {

    return $this->data;

  }

}
