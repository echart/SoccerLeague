<!DOCTYPE html>
<html>
<head>

	<!-- Title and Tags-->
	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width"/>

	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />

	<title>Soccer League - Soccer Management Game</title>
	<link rel="icon" type="image/png" sizes="96x96" href="<?=$this->tree?>assets/img/icon.png">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/grid.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/sidebar.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/semantic/dist/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/styles.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/header.css">-->
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/fonts.css">
	<? /*load css files*/ $this->loadCSSFiles(); ?>
</head>
<body>
	<main>
    <!-- topbar -->
    <div class='nav grid-1'>
      <div class='logo'></div>
      <ul>
        <li><a href='#login'>Login</a></li>
        <li><a href="#signup">Cadastrar</a></li>
      </ul>
    </div>
    <!-- slider -->
    <div class='itens'>
      <div class='item'>
        <?=$this->data['log']?>
      </div>
    </div>
    <!-- slider controll -->
    <div class='slider'></div>
    <!-- modals -->
    <div class="ui modal login-modal">
      <i class="close icon"></i>
      <div class="header">
        Entrar
      </div>
    </div>
    <div class="ui modal signup-modal">
      <i class="close icon"></i>
      <div class="header">
        Cadastrar
      </div>
    </div>
</main>
<!--JS-->
<script src="<?=$this->tree?>assets/js/jquery.js"></script>
<script src="<?=$this->tree?>assets/semantic/dist/semantic.min.js"></script>
<script src="<?=$this->tree?>assets/js/sidebar.js"></script>
<? $this->loadJSFiles(); ?>
<script type="text/javascript">
  $('a[href="#login"]').on('click',function(){
    $('.ui.modal.login-modal').modal('show');
  });
  $('a[href="#signup"]').on('click',function(){
    $('.ui.modal.signup-modal').modal('show');
  })
</script>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
