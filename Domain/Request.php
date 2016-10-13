<?php
/**
* Request
* Includes the target, the type and data of the request
* in php lenguage
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
    * @param string[][] $data
    */
    public function __construct( $data ) {

      $this->target = $data['target'];
      $this->type = $data['type'];
      $this->data = $data['data'];

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

 ?>
