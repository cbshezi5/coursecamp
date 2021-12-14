<?php
session_start();

  
  class Login{

  	private $query = "";
  	private $email = "";
  	private $password = "";
    private $idNumber = "";
  	private $id = 0;
    private $context;

  	function __construct($context, $email = "", $password = "", $idNumber = ""){

  		require_once '../include/query.php';
  		$this->query = new Query();

      $this->context = $context;
  		$this->email = $email;
  		$this->password = md5($password);
      $this->idNumber = $idNumber;

      switch ($this->context) {
        case 1:

          $this->id = $this->isUserAvail();

            if($this->id === 0){

              /* LOGIN FAILED */
              $this->query->error("Either Email or Password is incorrect");

            }else{

              $this->setSessions();

              echo json_encode(array("error" => false, "message" => "Login Successful", "id" => $this->id));

            }

            exit();


          break;

        case 2:

          if($this->lookForUser()){
            $this->updateUser();
          }else{
            $this->query->error("This User Details Do Not Match, No User Account Was Found");
          }

          break;
        
        default:

          $this->query->error("Incomplete Request");

          break;
      }

  		

  	}

  	private function isUserAvail(){

  		return ($this->query->count("SELECT count(user_id) FROM users WHERE email = '$this->email' AND pass_word = '$this->password'") == 1 ? $this->query->row("SELECT user_id FROM users WHERE email = '$this->email' AND pass_word = '$this->password'")['user_id'] : 0);

  	}

  	private function setSessions(){

  		$_SESSION['id'] = $this->id;
      $_SESSION['type'] = $this->query->row("SELECT type FROM users WHERE user_id = '$this->id'")['type'];
      setcookie('id', $this->id, strtotime("+30 days"), "/", "", "", true);

  	}

    private function lookForUser(){

      return ($this->query->count("SELECT count(user_id) FROM users WHERE email = '$this->email' AND id_number = '$this->idNumber'") == 1);

    }

    private function updateUser(){

      $update = $this->query->update("UPDATE users SET pass_word = '$this->password'");
      // print_r($update);

    }

  }

  if(isset($_POST['context'])){

    switch ($_POST['context']) {
      case 1:

        if(isset($_POST['email']) && isset($_POST['password'])){

          new Login($_POST['context'], $_POST['email'], $_POST['password']);

        }else{

          echo json_encode(array("error" => true, "message" => "Invalid Request, You Login Credentials Are Empty"));

          exit();

        }

        break;

      case 2:

        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['id_number'])){

          new Login($_POST['context'], $_POST['email'], $_POST['password'], $_POST['id_number']);

        }else{

          echo json_encode(array("error" => true, "message" => "Invalid Request, You Login Credentials Are Empty"));

          exit();

        }


        break;
      
      default:
        # code...
        break;
    }

  }

  

?>