<?php

  class Request {

    private $target;
    private $type;
    private $data;

    public function __construct( $propierties ) {

      /* TODO: Check for valid $propierties */
      /* TODO: $propierties is not a very good variable name */

      $this->target = $propierties['target'];
      $this->type = $propierties['type'];
      $this->data = $propierties['data'];

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
