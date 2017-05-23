      </div>
    </main>
    <!--JS-->
    <script src="<?=$this->tree?>assets/js/jquery.js"></script>
    <script src="<?=$this->tree?>assets/js/modernizr.custom.js"></script>
    <script src="<?=$this->tree?>assets/js/classie.js"></script>
    <script src="<?=$this->tree?>assets/js/notificationFx.js"></script>
    <script src="<?=$this->tree?>assets/js/notification.js"></script>
    <script src="<?=$this->tree?>assets/js/responsive.js"></script>
    <script src="<?=$this->tree?>assets/js/menu.js"></script>
    <script src="<?=$this->tree?>assets/js/table.sort.js"></script>
    <script src="<?=$this->tree?>assets/js/tooltips.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <? $this->loadJSFiles(); ?>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-99739415-1', 'auto');
      ga('send', 'pageview');

    </script>
</body>
</html>
<? Connection::getInstance()->disconnect();?>
