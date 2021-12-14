<?php

	require '../include/sessions.php';

	class User extends Session{

		private $id;
		private $resp;

		private $context;
		private $subjects;
		private $aps;
		private $logout;
		private $details;

		function __construct($context, $subjects = "", $user_aps = "", $logout = true, $details = ""){

			parent::__construct();

			if($this->check_session()){
				 
				 $this->id = $this->getUserId();

			}else{ echo json_encode(array("error" => true, "message" => "Invalid Request, Login Or Create An Account First")); exit(); }

			$this->context = $context;
			$this->subjects = $subjects;
			$this->aps = $user_aps;
			$this->logout = $logout;
			$this->details = $details;

			switch ($this->context) {

				/* Show Results Of This Users AP Score */
				case '1' :

					if($this->hasSubjectRow() && $this->userHasQualifiedCourses()){

						$this->showResults();

					}else{

						$this->error("We Cannot Show You Which Courses You Qualify For Since You Have Not Entered Your Subjects And APS OR You Don't Qualify For Any Courses");

					}

					break;

				/* Insert Subjects And User APS Into DB */
				case '2' :

					if($this->hasSubjectRow()){

						if($this->deleteSubjectRow()){

							$this->saveRow();

						}else{
							$this->error("Deleting Previous Subject Entry Failed");
						}

					}else{

						$this->saveRow();

					}

					break;

				case '3' :

					if($this->logout) {$this->sessionDestroy();}
					else{

						echo json_encode(array(
							"error" => true,
							"message" => "Invalid Logout"
						));
						exit();

					}

					break;

				case '4' : 

					$this->deleteAccount();

				 break;

				case '5' :

						$this->updateUser();

					break;
				
				default:

						$this->error("Invalid Request, Context Not Found");

					break;
			}

		}

		private function deleteAccount(){

			if($this->deleteUserRow()){

				if($this->deleteSubjectRow()){

					$this->sessionDestroy();
					// echo json_encode(array("error" => false, "message" => "Account Deleted Successful"));

				}else{
					$this->error("Unable To Go Ahead With Deletion");
				}

			}else{
				$this->error("Unable to Delete Account");
			}

		}

		private function sessionDestroy(){

			setcookie("user",'',strtotime('-30 days'),"/");
      setcookie("id",'',strtotime('-30 days'),"/");

			$_SESSION=array();
 			session_destroy();

 			echo json_encode(array(
 				"error" => false,
 				"message" => "You're Now Logged Out"
 			));
 			exit();

		}

		private function saveRow(){

			if($this->insertSubjectRow()){

				$this->saveInUserSubjects();

				echo json_encode(
					array(
						"error" => false,
						"message" => "Subjects And APS Saved",
					)
				);
				exit();

			}else{
				$this->error("Saving Your Entered Subjects Failed");
			}

		}

		private function saveInUserSubjects(){

			$this->delete("DELETE FROM user_subjects WHERE user_id = '$this->id'");

			$arrSubjects = explode(',', $this->subjects);
			$arrAPS = explode(',', $this->aps);

			for($i = 0; $i < count($arrSubjects); $i++){

				$subject = $arrSubjects[$i];
				$level = $arrAPS[$i];

				$this->insert("INSERT INTO user_subjects VALUES('$this->id', '$subject', '$level', NULL)");

			}

		}

		private function showResults(){

			$subRow = $this->getSubjectRow();

			$this->resp['user'] = array(

				"user_subject" => $subRow['user_subjects'],
				"user_aps"		 => $subRow['ap_score']

			);

			$rows = $this->rows($this->aps > 30 ? "SELECT * FROM courses" : "SELECT * FROM courses WHERE course_aps < '$this->aps'");


			if($rows->num_rows == 0){
				$this->resp['error'] = true;
				$this->resp['message'] = 'You APS Is Too Low To Qualify For Any Courses Offered';
			}else{

				while($course = $this->assoc($rows)){

					$this->resp['courses'][] = $this->formatCourse($course);

				}

			}

			echo json_encode($this->resp);
			exit();

		}

		private function formatCourse($course){

			return array(

				"faculty" => $course['faculty'],
				"course"	=> $course['course'],
				"course_aps" => $course['course_aps'],
				"campus"	=> explode(",", $course['campus'])

			);

		}

		private function updateUser(){

			$counter = 0;

			if(isset($this->details['name'])){

				$name = $this->details['name'];

				$this->update("UPDATE users SET name = '$name' WHERE user_id = '$this->id'");

				$counter++;

			}

			if(isset($this->details['id'])){

				$id = $this->details['id'];

				$this->update("UPDATE users SET id_number = '$id' WHERE user_id = '$this->id'");

				$counter++;

			}

			if(isset($this->details['email'])){

				$email = $this->details['email'];

				$this->update("UPDATE users SET email = '$email' WHERE user_id = '$this->id'");

				$counter++;

			}

			echo json_encode(array(
				"error" => false,
				"message" => $counter > 0 ? "Updates Done!" : "Nothing To Update"
			));
			exit();

		}

		private function deleteUserRow(){

			return $this->delete("DELETE FROM users WHERE user_id = '$this->id'");

		}

		private function hasSubjectRow(){

			return ($this->count("SELECT count(user_id) FROM subjects WHERE user_id = '$this->id'") == 1);

		}

		private function deleteSubjectRow(){

			return $this->delete("DELETE FROM subjects WHERE user_id = '$this->id'");

		}

		private function getSubjectRow(){

			return $this->row("SELECT * FROM subjects WHERE user_id = '$this->id'");

		}

		private function insertSubjectRow(){

			return $this->insert("INSERT INTO subjects VALUES('$this->id', '$this->subjects', '$this->aps', NULL)");

		}

		private function userHasQualifiedCourses(){

			 $APS = explode(',', $this->getSubjectRow()['ap_score']);

			 $this->aps = 0;

			 if(!empty($APS)){

				 foreach ($APS as $level) {

				 		$this->aps += (int) $level;

				 }

			 }

			 /*echo $this->aps;*/

			if($this->aps > 30) return true;

			return $this->count("SELECT count(course_aps) FROM courses WHERE course_aps >= '$this->aps'") > 0;

		}

	}

	if(isset($_POST['context'])){

		switch ($_POST['context']) {
			
			case 1:

					new User($_POST['context']);

				break;

			case 2 :

				if(isset($_POST['subjects']) && isset($_POST['aps'])){

					new User($_POST['context'], $_POST['subjects'], $_POST['aps']);

				}

				break;

			case 3:
				
				if(isset($_POST['logout'])){

					new User($_POST['context'], "", "", true);

				}

				break;

			case 4 :

				new User($_POST['context']);

			 break;


			case 5 : 

				$details['name'] = isset($_POST['name']) ? $_POST['name'] : "";
				$details['email'] = isset($_POST['email']) ? $_POST['email'] : "";
				$details['id'] = isset($_POST['id']) ? $_POST['id'] : "";

				new User($_POST['context'], "", "", false, $details);

			 break;
			
			default:

					echo json_encode(
						array(
							"error" => true,
							"message" => "Invalid Request1"
						)
					);

				break;
		}

	}else{

		echo json_encode(
			array(
				"error" => true,
				"message" => "Invalid Request2"
			)
		);

	}


?>