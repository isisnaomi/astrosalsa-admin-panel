<?php

/**
* Class Payment
* Contains information of a payment
*/
class Payment {

  /**
  * @var int
  */
  private $paymentId;

  /**
  * @var string
  */
  private $packageName;

  /**
  * @var Date
  */
  private $date;

  /**
  * @var float
  */
  private $amount;

  /**
  * @var String
  */
  private $location;


  /**
	* @param int paymentId
	* @param string packageName
  * @param Date date
	* @param float amount
  * @param string location
	*/
  public function __constructor( $paymentId, $packageName, $date, $amount, $location ) {

    $this->paymentId = $paymentId;
    $this->packageName = $packageName;
    $this->date = $date;
    $this->amount = $amount;
    $this->location = $location;

  }

  /**
  * @return int $this->paymentId
  */
  public function getPaymentId() {

    return $this->paymentId;

  }

  /**
  * @return Date $this->date
  */
  public function getDate() {

    return $this->date;

  }

  /**
  * @return float $this->amount
  */
  public function getAmount() {

    return $this->amount;

  }

  /**
  * @return int $this->location
  */
  public function getLocation() {

    return $this->location;

  }

  /**
  * @return String[] $this->ticket
  */
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
