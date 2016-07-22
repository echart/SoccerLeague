<main>
  <div class='content'>
    <? if(isset($this->request['id'])){ ?>
      <!-- view that will show player attr -->
        <h1>
          <?
          print_r($this->data['player']);
        ?></h1>
    <?}else{?>
      <!-- view that will show all players join at this club -->
    <? } ?>
  </div>
</main>
