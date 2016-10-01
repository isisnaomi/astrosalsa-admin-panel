	<?php
	class Package {
		private $packageID;
		private $classesIncluded;
		private $price;
		
		   

		   public function __construct($packageID, $classesIncluded, $price){
		   		$this->packageID = $packageID;
		   		$this->classesIncluded = $classesIncluded;
		   		$this->price = $price;  		
		   }

		   public function getPrice(){
		       return $this->price;
		   }

		   public function getClassesIncluded(){
		       return $this->classesIncluded;
		   }

		    public function getPackageID(){
		       return $this->packageID;
		   }
		}


	?>