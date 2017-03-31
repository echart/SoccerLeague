      </div>
    </main>
    <!--JS-->
    <script src="<?=$this->tree?>assets/js/jquery.js"></script>
    <script src="<?=$this->tree?>assets/js/responsive.js"></script>
    <script src="<?=$this->tree?>assets/js/menu.js"></script>
    <script src="<?=$this->tree?>assets/js/table.sort.js"></script>
    <script src="<?=$this->tree?>assets/js/tooltips.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <? $this->loadJSFiles(); ?>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
