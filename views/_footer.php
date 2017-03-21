      </div>
    </main>
    <!--JS-->
    <script src="<?=$this->tree?>assets/js/jquery.js"></script>
    <script src="<?=$this->tree?>assets/js/responsive.js"></script>
    <script src="<?=$this->tree?>assets/js/menu.js"></script>
    <script src="<?=$this->tree?>assets/js/table.sort.js"></script>
    <script src="<?=$this->tree?>assets/js/tooltips.js"></script>
    <? $this->loadJSFiles(); ?>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
