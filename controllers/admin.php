<?
$this->tree=__rootpath($_SERVER['REDIRECT_URL']);
$this->menu='admin';

switch ($this->get['method']) {
  case 'money':
    if($this->admin->is_GT()){
      $id_club = $this->post['id_club'];
      $query = Connection::getInstance()->connect()->prepare("SELECT money FROM club_finances where id_club=:id_club");
      $query->bindParam(':id_club',$id_club);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      $money = $data['money'] - 10000000;
      $query = Connection::getInstance()->connect()->prepare("UPDATE club_finances SET money=:money where id_club=:id_club");
      $query->bindParam(':id_club',$id_club);
      $query->bindParam(':money',$money);
      $query->execute();
      if(isset($this->post['id_report'])){
        $query = Connection::getInstance()->connect()->prepare("UPDATE club_report SET status='C', id_responsable=:id where id_club_report=:id_club_report");
        $query->bindParam(':id_club_report',$this->post['id_report']);
        $query->bindParam(':id',$_SESSION['SL_club']);
        $query->execute();
      }
    }
    echo JsonOutput::success(array('data'=>'successs'));
    exit;
  break;
  case 'shield':
    if($this->admin->is_GT()){
      $id_club = $this->post['id_club'];
      $query = Connection::getInstance()->connect()->prepare("UPDATE club_info SET logo='default.png' where id_club=:id_club");
      $query->bindParam(':id_club',$id_club);
      $query->execute();
      if(isset($this->post['id_report'])){
        $query = Connection::getInstance()->connect()->prepare("UPDATE club_report SET status='C', id_responsable=:id where id_club_report=:id_club_report");
        $query->bindParam(':id_club_report',$this->post['id_report']);
        $query->bindParam(':id',$_SESSION['SL_club']);
        $query->execute();
      }
    }
    echo JsonOutput::success(array('data'=>'successs'));
    exit;
  break;
  case 'inactive':
    if($this->admin->is_GT()){
      $id_club = $this->post['id_club'];
      $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club where id_club=:id_club");
      $query->bindParam(':id_club',$id_club);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      if($data['status']=='I'){
        $query = Connection::getInstance()->connect()->prepare("UPDATE club SET status='A' where id_club=:id_club");
        $query->bindParam(':id_club',$id_club);
        $query->execute();
      }else{
        $query = Connection::getInstance()->connect()->prepare("UPDATE club SET status='I' where id_club=:id_club");
        $query->bindParam(':id_club',$id_club);
        $query->execute();
      }

      echo JsonOutput::success(array('data'=>'successs'));
    }
    exit;
  break;
  case 'ban':
    if($this->admin->is_GT()){
      $id_club = $this->post['id_club'];
      $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club where id_club=:id_club");
      $query->bindParam(':id_club',$id_club);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      if($data['status']=='B'){
        $query = Connection::getInstance()->connect()->prepare("UPDATE club SET status='A' where id_club=:id_club");
        $query->bindParam(':id_club',$id_club);
        $query->execute();
      }else{
        $query = Connection::getInstance()->connect()->prepare("UPDATE club SET status='B' where id_club=:id_club");
        $query->bindParam(':id_club',$id_club);
        $query->execute();
      }

      if(isset($this->post['id_report'])){
        $query = Connection::getInstance()->connect()->prepare("UPDATE club_report SET status='C', id_responsable=:id where id_club_report=:id_club_report");
        $query->bindParam(':id_club_report',$this->post['id_report']);
        $query->bindParam(':id',$_SESSION['SL_club']);
        $query->execute();
      }

      echo JsonOutput::success(array('data'=>'successs'));
    }
    exit;
  break;
  case 'deletePermission':
    if($this->admin->is_GT()){
      $id_account = $this->post['id_account'];
      $query = Connection::getInstance()->connect()->prepare("DELETE FROM account_permission where id_account=:id_account");
      $query->bindParam(':id_account',$id_account);
      $query->execute();
      echo JsonOutput::success(array('data'=>'successs'));
    }
    exit;
  break;
  case 'addPermission':
  if($this->admin->is_GT()){
    foreach ($this->post['permissions'] as $permissions) {

    }
    echo JsonOutput::success(array('data'=>'successs'));
  }
  exit;
  break;
  case 'statistics':
    if(!$this->admin->is_GT()){
      $this->requestURL='403';
    }else{
      $this->title='Estatisticas';
      $this->submenu='admin/statistics';
      $this->requestURL='admin_statistics';
      $this->addCSSFile('admin_stats.css');

      $query = Connection::getInstance()->connect()->prepare("SELECT * FROM countries");
      $query->execute();
      $this->country = $query->rowCount();

      $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club");
      $query->execute();
      $this->club = $query->rowCount();

      $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_account inner join club using(id_club) where status='A'");
      $query->execute();
      $this->account = $query->rowCount();

      $query = Connection::getInstance()->connect()->prepare("SELECT * FROM competition where season='1' AND id_competition_type='1'");
      $query->execute();
      $this->leagues = $query->rowCount();
    }
    break;
  case 'reports':
    if(!$this->admin->is_GT()){
      $this->requestURL='403';
    }else{
      $this->title='Denúncias';
      $this->submenu='admin/reports';
      $this->requestURL='admin_reports';

      $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_report where status = 'P'");
      $query->execute();
      while($data=$query->fetch(PDO::FETCH_ASSOC)){
        $this->data['reports'][] = $data;
      }
    }
    $this->addCSSFile('modal.css');
    $this->addJSFile('admin.reports.js');
  break;
  case 'users':

  break;
  case 'permissions':
    if(!$this->admin->is_GT()){
      $this->requestURL='403';
    }else{
      $this->title='Permissões de Usuário';
      $this->submenu='admin/permissions';
      $this->requestURL='admin_permissions';
      $this->addCSSFile('admin_permissions.css');
      $this->addJSFile('admin.js');

      $query = Connection::getInstance()->connect()->prepare("SELECT id_account FROM account_permission group by id_account");
      $query->execute();
      $this->data['n'] = $query->rowCount();
      $i = 0 ;
      while($data=$query->fetch(PDO::FETCH_ASSOC)){
        $this->data['club'][$i]['id_account'] = $data['id_account'];
        $this->data['club'][$i]['id_club'] = Club::getClubByAccountId($data['id_account']);
        $this->data['club'][$i]['clubname'] = Club::getClubNameById($this->data['club'][$i]['id_club']);
        $i++;
      }
    }
  break;
  default:
    header('Location: statistics/');
    break;
}
