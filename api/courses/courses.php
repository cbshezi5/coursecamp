<?php

	require '../include/sessions.php';

	class Courses extends Session{

		private $context;
		private $term;
		private $id;

		function __construct($context, $term = ""){

			parent::__construct();

			if($this->check_session()){
				 
				 $this->id = $this->getUserId();

			}else{ echo json_encode(array("error" => true, "message" => "Invalid Request, Login Or Create An Account First")); exit(); }

			$this->context = (int) $context;
			$this->term = $term;

			switch ($this->context) {

				case 1:

						// Show All Courses Available

					$this->showAllCourses();

					break;

				case 2 :

						// Search For Courses Available

					$this->searchForCourses();

					break;
				
				default:

						$this->error("Unknown Context");

					break;
			}

		}

		private function searchForCourses(){

			$rows = $this->rows("SELECT * FROM courses WHERE faculty LIKE '$this->term%' OR course LIKE '$this->term%' OR course_aps LIKE '$this->term%' OR campus LIKE '$this->term%' OR course_aps < '$this->term'");

			$this->formatRows($rows);

		}

		private function showAllCourses(){

			$rows = $this->rows("SELECT * FROM courses");

			$this->formatRows($rows);

		}

		private function formatRows($rows){

			if($rows->num_rows == 0){

				echo json_encode(array(
					"error" => true,
					"message" => "No Course(s) Were Found"
				));

				exit();

			}else{

				$this->resp['message'] = "Courses Found";
				$this->reps['error'] = false;

				while ($course = $this->assoc($rows)) {

					$this->resp['courses'][] = $this->getPerCourse($course);

				}

				echo json_encode($this->resp);
				exit();

			}

		}

		private function getPerCourse($course){

			return array(

				"faculty" => $course['faculty'],
				"course"	=> $course['course'],
				"course_aps" => $course['course_aps'],
				"campus"	=> explode(",", $course['campus'])

			);

		}

	}


	if(isset($_POST['context'])){

		switch ($_POST['context']) {
			case 1:

				new Courses($_POST['context']);

				break;

			case 2 : 

				if(isset($_POST['term'])){

					new Courses($_POST['context'], $_POST['term']);

				}else{

					echo json_encode(array(

						"error" => true,
						"message" => "Incomplete Request"

					));

				}
			
			default:
					
					echo json_encode(array(

						"error" => true,
						"message" => "Invalid Request"

					));

				break;
		}

	}

	exit();



?>