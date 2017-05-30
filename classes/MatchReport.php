<?

class MatchReport{
  public $match;

  public function __construct(Match $match){
    $this->match=$match;
  }

  public function jsonReport(){
    # TODO: return match report as JSON
  }
}
