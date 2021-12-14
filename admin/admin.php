
<?php

require '../api/include/sessions.php';

$session = new Session();

if(!$session->check_session() ){
  header("location: ../login");
}

if(!$session->isAdmin()){
  header("location: ../login");
}

?>

 <!DOCTYPE html>
<html style="height: 100%;">
<head>
  <title>Course Camp</title>
  <link href="../img/Logo.png" rel="icon" sizes="16x25" type="image/png" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/yazz.styles.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script defer src="https://kit.fontawesome.com/a81368914c.js"></script>
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    .overlay-wrap{

      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 9999 !important;
      background-color: rgba(0, 0, 0, .175);
      padding: 6px;
      padding-top: 20%;

    }

    .main-wrap{

      background-color: #fff;
      border-radius: 8px;
      padding: 10px;

    }
  </style>

</head>
<body style="background-color: #fff;height: 100%;">
	<div class="container" style="background-color: #fff;height: 100%;">

    <div class="nav navbar navbar-fixed-top" style="background-color: #fff;height: 50px;border-bottom:.05em solid rgba(211, 211, 211, .5);padding-top:5px;">
        

        <div class="media">
          
          <div class="media-left" style="padding-left: 5px;padding-top: 4px;">
            
            <center>
                 <div class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-cog"></span>
                  </a>
                  <ul class="dropdown-menu list-group">
                    <li class="list-group-item">
                      <a class="logout-btn app-bolder-text" style="">
                        Logout
                      </a>
                    </li>
                  </ul>
                </div>
            </center>

          </div>
          <div class="media-body">
            
            <span class="app-max-text page-header"></span>

          </div>
          <div class="media-right">
            
            <button class="btn btn-primary btn-sm create-admin">Create Admin</button>

          </div>

        </div>

    </div>

    <div class="row">
      
      <!-- <div class="col-sm-3"></div> -->
      <div class="col-sm-6">

        <div class="space-large"></div>
        <div class="space-large"></div>
        <div class="space-large"></div>

        <center>
          <div class="root-loader"></div>
        </center>

        <div class="card">
      
          <div class="card-header">
            
            <span class="app-max-text">
              ADD MORE COURSES
            </span>

          </div>
          <div class="card-body">

            <center>
              <span class="" id="add-error"></span>
            </center>
            
            <form class="add-form form-group">
              
              <div class="input-group input-group-lg">
                
                <label>Faculty :</label>
                <input type="text" name="faculty" placeholder="Add faculty" class="form-control add-faculty" />

              </div>
              <div class="space-medium"></div>

              <div class="input-group input-group-lg">
                
                <label>Course :</label>
                <input type="text" name="course" placeholder="Add course" class="form-control add-course" />

              </div>
              <div class="space-medium"></div>

              <div class="input-group input-group-lg">
                
                <label>Required APS :</label>
                <input type="number" name="aps" placeholder="Add APS" class="form-control add-aps" />

              </div>
              <div class="space-medium"></div>

              <div class="input-group input-group-lg">
                
                <label>Campus :</label>
                <input type="text" name="campus" placeholder="Add campus" class="form-control add-campus" />

              </div>
              <div class="space-medium"></div>
              <input type="hidden" name="context" value="1">

              <center>
                <button class="btn btn-primary add-btn form-control">ADD COURSE</button>
              </center>

            </form>

          </div>

        </div>

       


      </div>
      <div class="col-sm-6">
        
         <!-- USER ACTIONS -->

         <div class="space-large"></div>
         <div class="space-large"></div>
         <div class="space-large"></div>

        <div class="card">
          
          <div class="card-header">
            
            <span class="app-max-text">
              Admin Extra Actions
            </span>

          </div>
          <div class="card-body ">
            <center>
              <span class="actions-error"></span>
            </center>
            <div class="list-group action-list"></div>

          </div>

        </div>


        <div class="overlay-wrap" style="display: none;">
          
          <div class="main-wrap">
              
              <div class="media">
                
                <div class="media-left overlay-loader"></div>
                <div class="media-body">
                  Admin Login Details
                </div>
                <div class="media-right">
                  <button class="btn btn-primary overlay-close">close</button>
                </div>

              </div>
              <div class="space-medium"></div>
              <span class="admin-error"></span>
            <div class="list-group">
              <div class="list-group-item">
                <span class="app-bolder-text admin-email"></span>
                <br>
                <span class="app-bolder-text admin-password"></span>
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
   
  </div>
  <script type="text/javascript" src="../js/main.js"></script>
  <script type="text/javascript">

    const user = <?php echo json_encode($session->user()); ?>;
    (function(http, $, USER){

      $.html('.page-header', `Admin : ${USER.name}`)


      let updateOpen = false

      let toggleUpdate = function(){

        if(updateOpen){

          $.get('.overlay-wrap').style.display = 'none'

          updateOpen = false

        }else{

          $.get('.overlay-wrap').style.display = 'block'
          updateOpen = true

        }

      }

      $.get('.overlay-close').onclick = function(){

        toggleUpdate()

      }

      $.get('.create-admin').onclick = function(){

        toggleUpdate()
        $.get('.overlay-loader').append($.loader())

        let form = new FormData()
        form.append('context', 5);

        http.request({
          method : 'POST',
          url    : '../api/root/',
          form : form
        }, data => {

          $.html('.overlay-loader', '')
          $.html('.admin-error', data.message)

          if(data.error){
            console.log(error)
          }else{

            $.html('.admin-password', data.password)
            $.html('.admin-email', data.email)

          }

        })

      }

      $.get('.actions-error').append($.loader())

      let getUsers = function(){

        let form = new FormData()
        form.append('context', 2)

          http.request({
          method : 'POST',
          url    : '../api/root/',
          form : form
        }, data => {

           if(data.error){
            $.html('.actions-error', data.message)
           }else{

             $.html('.actions-error', '')

             data.users.forEach( user => {

                console.log(user)

                let Row = $.create('div', 'list-group-item')
                let NAME = $.create('span', 'app-bolder-text')

                NAME.innerHTML = `${user.name} ${user.surname} | ${user.email} | ${user.id_number}`

                let ButtonROW = $.create('div', 'button-row')

                let ReportButton = $.create('button', 'btn-primary btn btn-sm')
                let DeleteButton = $.create('button', 'btn-danger btn btn-sm')

                ReportButton.textContent = 'Create Report'
                DeleteButton.textContent = 'Delete Account'

                ReportButton.onclick = function(){
                  createReport(user.user_id)
                }

                DeleteButton.onclick = function(){
                  deleteAccount(user.user_id, Row)
                }

                Row.append(NAME, ButtonROW)
                ButtonROW.append(ReportButton, DeleteButton)

                $.get('.action-list').append(Row)

             })

           }

        })

      }

      let createReport = function(id){

        let form = new FormData()

        form.append('id', id)
        form.append('context', 3)

        $.get('.actions-error').append($.loader())

        http.request({
          method : 'POST',
          url    : '../api/root/',
          form : form
        }, data => {

          if(data.error){

            $.html('.actions-error', data.message)

          }else{

            $.html('.actions-error', data.message)

            let a = $.create('a', 'download-file')
            a.href = data.file
            a.textContent = 'File Generated'
            a.download = true

            a.click()

          }

        })

      }

      let deleteAccount = function(id, ROW){

        let form = new FormData()
        form.append('id', id)
        form.append('context', 4)

        http.request({
          method : 'POST',
          url    : '../api/root/',
          form   : form
        }, data => {

          if(data.error){

            $.html('.actions-error', data.message)

          }else{

            $.html('.actions-error', data.message)

            $.get('.action-list').removeChild(ROW)

          }

        })

      }

      getUsers()

      let checkInputs = function(self){

        let inputs = self.elements

          for(let i = 0; i <= 3; i++){
            console.log(inputs.item(i).value)
            if(inputs.item(i).value === ''){
              el.html("#add-error", 'No Field Should Be Empty')
              return true
            }

          }

          false

      }


      $.get('.add-form').onsubmit = function(e){

        e.preventDefault()

        if(checkInputs(this)) return

        $.get('#add-error').append($.loader())

        http.request({
          method : 'POST',
          url : '../api/root/',
          form : new FormData(this)
        }, data => {

          $.html('#add-error', data.message)

          if(!data.error){

            for(let i = 0; i < this.elements.length; i++){

              this.elements.item(i).value = ''

            }

          }

        })

      }

      $.get('.logout-btn').onclick = () => {

          let form = new FormData()

          form.append('context', 3)
          form.append('logout', true)

          $.get('.root-loader').append($.loader())

          http.request({
            method : 'POST',
            url : '../api/user/',
            form : form
          }, data => {

            window.location = '../login'

          })

        }

    })(http, el, user)

  </script>
</body>
</html>
