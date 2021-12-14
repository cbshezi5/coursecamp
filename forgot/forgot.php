<?php

require '../api/include/sessions.php';

$session = new Session();

if($session->check_session()){
  header("location: ../");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="../css/yazz.styles.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/load.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.4/pdfobject.min.js" integrity="sha512-mW7siBAOOJTkMl77cTke1Krn+Wz8DJrjMzlKaorrGeGecq0DPUq28KgMrX060xQQOGjcl7MSSep+/1FOprNltw==" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <script type="text/javascript" src="../js/main.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style type="text/css">
  	
  	.card{
  		border: .05em solid rgba(211, 211, 211, 1);
  		margin: 2%;
  		border-radius: 10px;
  	}

  	.card-header{
  		padding-left: 5%;
  		border-bottom: .05em solid rgba(211, 211, 211, .5);
  		background-color: rgba(211, 211, 211, .05);

  	}

  	.card-body{
  		padding-top: 5%;
  		padding: 4%; 
  	}

  </style>

</head>
<body>

	<div class="row">
		
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			
			<div class="space=large"></div>
			<div class="space=large"></div>
			<div class="space=large"></div>
			<div class="space=large"></div>

			<div class="card">
				
				<div class="card-header">
					
					<div class="media">
						<div class="media-body">
							<h2 style="color: #00419f">Forgot Password?</h2>
						</div>
						<div class="media-right">
						

						</div>
					</div>

				</div>
				<div class="card-body">
					
					<center>

						<samp class="forgot-error" style="color: red"></samp>

						<form class="form-group forgot-form" style="margin:auto;">

							<div class="input-div one">
           		   <div class="i">
           		   		#
           		   </div>
           		   <div class="div">
           		   		<!-- <h5>Email</h5> -->
           		   		<input type="number" name="id_number" class="input id-number" placeholder="ID Number" required>
           		   </div>
           		</div>
           		<samp class="id-validator"></samp>
							<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<!-- <h5>Email</h5> -->
           		   		<input type="email" name="email" class="input" placeholder="Email Address" required>
           		   </div>
           		</div>
           		<div class="input-div one">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<!-- <h5>Password</h5> -->
           		    	<input type="password" name="password" class="input" placeholder="Password" required>
            	   </div>
            	</div>
            	<input type="hidden" name="context" value="2">

            	<center>
            		<button class="btn btn-success" class="form-control" type="submit">
            			Save
            		</button>
            	</center>
							<!-- <div class="input-group input-group-lg">
								<input type="number" name="id_number" class="form-control" placeholder="ID Number" />
							</div>

							<div class="space-small"></div>

							<div class="input-group input-group-lg">
								<input type="email" name="email" class="form-control" placeholder="Email Address" />
							</div>
							
							<div class="space-small"></div>

							<div class="input-group input-group-lg">
								<input type="text" name="password" class="form-control" placeholder="New Password" />
							</div> -->

							<div class="space-small"></div>

						</form>
					</center>

				</div>

			</div>

		</div>
		<div class="col-lg-3"></div>

	</div>

	<script type="text/javascript">
		
		(function($, http){

			let checkInputs = function(self){

          let inputs = self.elements

            for(let i = 0; i < inputs.length; i++){

              if(inputs.item(i).value === ''){
                el.html(".forgot-error", 'You Have To Fill In All Your Login Credentials')
                return
              }

            }

        }

      ontype($.get('.id-number'))

			$.get('.forgot-form').onsubmit = function(e){

				e.preventDefault()

				let payload = validIdentityNumber($.get('.id-number').value, '.id-validator')

				if(!payload.valid) return

				checkInputs(this)

				http.request({
					method : 'POST',
					url : '../api/auth/',
					form : new FormData(this)
				}, data => {

					if(data.error){
						$.html('.forgot-error', data.message)
					}else{

						window.location = '../login/'

					}

				})

			}

		})(el, http)

	</script>

</body>
</html>