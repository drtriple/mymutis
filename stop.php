<?php 

date_default_timezone_set('America/Bogota');
$hoy = date("d-m-Y");
$hora = date("h:i:s",time());

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación | My mutis</title>

    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
 
 <style>
* {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

body {
  padding: 0;
  margin: 0;
}

#notfound {
  position: relative;
  height: 100vh;
}

#notfound .notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.notfound {
  max-width: 920px;
  width: 100%;
  line-height: 1.4;
  text-align: center;
  padding-left: 15px;
  padding-right: 15px;
}

.notfound .notfound-404 {
  position: absolute;
  height: 100px;
  top: 0;
  left: 50%;
  -webkit-transform: translateX(-50%);
      -ms-transform: translateX(-50%);
          transform: translateX(-50%);
  z-index: -1;
}

.notfound .notfound-404 h1 {
  font-family: 'Maven Pro', sans-serif;
  color: #ececec;
  font-weight: 900;
  font-size: 276px;
  margin: 0px;
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.notfound h2 {
  font-family: 'Maven Pro', sans-serif;
  font-size: 46px;
  color: #000;
  font-weight: 900;
  text-transform: uppercase;
  margin: 0px;
}

.notfound p {
  font-family: 'Maven Pro', sans-serif;
  font-size: 16px;
  color: #000;
  font-weight: 400;
  text-transform: uppercase;
  margin-top: 15px;
}

.notfound a {
  font-family: 'Maven Pro', sans-serif;
  font-size: 14px;
  text-decoration: none;
  text-transform: uppercase;
  background: #4c6372;
  display: inline-block;
  padding: 16px 38px;
  border: 2px solid transparent;
  border-radius: 40px;
  color: #fff;
  font-weight: 400;
  -webkit-transition: 0.2s all;
  transition: 0.2s all;
}

.notfound a:hover {
  background-color: #fff;
  border-color: #FF3333;
  color: #FF3333;
}

@media only screen and (max-width: 480px) {
  .notfound .notfound-404 h1 {
    font-size: 162px;
  }
  .notfound h2 {
    font-size: 26px;
  }
}

 </style>
</head>
<body>
    
<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>VERIFICAR</h1>
			</div>
			<h2>Tu usuario esta desactivado!</h2>
			<p>Debes esperar un plazo de máximo de 24 horas para acceder tu cuenta, en el caso que haya pasado el plazo y este siga apareciendo este mensaje comunicarse con los administrativos.</p>
			<a href="index.php">Regresar al Inicio</a>
		</div>
	</div>
</body>
</html>