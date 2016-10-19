      </div>
    </main>
    <!--JS-->
    <script src="<?=$this->tree?>assets/js/jquery.js"></script>
    <script src="<?=$this->tree?>assets/semantic/dist/semantic.min.js"></script>
    <script src="<?=$this->tree?>assets/js/sidebar.js"></script>
    <? $this->loadJSFiles(); ?>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
