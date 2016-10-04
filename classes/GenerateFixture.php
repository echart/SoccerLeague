<?
class GenerateFixture{

  public function nums($n) {
      $ns = array();
      for ($i = 1; $i <= $n; $i++) {
          $ns[] = $i;
      }
      return $ns;
  }

  public function firsthalf($names) {
    // Find out how many teams we want fixtures for.
      $teams = sizeof($names);
      // If odd number of teams add a "ghost".
      // $ghost = false;
      // if ($teams % 2 == 1) {
      //     $teams++;
      //     $ghost = true;
      // }

      // Generate the fixtures using the cyclic algorithm.
      $totalRounds = $teams - 1;
      $matchesPerRound = $teams / 2;
      $rounds = array();
      for ($i = 0; $i < $totalRounds; $i++) {
          $rounds[$i] = array();
      }

      for ($round = 0; $round < $totalRounds; $round++) {
          for ($match = 0; $match < $matchesPerRound; $match++) {
              $home = ($round + $match) % ($teams - 1);
              $away = ($teams - 1 - $match + $round) % ($teams - 1);
              // Last team stays in the same place while the others
              // rotate around it.
              if ($match == 0) {
                  $away = $teams - 1;
              }
              $rounds[$round][$match] = $this->team_name($home + 1, $names)
                  . " v " . $this->team_name($away + 1, $names);
          }
      }

      // Interleave so that home and away games are fairly evenly dispersed.
      $interleaved = array();
      for ($i = 0; $i < $totalRounds; $i++) {
          $interleaved[$i] = array();
      }

      $evn = 0;
      $odd = ($teams / 2);
      for ($i = 0; $i < sizeof($rounds); $i++) {
          if ($i % 2 == 0) {
              $interleaved[$i] = $rounds[$evn++];
          } else {
              $interleaved[$i] = $rounds[$odd++];
          }
      }

      $rounds = $interleaved;

      // Last team can't be away for every game so flip them
      // to home on odd rounds.
      for ($round = 0; $round < sizeof($rounds); $round++) {
          if ($round % 2 == 1) {
              $rounds[$round][0] = $this->flip($rounds[$round][0]);
          }
      }

      // // Display the fixtures
      // for ($i = 0; $i < sizeof($rounds); $i++) {
      //     print "<p>Round " . ($i + 1) . "</p>\n";
      //     foreach ($rounds[$i] as $r) {
      //         print $r . "<br />";
      //     }
      //     print "<br />";
      // }
      return $rounds;
  }

  public function secondhalf($rounds){
    $round_counter = sizeof($rounds) + 1;
    for ($i = sizeof($rounds) - 1; $i >= 0; $i--) {
        $round_counter += 1;
        foreach ($rounds[$i] as $r) {
            $dados[$i][]=$this->flip($r);
        }
    }
    return $dados;
  }
  public function flip($match) {
      $components = explode(' v ', $match);
      return $components[1] . " v " . $components[0];
  }

  public static function eachTeam($round){
    $components = explode(' v ', (string)$round);
    return $components;
  }
  public function team_name($num, $names) {
      $i = $num - 1;
      if (sizeof($names) > $i && strlen(trim($names[$i])) > 0) {
          return trim($names[$i]);
      } else {
          return $num;
      }
  }
}
