<?php

	class Package {

			/**
   		* @var string
    	*/
			private $packageID;

			/**
   		* @var int
    	*/
			private $classesIncluded;

			/**
   		* @var float
    	*/
			private $price;

			/**
   		* @param
    	*/
	   	public function __construct( $packageID, $classesIncluded, $price ) {
	   		$this->packageID = $packageID;
	   		$this->classesIncluded = $classesIncluded;
	   		$this->price = $price;
	   }

		 	/**
  		* @return float
			*/
	   	public function getPrice() {
	       return $this->price;
	   }

			/**
			* @return int
 			*/
	   	public function getClassesIncluded() {
	       return $this->classesIncluded;
	   }

	    /**
   		* @return string
      */
			public function getPackageID() {
	       return $this->packageID;
	   }

	 }
