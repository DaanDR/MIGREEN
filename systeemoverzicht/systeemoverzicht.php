<?php
  ob_start();
  if (!isset($_SESSION)) session_start();

  // include('../header/headeruser.php');
  // include('../header/headeruser.php');

  // include('../omgevingbeheer/EnvironmentDaoMysql.php');

  // Check of user is ingelogged en anders terug naar de login pagina
  include_once ("../autorisatie/UserIsLoggedin.php");
  $userLoggedin = new UserIsLoggedin();
  $userLoggedin->backToLoging();

  if($userLoggedin->isAdmin()) {
    include('../header/header.php');
  } else {
    include('../header/headeruser.php');
  }

  // //Check of de admin is ingelogged....
  // $adminLoggedin = "";
  // if( ! $userLoggedin->isAdmin() )
  // {
  //     $adminLoggedin = "style='display: none;'";
  //     echo "<br><br><br><br><h1>Geen gerbuikersrecht als admin.....</h1>";
  // }
?>

<html>

<head>
	<title>Systeemoverzicht</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
				integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="../css/form.css"> -->
	<!-- <link rel="stylesheet" href="../css/content.css"> -->

	<style media="screen">

		.container {
			/* width: 75%; */
			width: 75%;
			margin-left: 12.5%;
      background-color: white;
      font-family: ubuntu-regular;
      margin-top: 30px;
		}


		.systeemoverzicht-wrapper {
      margin-top: 20px;
			display: grid;
			grid-template-columns: repeat(4, 1fr);
      grid-auto-rows: minmax(0px, auto);
		}

		.header-left {
			grid-row: 1;
		}

		.systeem-overzicht-content {
      grid-column: 1/5;
			grid-row: 2;
      background-image: url("background.png");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
      width: 100%;
      height: 759px;
		}

    .systeem-overzicht-content-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: minmax(150px, auto);
    border: 2px, solid, black;
    /* background-image: url("background.png");
    background-size: contain;
    width: 100%;
    height: 759px; */
  }
  .systeem-overzicht-content-grid > div {
    /* border-style: solid;
    border-width: 2px; */
  }

  .one {
    grid-column: 2;
    grid-row: 1;
  }

  .two {
    grid-column: 1;
    grid-row: 2;
  }

  .three {
    grid-column: 2;
    grid-row: 2;
  }

  .four {
    grid-column: 3;
    grid-row: 2;
  }

  .five {
    grid-column: 1;
    grid-row: 3;
  }

  .six {
    grid-column: 3;
    grid-row: 3;
  }

  .seven {
    grid-column: 1;
    grid-row: 4;
  }

  .eight {
    grid-column: 2;
    grid-row: 4;
  }

  .nine {
    grid-column: 1;
    grid-row: 5;
  }

  .ten {
    grid-column: 3;
    grid-row: 5;
  }

  .activePOP {
    visibility: visible;
    color: red;
  }

  .hidden {
    visibility: hidden;
  }

  .show {
    visibility: visible;
  }

.info-container {
  position: absolute;
  width: 100%;
  top: -20px;
  padding-top: 15%;
  z-index: 5;
}

.info-background {
  background: #000;
  opacity: 0.5;
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0px;
  z-index: 3;
}

.info-message
{
    margin: auto;
    width: 25%;
    top: 0px;
    background: #fff;
    /* position: absolute; */
    z-index: 5;
    padding: 10px;
    padding-bottom: 30px;
    border-radius: 5px;
    opacity: 1;
}

.fa-server {
  font-size: 300%;
}

.system-image {
  width: 25%;
  margin-left: 38%;
  top: 0px;
  z-index: 6;
  border-radius: 5px;
}

.systeem-hidden {
  visibility: hidden;
}

.green {
  border-color: #81d134;
}

.orange {
  border-color: #ff7500;
  border-style: solid;
  border-width: 1px;
  box-shadow: 0px 0px 31px -24px rgba(235,19,19,1);
}
.red {
  border-color: #eb1313;
  border-style: solid;
  border-width: 1px;
}

	</style>


</head>

<body bgcolor="#F2F6FA" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<!-- Save for Web Slices (Untitled-1) -->
  <div class="hidden" onclick="showPopup()">
    <div class="info-container">
      <!-- <div class="system-image-div">

      </div> -->
      <!-- <div class="info-message"> -->
        <!-- <p>Test</p> -->
        <!-- <img class="system-image system-green systeem-hidden" src="../res/systeem2.jpg" alt="">
        <img class="system-image system-red systeem-hidden" src="../res/systeem1.jpg" alt="">
        <img class="system-image system-orange" src="../res/systeem3.jpg" alt=""> -->

      <!-- </div> -->

      </div>
<div class="info-background">
</div>
    </div>

	<div class="container">
		<div class="systeemoverzicht-wrapper">
			<div class="header-left">

				<p class="breadcrumb">Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Systeemoverzicht</p>
				<h2>Systeemoverzicht</h2>
			</div>

		<div class="systeem-overzicht-content">
      <div class="systeem-overzicht-content-grid">
        <div id="one" class="one " onclick="showPopup(2)"></div>
        <div class="two" onclick="showPopup(2)"></div>
        <div class="three" onclick="showPopup(1)"></div>
        <div class="four" onclick="showPopup(2)"></div>
        <div class="five" onclick="showPopup(2)"></div>
        <div class="six" onclick="showPopup(3)"></div>
        <div class="seven" onclick="showPopup(3)"></div>
        <div class="eight" onclick="showPopup(1)"></div>
        <div class="nine" onclick="showPopup(3)"></div>
        <div class="ten" onclick="showPopup(1)"></div>
      </div>
	</div>
</div>
	<!-- End Save for Web Slices -->
<script type="text/javascript" src="script.js"></script>
</body>

</html>
