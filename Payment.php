<?php

class Payment {

  private $paymentId;
  private $packageName;
  private $date;
  private $amount;
  private $location;

  public function __constructor( $paymentId, $packageName, $date, $amount, $location ) {
    $this->paymentId = $paymentId;
    $this->packageName = $packageName;
    $this->date = $date;
    $this->amount = $amount;
    $this->location = $location;
  }

  public function getPaymentId() {
    return $this->paymentId;
  }

  public function getDate() {
    return $this->date;
  }

  public function getAmount() {
    return $this->amount;
  }

  public function getLocation() {
    return $this->location;
  }

  public function generateTicket() {

    $ticket = 'Astrosalsa \n' .
      "Folio: $this->paymentId\n" .
      "Fecha: $this->date\n" .
      "Pago la cantidad: $this->amount \n" .
      "Para el paquete: $this->packageName\n" .
      $this->location;

    return $this->ticket;

  }

}
