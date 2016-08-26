<?

function __fieldArea($position){
  switch ($position) {
    case 'GK':
      $area='gk';
      break;
    case 'D C':
    case 'D L':
    case 'D R':
      $area='def';
      break;
    case 'DM C':
    case 'DM L':
    case 'DM R':
    case 'M C':
    case 'M R':
    case 'M L':
    case 'OM C':
    case 'OM L':
    case 'OM R':
      $area='mid';
      break;
    case 'F C':
      $area='atk';
      break;
  }
  return $area;
}
