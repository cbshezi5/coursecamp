
<?php

require 'api/include/sessions.php';

$session = new Session();

if(!$session->check_session()){
  header("location: login");
}

if($session->isAdmin()){
  header("location: admin/");
}

?>

 <!DOCTYPE html>
<html>
<head>
  <title>Course Camp</title>
  <link href="../img/Logo.png" rel="icon" sizes="16x25" type="image/png" />
	<link rel="stylesheet" type="text/css" href="css/apscal.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/yazz.styles.css">
	<link defer href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script defer src="https://kit.fontawesome.com/a81368914c.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    
    @media only screen and (min-width: 702px){

      .navbar-fixed-bottom{

        padding-left: 20%;

      }

    }

    @media only screen and (max-width: 700px){

      .navbar-fixed-bottom{

        padding-left: 15%;

      }

    }

    .user-td{
      padding: 10px;
    }

    .block{
      display: inline-block;
      padding: 5%;
      width: 35%;
      height: 100px;
      border:.05em solid rgba(211, 211, 211, .5);
      border-radius: 8px;
      background-image: linear-gradient(to right, #5cb85c, #2880ff);
      transition: .5s;
      color: #fff;
    }

    .block-text {
      color: #fff;
      font-weight: 600;
      font-size: 14pt;
    }

  </style>

</head>
<body style="background-color: #fff;">

  <div class="nav navbar navbar-fixed-top" style="background-color: #fff;">
    
    <div class="media">
      
      <div class="media-left" style="padding-left: 10px;padding-top: 25px;">
        
        <a href="results">
          <span class="glyphicon glyphicon-user"></span>
        </a>

      </div>
      <div class="media-body" >
        
        <form class="form-group search-form">
          <div class="space-medium"></div>
          <div class="input-group input-group-md">

            <input type="text" name="term" class="form-control input-search" placeholder="search for Course using APS, Course Name, Campus or Faculty">

            <span class="input-group-addon">
              <span class="glyphicon glyphicon-search"></span>
            </span>


          </div>
          <input type="hidden" name="context" value="2">

        </form>

      </div>
      <div class="media-right self-align-center">
        
      </div>

    </div>

  </div>

  <div class="block-intro">

    <div class="space-large"></div>
    <div class="space-large"></div>
    <div class="space-large"></div>
    <div class="space-large"></div>
    <div class="space-large"></div>
    <div class="space-large"></div>
    <div class="space-large"></div>
    <div class="space-large"></div>
    
    <center>
        
        <div class="block">
      
          <center>
           <!--  <span class="glyphicon glyphicon-user" style="display: block"></span> -->
            <a href="results">
             <span class="app-max-text block-text">Your Profile</span>
            </a>
          </center>

        </div>
        <div class="block" style="">
          
          <center>
            <a class="choose-subs">
              <span class="app-max-text block-text">Choose Subjects</span>
            </a>
          </center>

        </div>

    </center>

  </div>

  <div class="show-search container">

    <div class="space-large"></div>
    <div class="space-large"></div>
    <div class="space-large"></div>
    
    <table class="table table-bordered">
      
      <thead>
          <center>
            <h3>Search Results</h3>
          </center>
        </thead>
       <!--  <tr class="apply-tr" style="display: none;">
          <td>Apply</td>
          <td colspan="3">
            <a href="https://ienabler.tut.ac.za/pls/prodi41/gen.gw1pkg.gw1view">
              Apply @ TUT
            </a>
          </td>
        </tr> -->
        <tr>
          <td>Faculty</td>
          <td>Course</td>
          <td>APS</td>
          <td>Campus</td>
          <td class="apply-lg-tr" style="display: none;">Apply</td>
        </tr>

    </table>
    <center>
      <span class="show-loader"></span>
    </center>

  </div>

	<div class="container show-subjects" style="background-color: #fff;display: none;">

    <div class="container-contents " style="background-color: #fff;" >

        <div class="space-large"></div>
        <div class="space-large"></div>
        <div class="media">
          
          <div class="media-body">
            
            <h3 style="color: #00419f">Choose Subjects</h3>

          </div>
          <div class="media-right">
            <center>
              <a class="remove">
                <span class="glyphicon glyphicon-times">
              </a>
            </center>
          </div>

        </div>

          <form id="calculate-aps" method="post">

            <table style="margin:50px auto;">
              <tr>
                <!-- <td style="left:0;color: #00419f"></td><td ><input type="submit" name="logout" class="sigout" value="Logout"></td> -->
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td><hr></td><td><hr></td>
              </tr>
              <tr>

                <td><h2 style="float:left;padding:;">Subjects</h2></td><td><h2>(%)</h2></td>
              </tr>
              <tr>
                <td style="padding-bottom:5px;"><hr></td><td style="padding-bottom:5px;"><hr></td>
              </tr>
              <tr>
                <td style="float:left;">Language*</td>
              </tr>
              <tr>
                <td>
                  <select class="subject1">
                    <option >  --Select a Subject--</option>
                    <option value="Afrikaans-First-AdditionalLanguage">Afrikaans First Additional Language</option>
                    <option value="Afrikaans-Home-Language">Afrikaans Home Language</option>
                    <option value="English-First-Additional-Language">English First Additional Language</option>
                    <option value="English-Home-Language">English Home Language</option>
                    <option value="IsiNdebele-First-Additional-Language">IsiNdebele First Additional Language</option>
                    <option value="IsiNdebele-Home-Language">IsiNdebele Home Language</option>
                    <option value="IsiXhosa-First-Additional-Language">IsiXhosa First Additional Language</option>
                    <option value="IsiXhosa-Home-Language">IsiXhosa Home Language</option>
                    <option value="IsiZulu-First-Additional-Language">IsiZulu First Additional Language</option>
                    <option value="IsiZulu-Home-Language">IsiZulu Home Language</option>
                    <option value="Sepedi-First-Additional-Language">Sepedi First Additional Language</option>
                    <option value="Sepedi-Home-Language">Sepedi Home Language</option>
                    <option value="Sesotho-First-Additional-Language">Sesotho First Additional Language</option>
                    <option value="Sesotho-Home-Language">Sesotho Home Language</option>
                    <option value="Setswana-First-Additional-Language">Setswana First Additional Language</option>
                    <option value="Setswana-Home-Language">Setswana Home Language</option>
                    <option value="SiSwati-First-Additional-Language">SiSwati First Additional Language</option>
                    <option value="SiSwati-Home-Language">SiSwati Home Language</option>
                    <option value="Tshivenda-First-Additional-Language">Tshivenda First Additional Language</option>
                    <option value="Tshivenda-Home-Language">Tshivenda Home Language</option>
                    <option value="Xitsonga-First-Additional-Language">Xitsonga First Additional Language</option>
                    <option value="Xitsonga-Home-Language">Xitsonga Home Language</option>
                  </select>
                </td>
                <td>
                  <select  class="marks1">
                    <option value="">%</option>
                    <option value="1">(0% - 29%)</option>
                    <option value="2">(30% - 39%)</option>
                    <option value="3">(40% - 49%)</option>
                    <option value="4">(50% - 59%)</option>
                    <option value="5">(60% - 69%)</option>
                    <option value="6">(70% - 79%)</option>
                    <option value="7">(80% - 100%)</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="float:left;">Language</td>
              </tr>
              <tr>
                <td>
                  <select class="subject2">
                    <option value="">--Select a Subject--</option>
                    <option value="Afrikaans-First-AdditionalLanguage">Afrikaans First Additional Language</option>
                    <option value="Afrikaans-Home-Language">Afrikaans Home Language</option>
                    <option value="English-First-Additional-Language">English First Additional Language</option>
                    <option value="English-Home-Language">English Home Language</option>
                    <option value="IsiNdebele-First-Additional-Language">IsiNdebele First Additional Language</option>
                    <option value="IsiNdebele-Home-Language">IsiNdebele Home Language</option>
                    <option value="IsiXhosa-First-Additional-Language">IsiXhosa First Additional Language</option>
                    <option value="IsiXhosa-Home-Language">IsiXhosa Home Language</option>
                    <option value="IsiZulu-First-Additional-Language">IsiZulu First Additional Language</option>
                    <option value="IsiZulu-Home-Language">IsiZulu Home Language</option>
                    <option value="Sepedi-First-Additional-Language">Sepedi First Additional Language</option>
                    <option value="Sepedi-Home-Language">Sepedi Home Language</option>
                    <option value="Sesotho-First-Additional-Language">Sesotho First Additional Language</option>
                    <option value="Sesotho-Home-Language">Sesotho Home Language</option>
                    <option value="Setswana-First-Additional-Language">Setswana First Additional Language</option>
                    <option value="Setswana-Home-Language">Setswana Home Language</option>
                    <option value="SiSwati-First-Additional-Language">SiSwati First Additional Language</option>
                    <option value="SiSwati-Home-Language">SiSwati Home Language</option>
                    <option value="Tshivenda-First-Additional-Language">Tshivenda First Additional Language</option>
                    <option value="Tshivenda-Home-Language">Tshivenda Home Language</option>
                    <option value="Xitsonga-First-Additional-Language">Xitsonga First Additional Language</option>
                    <option value="Xitsonga-Home-Language">Xitsonga Home Language</option>
                  </select>
                </td>
                <td>
                  <select  class="marks2">
                    <option value="">%</option>
                    <option value="1">(0% - 29%)</option>
                    <option value="2">(30% - 39%)</option>
                    <option value="3">(40% - 49%)</option>
                    <option value="4">(50% - 59%)</option>
                    <option value="5">(60% - 69%)</option>
                    <option value="6">(70% - 79%)</option>
                    <option value="7">(80% - 100%)</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="float:left;">Math</td>
              </tr>
              <tr>
                <td>
                  <select class="subject3">
                    <option value="">--Select a Subject--</option>
                    <option value="Mathematical-Literacy">Mathematical Literacy</option>
                    <option value="Mathematics">Mathematics</option>
                  </select>
                </td>
                <td>
                  <select  class="marks3">
                    <option value="">%</option>
                    <option value="1">(0% - 29%)</option>
                    <option value="2">(30% - 39%)</option>
                    <option value="3">(40% - 49%)</option>
                    <option value="4">(50% - 59%)</option>
                    <option value="5">(60% - 69%)</option>
                    <option value="6">(70% - 79%)</option>
                    <option value="7">(80% - 100%)</option>
                  </select>
                </td>
              </tr>

              <tr>
                <td style="float:left;">Subject 4</td>
              </tr>
              <tr>
                <td>
                  <select class="subject4">
                    <option value="">--Select a Subject--</option>
                    <option value="Life-Orientation">Life Orientation</option>
                    <option value="ABRSM-Practical-Music-Grade-7">ABRSM Practical Music Grade 7</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Afrikaans-Second-Additional-Language">Afrikaans Second Additional Language</option>
                    <option value="Agricultural-Management-Practices">Agricultural Management Practices</option>
                    <option value="Agricultural-Sciences">Agricultural Sciences</option>
                    <option value="Agricultural-Technology">Agricultural Technology</option>
                    <option value="Arabic-Second-Additional-Language">Arabic Second Additional Language</option>
                    <option value="Business-Studies">Business Studies</option>
                    <option value="Chinese-A-Level">Chinese A-Level</option>
                    <option value="Civil-Technology">Civil Technology</option>
                    <option value="Computer-Applications-Technology">Computer Applications Technology</option>
                    <option value="Consumer-Studies">Consumer Studies</option>
                    <option value="Dance-Studies">Dance Studies</option>
                    <option value="Design">Design</option>
                    <option value="Dramatic-Arts">Dramatic Arts</option>
                    <option value="Economics">Economics</option>
                    <option value="Electrical-Technology">Electrical Technology</option>
                    <option value="Engineering-Graphics-and-Design">Engineering Graphics and Design</option>
                    <option value="English-Second-Additional-Language">English Second Additional Language</option>
                    <option value="Equine-Studies">Equine Studies</option>
                    <option value="French-Second-Additional-Language">French Second Additional Language</option>
                    <option value="Geography">Geography</option>
                    <option value="German-Home-Language">German Home Language</option>
                    <option value="German-Second-Additional-Language">German Second Additional Language</option>
                    <option value="Gujarati-First-Additional-Language">Gujarati First Additional Language</option>
                    <option value="Gujarati-Second-Additional-Language">Gujarati Second Additional Language</option>
                    <option value="Hebrew-Second-Additional-Language">Hebrew Second Additional Language</option>
                    <option value="Hindi-First-Additional-Language">Hindi First Additional Language</option>
                    <option value="Hindi-Second-Additional-Language">Hindi Second Additional Language</option>
                    <option value="History">History</option>
                    <option value="Hospitality-Studies">Hospitality Studies</option>
                    <option value="Information-Technology">Information Technology</option>
                    <option value="IsiNdebele-Second-Additional-Language">IsiNdebele Second Additional Language</option>
                    <option value="IsiXhosa-Second-Additional-Language">IsiXhosa Second Additional Language</option>
                    <option value="IsiZulu-Second-Additional-Language">IsiZulu Second Additional Language</option>
                    <option value="Italian-Second-Additional-Language">Italian Second Additional Language</option>
                    <option value="Latin-Second-Additional-Language">Latin Second Additional Language</option>
                    <option value="Life-Sciences">Life Sciences</option>
                    <option value="Maritime-Economics">Maritime Economics</option>
                    <option value="Mechanical-Technology">Mechanical Technology</option>
                    <option value="Modern-Greek-Second-Additional-Language">Modern Greek Second Additional Language</option>
                    <option value="Music">Music</option>
                    <option value="Nautical-Science">Nautical Science</option>
                    <option value="Physical-Sciences">Physical Sciences</option>
                    <option value="Portuguese-Second-Additional-Language">Portuguese Second Additional Language</option>
                    <option value="Religion-Studies">Religion Studies</option>
                    <option value="Sepedi-Second-Additional-Language">Sepedi Second Additional Language</option>
                    <option value="Sesotho-Second-Additional-Language">Sesotho Second Additional Language</option>
                    <option value="Setswana-Second-Additional-Language">Setswana Second Additional Language</option>
                    <option value="Spanish-Second-Additional-Language">Spanish Second Additional Language</option>
                    <option value="Sport-and-Exercise-Science">Sport and Exercise Science</option>
                    <option value="Tamil-First-Additional-Language">Tamil First Additional Language</option>
                    <option value="Tamil-Second-Additional-Language">Tamil Second Additional Language</option>
                    <option value="TCL-Practical-Music-Grade-7">TCL Practical Music Grade 7</option>
                    <option value="Telegu-Second-Additional-Language">Telegu Second Additional Language</option>
                    <option value="Tourism">Tourism</option>
                    <option value="UNISA-Practical-Music-Grade-7">UNISA Practical Music Grade 7</option>
                    <option value="Urdu-First-Additional-Language">Urdu First Additional Language</option>
                    <option value="Urdu-Second-Additional-Language">Urdu Second Additional Language</option>
                    <option value="Visual-Arts">Visual Arts</option>
                    <option value="Xitsonga-Second-Additional-Language">Xitsonga Second Additional Language</option>
                  </select>
                </td>
                <td>
                  <select  class="marks4">
                    <option value="">%</option>
                    <option value="1">(0% - 29%)</option>
                    <option value="2">(30% - 39%)</option>
                    <option value="3">(40% - 49%)</option>
                    <option value="4">(50% - 59%)</option>
                    <option value="5">(60% - 69%)</option>
                    <option value="6">(70% - 79%)</option>
                    <option value="7">(80% - 100%)</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="float:left;">Subject 5</td>
              </tr>
              <tr>
                <td>
                  <select class="subject5">
                    <option value="">--Select a Subject--</option>
                    <option value="ABRSM-Practical-Music-Grade-7">ABRSM Practical Music Grade 7</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Afrikaans-Second-Additional-Language">Afrikaans Second Additional Language</option>
                    <option value="Agricultural-Management-Practices">Agricultural Management Practices</option>
                    <option value="Life-Orientation">Life Orientation</option>
                    <option value="Agricultural-Sciences">Agricultural Sciences</option>
                    <option value="Agricultural-Technology">Agricultural Technology</option>
                    <option value="Arabic-Second-Additional-Language">Arabic Second Additional Language</option>
                    <option value="Business=Studies">Business Studies</option>
                    <option value="Chinese-A-Level">Chinese A-Level</option>
                    <option value="Civil-Technology">Civil Technology</option>
                    <option value="Computer-Applications-Technology">Computer Applications Technology</option>
                    <option value="Consumer-Studies">Consumer Studies</option>
                    <option value="Dance-Studies">Dance Studies</option>
                    <option value="Design">Design</option>
                    <option value="Dramatic-Arts">Dramatic Arts</option>
                    <option value="Economics">Economics</option>
                    <option value="Electrical-Technology">Electrical Technology</option>
                    <option value="Engineering-Graphics-and-Design">Engineering Graphics and Design</option>
                    <option value="English-Second-Additional-Language">English Second Additional Language</option>
                    <option value="Equine-Studies">Equine Studies</option>
                    <option value="French-Second-Additional-Language">French Second Additional Language</option>
                    <option value="Geography">Geography</option>
                    <option value="German-Home-Language">German Home Language</option>
                    <option value="German-Second-Additional-Language">German Second Additional Language</option>
                    <option value="Gujarati-First-Additional-Language">Gujarati First Additional Language</option>
                    <option value="Gujarati-Second-Additional-Language">Gujarati Second Additional Language</option>
                    <option value="Hebrew-Second-Additional-Language">Hebrew Second Additional Language</option>
                    <option value="Hindi-First-Additional-Language">Hindi First Additional Language</option>
                    <option value="Hindi-Second-Additional-Language">Hindi Second Additional Language</option>
                    <option value="History">History</option>
                    <option value="Hospitality-Studies">Hospitality Studies</option>
                    <option value="Information-Technology">Information Technology</option>
                    <option value="IsiNdebele-Second-Additional-Language">IsiNdebele Second Additional Language</option>
                    <option value="IsiXhosa-Second-Additional-Language">IsiXhosa Second Additional Language</option>
                    <option value="IsiZulu-Second-Additional-Language">IsiZulu Second Additional Language</option>
                    <option value="Italian-Second-Additional-Language">Italian Second Additional Language</option>
                    <option value="Latin-Second-Additional-Language">Latin Second Additional Language</option>
                    <option value="Life-Sciences">Life Sciences</option>
                    <option value="Maritime-Economics">Maritime Economics</option>
                    <option value="Mechanical-Technology">Mechanical Technology</option>
                    <option value="Modern-Greek-Second-Additional-Language">Modern Greek Second Additional Language</option>
                    <option value="Music">Music</option>
                    <option value="Nautical-Science">Nautical Science</option>
                    <option value="Physical-Sciences">Physical Sciences</option>
                    <option value="Portuguese-Second-Additional-Language">Portuguese Second Additional Language</option>
                    <option value="Religion-Studies">Religion Studies</option>
                    <option value="Sepedi-Second-Additional-Language">Sepedi Second Additional Language</option>
                    <option value="Sesotho-Second-Additional-Language">Sesotho Second Additional Language</option>
                    <option value="Setswana-Second-Additional-Language">Setswana Second Additional Language</option>
                    <option value="Spanish-Second-Additional-Language">Spanish Second Additional Language</option>
                    <option value="Sport-and-Exercise-Science">Sport and Exercise Science</option>
                    <option value="Tamil-First-Additional-Language">Tamil First Additional Language</option>
                    <option value="Tamil-Second-Additional-Language">Tamil Second Additional Language</option>
                    <option value="TCL-Practical-Music-Grade-7">TCL Practical Music Grade 7</option>
                    <option value="Telegu-Second-Additional-Language">Telegu Second Additional Language</option>
                    <option value="Tourism">Tourism</option>
                    <option value="UNISA-Practical-Music-Grade-7">UNISA Practical Music Grade 7</option>
                    <option value="Urdu-First-Additional-Language">Urdu First Additional Language</option>
                    <option value="Urdu-Second-Additional-Language">Urdu Second Additional Language</option>
                    <option value="Visual-Arts">Visual Arts</option>
                    <option value="Xitsonga-Second-Additional-Language">Xitsonga Second Additional Language</option>
                  </select>
                </td>
                <td>
                  <select  class="marks5">
                    <option value="">%</option>
                    <option value="1">(0% - 29%)</option>
                    <option value="2">(30% - 39%)</option>
                    <option value="3">(40% - 49%)</option>
                    <option value="4">(50% - 59%)</option>
                    <option value="5">(60% - 69%)</option>
                    <option value="6">(70% - 79%)</option>
                    <option value="7">(80% - 100%)</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="float:left;">Subject 6</td>
              </tr>
              <tr>
                <td>
                  <select class="subject6">
                    <option value="">--Select a Subject--</option>
                    <option value="ABRSM-Practical-Music-Grade-7">ABRSM Practical Music Grade 7</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Afrikaans-Second-Additional-Language">Afrikaans Second Additional Language</option>
                    <option value="Agricultural-Management-Practices">Agricultural Management Practices</option>
                    <option value="Agricultural-Sciences">Agricultural Sciences</option>
                    <option value="Agricultural-Technology">Agricultural Technology</option>
                    <option value="Arabic-Second-Additional-Language">Arabic Second Additional Language</option>
                    <option value="Business-Studies">Business Studies</option>
                    <option value="Chinese-A-Level">Chinese A-Level</option>
                    <option value="Civil-Technology">Civil Technology</option>
                    <option value="Computer-Applications-Technology">Computer Applications Technology</option>
                    <option value="Consumer-Studies">Consumer Studies</option>
                    <option value="Dance-Studies">Dance Studies</option>
                    <option value="Design">Design</option>
                    <option value="Dramatic-Arts">Dramatic Arts</option>
                    <option value="Economics">Economics</option>
                    <option value="Electrical-Technology">Electrical Technology</option>
                    <option value="Engineering-Graphics-and-Design">Engineering Graphics and Design</option>
                    <option value="English-Second-Additional-Language">English Second Additional Language</option>
                    <option value="Equine-Studies">Equine Studies</option>
                    <option value="French-Second-Additional-Language">French Second Additional Language</option>
                    <option value="Geography">Geography</option>
                    <option value="German-Home-Language">German Home Language</option>
                    <option value="German-Second-Additional-Language">German Second Additional Language</option>
                    <option value="Gujarati-First-Additional-Language">Gujarati First Additional Language</option>
                    <option value="Gujarati-Second-Additional-Language">Gujarati Second Additional Language</option>
                    <option value="Hebrew-Second-Additional-Language">Hebrew Second Additional Language</option>
                    <option value="Hindi-First-Additional-Language">Hindi First Additional Language</option>
                    <option value="Hindi-Second-Additional-Language">Hindi Second Additional Language</option>
                    <option value="History">History</option>
                    <option value="Hospitality-Studies">Hospitality Studies</option>
                    <option value="Information-Technology">Information Technology</option>
                    <option value="IsiNdebele-Second-Additional-Language">IsiNdebele Second Additional Language</option>
                    <option value="IsiXhosa-Second-Additional-Language">IsiXhosa Second Additional Language</option>
                    <option value="IsiZulu-Second-Additional-Language">IsiZulu Second Additional Language</option>
                    <option value="Italian-Second-Additional-Language">Italian Second Additional Language</option>
                    <option value="Latin-Second-Additional-Language">Latin Second Additional Language</option>
                    <option value="Life-Sciences">Life Sciences</option>
                    <option value="Maritime-Economics">Maritime Economics</option>
                    <option value="Mechanical-Technology">Mechanical Technology</option>
                    <option value="Modern-Greek-Second-Additional-Language">Modern Greek Second Additional Language</option>
                    <option value="Music">Music</option>
                    <option value="Nautical-Science">Nautical Science</option>
                    <option value="Physical-Sciences">Physical Sciences</option>
                    <option value="Portuguese-Second-Additional-Language">Portuguese Second Additional Language</option>
                    <option value="Religion-Studies">Religion Studies</option>
                    <option value="Sepedi-Second-Additional-Language">Sepedi Second Additional Language</option>
                    <option value="Sesotho-Second-Additional-Language">Sesotho Second Additional Language</option>
                    <option value="Setswana-Second-Additional-Language">Setswana Second Additional Language</option>
                    <option value="Spanish-Second-Additional-Language">Spanish Second Additional Language</option>
                    <option value="Sport-and-Exercise-Science">Sport and Exercise Science</option>
                    <option value="Tamil-First-Additional-Language">Tamil First Additional Language</option>
                    <option value="Tamil-Second-Additional-Language">Tamil Second Additional Language</option>
                    <option value="TCL-Practical-Music-Grade-7">TCL Practical Music Grade 7</option>
                    <option value="Telegu-Second-Additional-Language">Telegu Second Additional Language</option>
                    <option value="Tourism">Tourism</option>
                    <option value="UNISA-Practical-Music-Grade-7">UNISA Practical Music Grade 7</option>
                    <option value="Urdu-First-Additional-Language">Urdu First Additional Language</option>
                    <option value="Urdu-Second-Additional-Language">Urdu Second Additional Language</option>
                    <option value="Visual-Arts">Visual Arts</option>
                    <option value="Xitsonga-Second-Additional-Language">Xitsonga Second Additional Language</option>
                    <option value="Life-Orientation">Life Orientation</option>
                  </select>
                </td>
                <td>
                  <select  class="marks6">
                    <option value="">%</option>
                    <option value="1">(0% - 29%)</option>
                    <option value="2">(30% - 39%)</option>
                    <option value="3">(40% - 49%)</option>
                    <option value="4">(50% - 59%)</option>
                    <option value="5">(60% - 69%)</option>
                    <option value="6">(70% - 79%)</option>
                    <option value="7">(80% - 100%)</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="float:left;">Subject 7</td>
              </tr>
              <tr>
                <td>
                  <select class="subject7">
                    <option value="">--Select a Subject--</option>
                    <option value="ABRSM-Practical-Music-Grade-7">ABRSM Practical Music Grade 7</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Afrikaans-Second-Additional-Language">Afrikaans Second Additional Language</option>
                    <option value="Agricultural-Management-Practices">Agricultural Management Practices</option>
                    <option value="Agricultural-Sciences">Agricultural Sciences</option>
                    <option value="Agricultural-Technology">Agricultural Technology</option>
                    <option value="Arabic-Second-Additional-Language">Arabic Second Additional Language</option>
                    <option value="Business=Studies">Business Studies</option>
                    <option value="Chinese-A-Level">Chinese A-Level</option>
                    <option value="Civil-Technology">Civil Technology</option>
                    <option value="Computer-Applications-Technology">Computer Applications Technology</option>
                    <option value="Consumer-Studies">Consumer Studies</option>
                    <option value="Dance-Studies">Dance Studies</option>
                    <option value="Design">Design</option>
                    <option value="Dramatic-Arts">Dramatic Arts</option>
                    <option value="Economics">Economics</option>
                    <option value="Electrical-Technology">Electrical Technology</option>
                    <option value="Engineering-Graphics-and-Design">Engineering Graphics and Design</option>
                    <option value="English-Second-Additional-Language">English Second Additional Language</option>
                    <option value="Equine-Studies">Equine Studies</option>
                    <option value="French-Second-Additional-Language">French Second Additional Language</option>
                    <option value="Geography">Geography</option>
                    <option value="German-Home-Language">German Home Language</option>
                    <option value="German-Second-Additional-Language">German Second Additional Language</option>
                    <option value="Gujarati-First-Additional-Language">Gujarati First Additional Language</option>
                    <option value="Gujarati-Second-Additional-Language">Gujarati Second Additional Language</option>
                    <option value="Hebrew-Second-Additional-Language">Hebrew Second Additional Language</option>
                    <option value="Hindi-First-Additional-Language">Hindi First Additional Language</option>
                    <option value="Hindi-Second-Additional-Language">Hindi Second Additional Language</option>
                    <option value="History">History</option>
                    <option value="Hospitality-Studies">Hospitality Studies</option>
                    <option value="Information-Technology">Information Technology</option>
                    <option value="IsiNdebele-Second-Additional-Language">IsiNdebele Second Additional Language</option>
                    <option value="IsiXhosa-Second-Additional-Language">IsiXhosa Second Additional Language</option>
                    <option value="IsiZulu-Second-Additional-Language">IsiZulu Second Additional Language</option>
                    <option value="Italian-Second-Additional-Language">Italian Second Additional Language</option>
                    <option value="Latin-Second-Additional-Language">Latin Second Additional Language</option>
                    <option value="Life-Sciences">Life Sciences</option>
                    <option value="Maritime-Economics">Maritime Economics</option>
                    <option value="Mechanical-Technology">Mechanical Technology</option>
                    <option value="Modern-Greek-Second-Additional-Language">Modern Greek Second Additional Language</option>
                    <option value="Music">Music</option>
                    <option value="Nautical-Science">Nautical Science</option>
                    <option value="Physical-Sciences">Physical Sciences</option>
                    <option value="Portuguese-Second-Additional-Language">Portuguese Second Additional Language</option>
                    <option value="Religion-Studies">Religion Studies</option>
                    <option value="Sepedi-Second-Additional-Language">Sepedi Second Additional Language</option>
                    <option value="Sesotho-Second-Additional-Language">Sesotho Second Additional Language</option>
                    <option value="Setswana-Second-Additional-Language">Setswana Second Additional Language</option>
                    <option value="Spanish-Second-Additional-Language">Spanish Second Additional Language</option>
                    <option value="Sport-and-Exercise-Science">Sport and Exercise Science</option>
                    <option value="Tamil-First-Additional-Language">Tamil First Additional Language</option>
                    <option value="Tamil-Second-Additional-Language">Tamil Second Additional Language</option>
                    <option value="TCL-Practical-Music-Grade-7">TCL Practical Music Grade 7</option>
                    <option value="Telegu-Second-Additional-Language">Telegu Second Additional Language</option>
                    <option value="Tourism">Tourism</option>
                    <option value="UNISA-Practical-Music-Grade-7">UNISA Practical Music Grade 7</option>
                    <option value="Urdu-First-Additional-Language">Urdu First Additional Language</option>
                    <option value="Urdu-Second-Additional-Language">Urdu Second Additional Language</option>
                    <option value="Visual-Arts">Visual Arts</option>
                    <option value="Xitsonga-Second-Additional-Language">Xitsonga Second Additional Language</option>
                    <option value="Life-Orientation">Life Orientation</option>
                  </select>
                </td>
                <td>
                  <select  class="marks7">
                    <option value="">%</option>
                    <option value="1">(0% - 29%)</option>
                    <option value="2">(30% - 39%)</option>
                    <option value="3">(40% - 49%)</option>
                    <option value="4">(50% - 59%)</option>
                    <option value="5">(60% - 69%)</option>
                    <option value="6">(70% - 79%)</option>
                    <option value="7">(80% - 100%)</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style=""> 

                	
                </td>
              </tr>
              <tr>
                <td ></td>
                <td style="font-size:20px;">

                </td>
              </tr>
            </table>
            <div class="">
            </div>

            <div class="nav navbar navbar-fixed-bottom" style="background-color: #fff">
                   
             <div class="media">
               <div class="media-left"></div>
               <div class="media-body">
                 <center>
                    <samp class="btn-error" style="color: red"></samp>
                    <button class="calculate-btn calcAps">Save Subjects</button>
                  </center>
               </div>
               <div class="media-right">
                 <center>
                   <span class="subs-loader"></span>
                 </center>
               </div>
             </div>


            </div>
          <div class="space-large"></div>
          <div class="space-large"></div>
          <div class="space-large"></div>
          <div class="space-large"></div>
          </form>

          <div class="app-toast">
            <samp class="toast-text">
              
            </samp>
          </div>
    </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript">
      
      (function(http, $){

        let show = true

        let toggler = function(){

          if(show){

            $.get('.show-subjects').style.display = 'block'
            $.get('.block-intro').style.display = 'none'

            show = false

          }else{

            $.get('.show-subjects').style.display = 'none'
            $.get('.block-intro').style.display = 'block'

            show = true

          }

        }

        $.get('.choose-subs').onclick = function(){

          toggler()

        }

        $.get('.show-search').style.display = 'none'

        $.get('.input-search').onkeyup = function(){

          if(this.value === ''){

            $.get('.show-subjects').style.display = 'none'
            $.get('.show-search').style.display = 'none'
            $.get('.block-intro').style.display = 'block'
            show = false

          }else{

            $.get('.show-subjects').style.display = 'none'
            $.get('.block-intro').style.display = 'none'
            $.get('.show-search').style.display = 'block'

            $.get('.show-loader').append($.loader())

            http.request({
              method : 'POST',
              url    : 'api/courses/',
              form   : new FormData($.get('.search-form'))
            }, data => {

              $.html('.show-loader', '')

              let table = $.get('.table')
              let rows = $.gets('.table-tr')
              if(rows.length > 0){

                rows.forEach(row => {

                  table.removeChild(row)

                })

              }

              if(data.error){

                let tr = $.create('tr', 'table-tr')
                let ErrorRow = $.create('td', 'table-td')

                table.append(tr)
                tr.append(ErrorRow)
                ErrorRow.setAttribute('colspan', 4)
                ErrorRow.innerHTML = `<center><h3><samp>${data.message}</samp></h3></center>`

              }else{

                /*if($.isMobile()){
                  $.get('.apply-tr').style.display = 'block'
                }*/

                data.courses.forEach(course => {

                  let tr = $.create('tr', 'table-tr')
                  let Faculty = $.create('td', 'table-td')
                  let Course = $.create('td', 'table-td')
                  let CourseAPS = $.create('td', 'table-td')
                  let Campus = $.create('td', 'table-td')


                  table.append(tr)
                  tr.append(Faculty, Course, CourseAPS, Campus)
                  /*if(!$.isMobile()){*/
                    $.get('.apply-lg-tr').style.display = 'block'
                    let Apply = $.create('td', 'table-td')
                    let URL = $.create('a', 'link')
                    Apply.append(URL)
                    URL.href = 'https://tut.ac.za'/*"https://ienabler.tut.ac.za/pls/prodi41/gen.gw1pkg.gw1view"*/
                    URL.innerHTML = 'Apply@TUT'
                    tr.append(Apply)
                 /* }*/

                  Faculty.innerHTML = course.faculty
                  Course.innerHTML = course.course
                  CourseAPS.innerHTML = course.course_aps
                  Campus.innerHTML = course.campus

                })

              }

            })

          }

        }

        let subjects = []
        let marks = []
        let aps = 0

        function getDetailsEntered(){

          subjects = []
          marks = []
          aps = 0

          for(let i = 1; i <= 7; i++){

            let subject = $.get(`.subject${i}`).value
            let mark = $.get(`.marks${i}`).value

            if(subject == '--Select a Subject--' || mark == '') continue // Skip If select field is empty

            subjects.push(subject)
            marks.push(mark)

          }

          if(subjects.length == 0 || marks.length == 0){
            let message = 'Choose atleast one Subject And Its Corresponding Marks'
            $.html('.btn-error', message)
            $.toast(message)

            return false

          }

          marks.forEach(mark => {

            aps += parseInt(mark, 10)

          })

          return true

        }

        let findRepeatingSubjects = function(){

          for(let i = 0; i < subjects.length; i++){

            for(let j = 0; j < subjects.length; j++){

              if(subjects[i] === subjects[j] && (i != j)){

                console.log(subjects[i])
                console.log(subjects[j])

                $.html('.btn-error', 'You Cannot Have Repeating Subjects')
                $.toast('You Cannot Have Repeating Subjects')

                return true
              }
              
            }

          }

          return false

        }

        $.get('.calculate-btn').onclick = (e) => {

           e.preventDefault()

           if(!getDetailsEntered()) return

            if(findRepeatingSubjects()) return


            $.get('.subs-loader').append($.loader())

           let form = new FormData()

           form.append('context', 2)
           form.append('subjects', subjects.toString())
           form.append('aps', marks.toString())

           http.request({
            method : 'POST',
            url : 'api/user/',
            form : form
           }, data => {

              $.html('.subs-loader', '')

             if(data.error){

                $.html('.btn-error', data.message)
                $.toast(data.message)

             }else{

                $.html('.btn-error', data.message)
                $.toast(data.message)
                window.location = 'results'

             }

           })

        }

      })(http, el)

    </script>
</body>
</html>
