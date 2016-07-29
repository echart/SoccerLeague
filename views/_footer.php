    <!--JS-->
    <script src="<?=$this->data['tree']?>assets/js/jquery.js"></script>
    <script type="text/javascript" src='<?=$this->data['tree']?>assets/js/login/menu.js'></script>
    <? $this->loadJSFiles(); ?>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
