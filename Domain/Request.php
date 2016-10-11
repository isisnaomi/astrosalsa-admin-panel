<?php

  class Request {

    private $target;
    private $type;
    private $data;

    public function __construct( $data ) {

      $this->target = $data['target'];
      $this->type = $data['type'];
      $this->data = $data['data'];

    }

    public function getTarget() {
      return $this->target;
    }

    public function getType() {
      return $this->type;
    }

    public function getData() {
      return $this->data;
    }

  }

 ?>
