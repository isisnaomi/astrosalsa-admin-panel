<?php
/**
* ClassPackage
* Contains the information of a class package
*/
class ClassPackage {

	/**
	* @var string
	*/
	private $packageId;

	/**
	* @var int
	*/
	private $classesIncluded;

	/**
	* @var float
	*/
	private $price;


	/**
	* @param string $packageId
	* @param int $classesIncluded
	* @param float $price
	*/
	public function __construct( $packageId, $classesIncluded, $price ) {

		$this->packageId = $packageId;
		$this->classesIncluded = $classesIncluded;
		$this->price = $price;

	}

	/**
	* @return float $this->price
	*/
	public function getPrice() {

		return $this->price;

	}

	/**
	* @return int $this->classesIncluded
	*/
	public function getClassesIncluded() {

		return $this->classesIncluded;

	}

	/**
	* @return int $this->packageID
	*/
	public function getPackageId() {

		return $this->packageId;

	}

}
