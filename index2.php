<!DOCTYPE html>
<html>
<head>
	<!-- Title, tags and meta-->
	<title>Soccer League - The Soccer Management Game</title>
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/icon2.png">

	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />
 	<meta name="theme-color" content="‪#‎393E41">
  <style>
  body{
    padding: 0;
    margin: 0;
    background: #f4f4f4;
    font-family: 'Exo 2';
  }
  header{
    z-index: 999;
    width: 100vw;
    height: 75px;
    background-color: #5FAD56;
  }
  header div.logo{
    position: relative;
    top: 15px;
    left: 25px;
  }
  main{
    width: 100vw;
  }
  .form-field{
    padding: 0px;
  }
  .form-login{
    max-width: 600px;
    position: absolute;
    top:15px;
    right:50px;
  }
  .form-login div.label{
    float: left;
    margin: 0 10px;
  }
  .label input{
    padding: 11.2px 15px !important;
  }
  p{
    font-family: 'Open Sans';
    font-size: 14px;
    padding: 20px;
  }
  .first{
    height: 100vh;
    width: 100vw;
    background: url(assets/img/backgrounds/bg4.jpg) center center/cover no-repeat;
    text-align: center;
    z-index: 4;
  }
  .first h1{
    position: relative;
    top:170px;
    font-size: 48px;
    z-index: 3;
  }
  .first h4{
    position: relative;
    top: 170px;
    font-size: 16px;
    z-index: 3;
  }
  .pattern{
    opacity: .75;
    filter: "alpha(opacity=40)";
    background: url(assets/img/login/subtle_carbon.png);
    position: absolute;
    z-index: 0;
    right: 0;
    top: 75px;
    min-width: 100%;
    min-height: 100%;
  }
  </style>
</head>
<body>
	<header>
		<div class='logo'><img src='assets/img/sl_logos/logo.branco.png' width='200px'></div>
    <div class='form-login'>
      <form>
        <div class='label clubname'>
          <input type='text' name='clubname' placeholder='Email'>
        </div>
        <div class='label password'>
          <input type='password' name='password' placeholder='password'>
        </div>
        <div class='label login'>
          <button type='submit' class='btn bg-alert'>Login</button>
        </div>
      </form>
    </div>
	</header>
	<main>
    <div class='grid-100 first'>
      <h1 class='white-text'>Nós amamos futebol! </h1>
      <h4 class='white-text'>Soccer League é a ideia de um jogo de gerenciamento de um clube de futebol para web.</h4>
      <h4 class='white-text'>Crie um clube e ajude no desenvolvimento!</h4>
      <!-- <div class='pattern'></div> -->
    </div>
    <div class='grid-100'>
      <p>Soccer League é a ideia de um jogo de gerenciamento de um clube de futebol para web, com uma match engine baseada em estatísticas reais do futebol com o uso de técnicas de inteligência artificial, e um visualizador de partidas em 2D, como os antigos tempos de Football Manager 2008.
        E este projeto é utilizado como trabalho de conclusão do Curso de Tecnologia em Sistemas para Internet do Instituto Federal de Educação, Ciência e Tecnologia Sul-Riograndense.
      </p>
    </div>
	</main>
  <link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
  <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="assets/css/grid.css">

	<!-- JS -->
	<script type="text/javascript">
		var countriesData = [
	    {
	        text: "Brasil",
	        value: 1,
	        selected: false,
	        description: "0 usuários ativos",
	        imageSrc: "assets/img/icons/flags/shiny/48/Brazil.png"
	    }
	];
	</script>
	<!--<script>document.write('<script src=assets/js/' +('__proto__' in {} ? 'zepto' : 'jquery') +'.js><\/script>')</script-->
	<script type="text/javascript" src='assets/js/jquery.js'></script>
	<!-- <script type="text/javascript" src='assets/js/translate.js'></script> -->
	<script type="text/javascript" src='assets/js/select.js'></script>
	<script type="text/javascript" src='assets/js/home.js'></script>
</body>
</html>
