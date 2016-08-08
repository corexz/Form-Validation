<?php
/**
* this class is a  Basic validation for Form input
* @Name: Validation calss
* @Author : Mohamed h Omar
* @email : m7md.omer@yahoo.com
*/
// this part shoulb be in a separate libraries/calsses directory 
class Validator {
	//difine errors array 
	private $errors = array(); 
	// define pass variable to hold the result of validation 
	private $pass = true;

	/** 
	* validation function : validate form inputs via given array of inputs using array of rules
	* the function use function dynamic calling
	* @param : $data 			Array hold $_POST values of the form
	* @param : $validationRules Array hold the validation set of rules
	* @return void
	*/
	public function validate($data, $validationRules){
		foreach($validationRules as $input=>$rule){	
			if(!isset($data[$input])){
				$this->errors[] = "$input is not there. " ;
				$this->pass= false;
			}
			$formRules=explode("|", $rule );
			foreach ($formRules as $formRule){
				if (strpos($formRule, ":")){			
					$subRule = explode(":", $formRule);
					$this->$subRule[0]($data[$input], $subRule[1],$input);
				}else{
					$this->$formRule($data[$input], $input);
				}
			}
			//$rule($input);
		}
	}
	
	/** 
	* required function : validate $field if required or not
	* @param : $field 	str 	hold $_POST values of the form
	* @param : $input 	str 	hold the name of the form item
	* @return void
	*/
	public function required($field,$input){
		if(empty($field)){
			$this->errors[] = "$input must be filled" ;
			$this->pass= false;
		}
	}
	
	/** 
	* email function : validate $field if valid Email  or not
	* @param : $field 	str 	hold $_POST values of the form
	* @param : $input 	str 	hold the name of the form item
	* @return void
	*/
	public function email($field, $input){

		if(!filter_var($field, FILTER_VALIDATE_EMAIL)){
			$this->errors[] = "the  $input must be a valid email .";
			$this->pass= false;
		}
	}
	
	/** 
	* maxi function : validate $field if less than givin valid value of the rule
	* @param : $field 	str 	hold $_POST values of the form
	* @param : $value 	str 	hold the validation value of the rule
	* @param : $input 	str 	hold the name of the form item
	* @return void
	*/
	public function maxi($field, $value, $input){
		if(strlen($field) >= $value){
			$this->errors[] = "$input  must be less than $value" ;
			$this->pass= false;
		}	
	}
	
	/** 
	* mini function : validate $field if more than givin valid value of the rule
	* @param : $field 	str 	hold $_POST values of the form
	* @param : $value 	str 	hold the validation value of the rule
	* @param : $input 	str 	hold the name of the form item
	* @return void
	*/
	public function mini($field, $value ,$input){
		if(strlen($field) <= $value){
			$this->errors[] = "$input must be more than $value" ;
			$this->pass= false;
		}
	}

	/** 
	* int function : validate $field if integer
	* @param : $field 	str 	hold $_POST values of the form
	* @param : $input 	str 	hold the name of the form item
	* @return void
	*/
	public function int($field, $input){
		if(!is_int($field)){
			$this->errors[] = "$input must be an integer number." ;
			$this->pass= false;
		}
	}

	/** 
	* int function : validate $field if string
	* @param : $field 	str 	hold $_POST values of the form
	* @param : $input 	str 	hold the name of the form item
	* @return void
	*/
	public function string($field, $input){
		if(!filter_var($field, FILTER_SANITIZE_STRING)){
			$this->errors[] = "$input must be a String." ;
			$this->pass= false;
		}
	}

	/** 
	* isPass function : hold the validation result if pass or not
	* @return 			Boolean
	*/
	public function isPass() {
		if($this->pass === true){
			return true;
		}else{
			return false;
		}
	}
	/** 
	* getErrors function : print out  all errors through the validation process
	* @return 			void
	*/
	public function getErrors() {
		print "<div class = 'alert alert-danger' >";
		foreach ($this->errors as  $value) {
			print $value."<br>";
		}
		print "</div>";
	}
}
