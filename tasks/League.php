<?
error_reporting(E_ALL);
ini_set('display_errors',1);
include('../classes/Connection.php');
include('../classes/Club.php');

$day = date('Y-m-d');
$day = '2017-05-31';

$query = Connection::getInstance()->connect()->prepare("SELECT id_match,home, away,homegoals, awaygoals FROM matches inner join matches_stats using(id_match) where day=:day and type='L'");
$query->bindParam(':day',$day);
$query->execute();
while($data=$query->fetch()){
  var_dump($data);
  echo '<br>';
  $id_league = Club::getClubIDLeague($data['home']);
  $query2 = Connection::getInstance()->connect()->prepare("SELECT pts, win, loss, draw, goalsp,goalsc from league_table where id_league=:id_league and id_club=:id_club");
  $query2->bindParam(':id_league',$id_league);
  $query2->bindParam(':id_club',$data['home']);
  $query2->execute();
  $dados = $query2->fetch(PDO::FETCH_ASSOC);
  if($data['homegoals']>$data['awaygoals']){
    $dados['pts']=$dados['pts']+3;
    $dados['win']++;
    $dados['goalsp'] = $dados['goalsp']+$data['homegoals'];
    $dados['goalsc'] = $dados['goalsc']+$data['awaygoals'];
  }else if($data['homegoals']==$data['awaygoals']){
    $dados['pts']++;
    $dados['draw']++;
    $dados['goalsp'] = $dados['goalsp']+$data['homegoals'];
    $dados['goalsc'] = $dados['goalsc']+$data['awaygoals'];
  }else{
    $dados['loss']++;
    $dados['goalsp'] = $dados['goalsp']+$data['homegoals'];
    $dados['goalsc'] = $dados['goalsc']+$data['awaygoals'];
  }
  $query2 = Connection::getInstance()->connect()->prepare("UPDATE league_table set pts=:pts, win=:win, loss=:loss, draw=:draw, goalsp=:goalsp,goalsc=:goalsc where id_league=:id_league and id_club=:id_club");
  $query2->bindParam(':id_league',$id_league);
  $query2->bindParam(':id_club',$data['home']);
  $query2->bindParam(':win',$dados['win']);
  $query2->bindParam(':pts',$dados['pts']);
  $query2->bindParam(':draw',$dados['draw']);
  $query2->bindParam(':loss',$dados['loss']);
  $query2->bindParam(':goalsp',$dados['goalsp']);
  $query2->bindParam(':goalsc',$dados['goalsc']);
  $query2->execute();

  $query2 = Connection::getInstance()->connect()->prepare("SELECT pts, win, loss, draw, goalsp,goalsc from league_table where id_league=:id_league and id_club=:id_club");
  $query2->bindParam(':id_league',$id_league);
  $query2->bindParam(':id_club',$data['away']);
  $query2->execute();
  $dados = $query2->fetch();
  if($data['awaygoals']>$data['homegoals']){
    $dados['pts']=$dados['pts']+3;
    $dados['win']++;
    $dados['goalsp'] = $dados['goalsp']+$data['homegoals'];
    $dados['goalsc'] = $dados['goalsc']+$data['awaygoals'];
  }else if($data['homegoals']==$data['awaygoals']){
    $dados['pts']++;
    $dados['draw']++;
    $dados['goalsp'] = $dados['goalsp']+$data['homegoals'];
    $dados['goalsc'] = $dados['goalsc']+$data['awaygoals'];
  }else{
    $dados['loss']++;
    $dados['goalsp'] = $dados['goalsp']+$data['homegoals'];
    $dados['goalsc'] = $dados['goalsc']+$data['awaygoals'];
  }
  $query2 = Connection::getInstance()->connect()->prepare("UPDATE league_table set pts=:pts, win=:win, loss=:loss, draw=:draw, goalsp=:goalsp,goalsc=:goalsc where id_league=:id_league and id_club=:id_club");
  $query2->bindParam(':id_league',$id_league);
  $query2->bindParam(':id_club',$data['away']);
  $query2->bindParam(':win',$dados['win']);
  $query2->bindParam(':pts',$dados['pts']);
  $query2->bindParam(':draw',$dados['draw']);
  $query2->bindParam(':loss',$dados['loss']);
  $query2->bindParam(':goalsp',$dados['goalsp']);
  $query2->bindParam(':goalsc',$dados['goalsc']);
  $query2->execute();

}
echo 'done';
