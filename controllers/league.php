<?
$division = $this->request['div'] ?? $_SESSION['SL_div'];
$group = $this->request['group'] ?? $_SESSION['SL_group'];
$country = strtoupper($this->request['country']) ?? strtoupper($_SESSION['SL_country']);


if(!isset($this->request['country'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: http://'.$_SERVER['SERVER_NAME'].'/league/'.strtolower($_SESSION['SL_country']).'/'.$division.'/'.$group);
?>
<div class='content'>
  <?
  $query=Connection::getInstance()->connect()->prepare("SELECT cc.clubname,lt.pts FROM competition c inner join league l using(id_competition) inner join league_table lt using(id_league) inner join club cc using(id_club) inner join country ccc on ccc.id_country= c.id_country where c.id_competition_type=1 and ccc.abbreviation=:country and l.division=:division and l.divgroup=:group and c.season=1");
  $query->bindParam(':country',$country);
  $query->bindParam(':division',$division);
  $query->bindParam(':group',$group);
  $query->execute();
  $query->setFetchMode(PDO::FETCH_OBJ);
  ?>
  <table>
    <tr>
      <td>
        Posição
      </td>
      <td>
        time
      </td>
      <td>
        pontos
      </td>
    </tr>
    <?
    $i=1;
  while($data = $query->fetch(PDO::FETCH_OBJ)){ ?>
      <tr>
        <td>
          <?=$i?>
        </td>
        <td>
          <?=$data->clubname;?>
        </td>
        <td>
          <?=$data->pts;?>
        </td>
      </tr>
<?
$i++;
  }
  ?>
</table>

</div>
