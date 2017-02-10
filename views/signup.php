<!DOCTYPE html>
<html>
  <head>
  	<!-- Title, tags and meta-->
  	<title><?=$this->title?></title>
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
      body{
        background-color: #333;
        padding: 20px;
      }
    </style>
  </head>
  <body>
    <main>
      <form action="/account/create" method="post">
        <div class="ui input">
          <input type="text" placeholder="Email">
        </div>
        <div class="ui input">
          <input type="password" placeholder="Passoword">
        </div>
        <div class="ui input">
          <input type="text" placeholder="Clubname">
        </div>
        <div class="ui input">
          <input type="text" placeholder="lat">
          <input type="text" placeholder="lng">
          <input type="text" placeholder="country">
        </div>
        <div id='map'>loading map....</div>
        <button type='submit' class="ui button join">
          Crie seu time!
        </button>
      </form>
    </main>
  </body>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4"></script>
	<script type="text/javascript" src="//rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox.js"></script>
</html>
