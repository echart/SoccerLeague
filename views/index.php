<!DOCTYPE html>
<html>
<head>
	<!-- Title, tags and meta-->
	<title>Soccer League - The Soccer Management Game</title>
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/icon.png">

	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />
 	<meta name="theme-color" content="‪#‎393E41">
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="<?=$this->path?>/assets/semantic/dist/semantic.min.css">
<link rel="stylesheet" type="text/css" href="<?=$this->path?>/assets/semantic/dist/semantic.min.css">
  <link rel="stylesheet" href="<?=$this->path?>/assets/css/grid.css">
  <link rel="stylesheet" href="<?=$this->path?>/assets/css/fonts.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
  <style media="screen">
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Open Sans', sans-serif !important;
    }
    .left{
      background-color: #393E41;
      color: #fff;
      height: 100vh;
    }
    .left .content{
      position: relative;
      top: 240px;
      left: 40px;
      width: 90%;
    }
    .left .logo{
      position: relative;
      top: 40px;
      left: 40px;
    }
    .right{
      background-color: #5FAD56;
      height: 100vh;
    }
    h1.title{
      font-size: 50px !important;
      font-weight: 300 !important;
      padding: 0px !important;
    }
    h5.subtitle{
      font-size: 28px !important;
      font-weight: 300 !important;
      margin-top: -15px !important;
      padding-bottom: 5px !important;
      color: #ccc !important;
    }
    p.description{
      font-size: 14px !important;
      font-weight: 400 !important;
      color: #ccc !important;
      padding-bottom: 5px !important;
    }
    button.join{
      font-family: 'Open Sans', sans-serif !important;
      background-color: #5FAD56 !important;
      padding: 20 50px !important;
      font-weight: 400 !important;
      color: #fff !important;
    }
    button.join:hover{
      background-color: #4A7856 !important;
    }
    .list{
      position: absolute;
      top: 700px;
      left: 40px;
    }
    .link{
      color: #ccc !important;
    }
  </style>
</head>
  <body>
    <main>
      <div class='grid-60 left'>
        <div class='logo'>SOCCERLEAGUE</div>
        <div class='content'>
          <h1 class='title'>Soccer League</h1>
          <h5 class='subtitle'>Um jogo de gerenciamento de futebol para Web</h5>
          <p class='description'>
            Soccer League é a ideia de um jogo de gerenciamento de um clube de futebol para web, com uma match engine baseada em estatísticas reais do futebol com o uso de técnicas de inteligência artificial, e um visualizador de partidas em 2D, como os antigos tempos de Football Manager 2008.
          </p>
          <button class="large ui button join">
            Crie seu time!
          </button>
        </div>
        <div class="ui horizontal bulleted link list">
          <a class="item">
            Terms and Conditions
          </a>
          <a class="item">
            Privacy Policy
          </a>
          <a class="item">
            Contact Us
          </a>
        </div>
      </div>
      <div class='grid-40 right'>
        b
      </div>
    </main>
  </body>
</html>
