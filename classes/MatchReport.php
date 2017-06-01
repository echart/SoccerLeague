<?

class MatchReport{
  public $match;
  public $report = array();

  public $words = array(
    'start'=> array('Apita o arbitro bola rolando','COMEÇA O JOGO!','ROLA A BOLA! A PARTIDA COMEÇA', 'BEM VINDOS AMIGOS DO SOCCER LEAGUE, COMEÇA O JOGO!', 'E agora vamos acompanhar esse jogão de bola! Começa o jogo.'),
    'end'=>array('Apita o árbitro, encerrada a partida.'),
    'startPenalty'=> array('O jogador comete penalty! A torcida se desespera...','ÉÉÉÉÉ PENALTYYY!', 'O ÁRBITRO APITA PENALTY! TA MARCADO'),
    'midPenalty' => array("Ele está preparado para a cobrança...", 'O jogador se concentra para bater o penalty!',"CORRE PRA BOLA"),
    'penaltySuccess' => array('ELE CONVERTEU!','TÁ LÁ!','CAIXAAAAAA'),
    'penaltyError' => array('ERRRRROUUUUU!', 'PEEERDEUUUUUUU!','PRAA FORAAAAAAAAAAA!'),
    'goal'=> array("FEEEEEEEEEEITOOOOOOOOOO! CONTABILIZA AI NO MARCADOR!", 'GOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOL!!!!!','BUSCAAAAAAA GOLEIRÃOOOOOOOOO! TA NA REDE', "É GOOOOOOL"),
    'startPlay'=>array('A jogada começa, o time vai avançando!', 'Tentando criar uma jogada o time vai pro ataque...', 'BOLA PRO ATAQUE!'),
    'tackling'=>array('DESARMAAA O MARCADOR', 'ELE NEM VIU O MARCADOR, PERDEU A BOLA DAQUELE JEITOOOOO', 'ERRRRRROOOOOO PERDEU A BOLA....', 'Ele nao conseguiu terminar a jogada'),
    'dribbleSuccess'=>array('NEM ME VIU! ELE PASSOU PELO MARCADOR DE VIAGEM!', 'O marcador tá até agora procurando ele....','Driblou o marcador e avança com a bola'),
    'error'=>array('Cara a cara com goleiro! PERDEUUUUU','Só chutar pra fazerrrr e errooooou.', 'Eu nao tenho palavras pra descrever esse lance perdido','Ele tinha tudo para se consagrar')
  );

  public function __construct(Match $match){
    $this->match=$match;
  }
  public function __save(){
    $query = Connection::getInstance()->connect()->prepare("INSERT INTO matches_report (id_match, report) values (:id_match, :report)");
    $query->bindValue(':id_match',$this->match->id_match);
    $query->bindValue(':report',json_encode($this->report));
    $query->execute();
  }
  public function __load(){
    $query = Connection::getInstance()->connect()->prepare("SELECT report FROM matches_report where id_match=:id_match");
    $query->bindValue(':id_match',$this->match->id_match);
    $query->execute();
    $data = $query->fetch();
    $this->report=$data['report'];
  }
  public function addReport($minute,$type,$playername){
    $this->report[$minute][] = $this->words[$type][rand(0,count($this->words[$type])-1)];
  }
  public function jsonReport(){
    # TODO: return match report as JSON
  }
}
