    <!--JS-->
    <script src="<?=$this->data['tree']?>assets/js/jquery.js"></script>
    <script type="text/javascript" src='<?=$this->data['tree']?>assets/js/login/menu.js'></script>
    <?
    if(isset($this->data['script'])){
      foreach ($this->data['script'] as $key => $script) {
        echo "<script type='text/javascript' src='".$this->data['tree']."assets/js/".$script"'></script>";
      }
    }
    ?>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
