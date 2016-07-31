    <!--JS-->
    <script src="<?=$this->data['tree']?>assets/js/jquery.js"></script>
    <script src="<?=$this->data['tree']?>assets/js/clock.js"></script>
    <? $this->loadJSFiles(); ?>
    <script>window.onload = clock;</script>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
