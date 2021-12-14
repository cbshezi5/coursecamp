<?php


require '../../include/query.php';

class Register extends Query{

	private $name;
	private $surname;
	private $email;
	private $idNumber;
	private $password;
	private $raw_password;
	private $type;

	function __construct($name, $surname, $email, $idNumber, $password){

		parent::__construct();

		$this->name = $name;
		$this->surname = $surname;
		$this->email = $email;
		$this->idNumber = $idNumber;
		$this->password = md5($password);
		$this->raw_password = $password;
		$this->type = 'user';

		// Check If ID Number Has Only Numbers

		if(!preg_match("/[0-9]/", $this->idNumber)) $this->error("Your Identity Number Has To Be Only Numbers");

		/*if(count($this->idNumber) == '13') $this->error("Your Identity Number Has To Be 13 Numbers");*/

		if($this->isIdUsed()) $this->error("This Identity Number Has Already Been Used");

		if($this->isEmailUsed()) $this->error("This Email Address Has Already Been Used");

		$this->createNewUser();

	}

	// Checks If Theres Already A User With This ID Number
	private function isIdUsed(){

		return ($this->count("SELECT count(user_id) FROM users WHERE id_number = '$this->idNumber'") == 1);

	}

	// Check If Theres Already A User With This Email Address
	private function isEmailUsed(){

		return ($this->count("SELECT count(user_id) FROM users WHERE email = '$this->email'") == 1);

	}

	private function createNewUser(){

		if($this->insert("INSERT INTO users VALUES('$this->name', '$this->surname', '$this->email', '$this->idNumber', '$this->password', '$this->type', NULL)")){

			// User Account Was Registered Successful
			echo json_encode(
					array(
						"error" => false,
						"message" => "Account Registration Successful",
						"email" => $this->email,
						"password" => $this->raw_password
					)
			);

		}else{

			echo json_encode(
					array(
						"error" => true,
						"message" => "Account Registration Failed",
						"id" => 0
					)
			);

		}

		exit();

	}

}

if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['id_number']) && isset($_POST['password'])){

	new Register($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['id_number'], $_POST['password']);

}else{

	echo json_encode(
			array(
				"error" => true,
				"message" => "Invalid Request, Missing Fields"
			)
	);

	exit();

}

?>