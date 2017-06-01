<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-1'>
      <div class='box bit-1'>
        <div class='box-title'>Ajuda</div>
        <div class='box-content'>
          <p>
            Toda segunda-feira é realizada a atualização da economia onde valores como a cota de televisionamento são atualizadas. Tenha cuidado ao manter suas despesas maiores que suas receitas e boa sorte!
          </p>
        </div>
      </div>
      <div class='bit-2'>
        <div class='box'>
          <div class='box-title'>Receitas e Despesas na Semana <img width='20px' src='<?=$this->tree?>assets/img/icons/coin.png'> <small class='pro'>PRO</small></div>
          <div class='box-content'>
            <div id="week" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
          </div>
        </div>
      </div>
      <div class='bit-2'>
        <div class='box'>
          <div class='box-title'>Saldo ao longo da temporada <img width='20px' src='<?=$this->tree?>assets/img/icons/coin.png'> <small class='pro'>PRO</small></div>
          <div class='box-content'>
            <div id="season" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
          </div>
        </div>
      </div>
    </div>
    <div class='bit-1'>
      <div class='bit-2'>
        <div class='box'>
          <div class='box-title'>Semana Atual</div>
          <div class='box-content'>
            <table class='table is-bordered'>
              <tr><td>Cota de TV</td><td>$ <?=$this->finance['week']['tv']?></td></tr>
              <tr><td>Ingressos</td><td>$ <?=$this->finance['week']['tickets']?></td></tr>
              <tr><td>Mercadorias</td><td>$ <?=$this->finance['week']['merchandise']?></td></tr>
              <tr><td>Receitas de Alimentação</td><td>$ <?=$this->finance['week']['food']?></td></tr>
              <!-- <tr><td>Patrocinadores</td><td>$ <?=$this->finance['week']['sponsor']?></td></tr> -->
              <tr><td>Obras</td><td>$ <?=$this->finance['week']['constructions']?></td></tr>
              <tr><td><a href='<?=$this->tree?>finances/wages'>Salários</a></td><td>$ <?=$this->finance['week']['wage']?></td></tr>
              <tr><td><!--<a href='<?=$this->tree?>finances/maintenance'>Manutenções</a>-->Manutenções</td><td>$ <?=$this->finance['week']['maintenance']?></td></tr>
              <tr><td><strong>Transferências</strong></td><td>$ <?=$this->finance['week']['transfers']?></td></tr>
              <tr><td><strong>Juros</strong></td><td>$ <?=$this->finance['week']['interests']?></td></tr>
              <tr><td><strong>Total</strong></td><td>$ <?=$this->finance['week']['total']?></td></tr>
              <tr><td><strong>Saldo</strong></td><td>$ <?=$this->finance['week']['money']?></td></tr>
            </table>
          </div>
        </div>
      </div>
      <div class='bit-2'>
        <div class='box'>
          <div class='box-title'>Temporada</div>
          <div class='box-content'>
            <table class='table is-bordered'>
              <tr><td>Cota de TV</td><td>$ <?=$this->finance['season']['tv']?></td></tr>
              <tr><td>Ingressos</td><td>$ <?=$this->finance['season']['tickets']?></td></tr>
              <tr><td>Mercadorias</td><td>$ <?=$this->finance['season']['merchandise']?></td></tr>
              <tr><td>Receitas de Alimentação</td><td>$ <?=$this->finance['season']['food']?></td></tr>
              <!-- <tr><td>Patrocinadores</td><td>$ <?=$this->finance['season']['sponsor']?></td></tr> -->
              <tr><td>Obras</td><td>$ <?=$this->finance['season']['constructions']?></td></tr>
              <tr><td><a href='<?=$this->tree?>finances/wages'>Salários</a></td><td>$ <?=$this->finance['season']['wage']?></td></tr>
              <tr><td><!--<a href='<?=$this->tree?>finances/maintenance'>Manutenções</a>-->Manutenções</td><td>$ <?=$this->finance['season']['maintenance']?></td></tr>
              <tr><td><strong>Transferências</strong></td><td>$ <?=$this->finance['season']['transfers']?></td></tr>
              <tr><td><strong>Juros</strong></td><td>$ <?=$this->finance['season']['interests']?></td></tr>
              <tr><td><strong>Total</strong></td><td>$ <?=$this->finance['season']['total']?></td></tr>
              <tr><td><strong>Saldo</strong></td><td>$ <?=$this->finance['season']['money']?></td></tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  income = <?=$this->finance['week']['income'];?>;
  outcome = <?=$this->finance['week']['outcome'];?>;
</script>
