<?

function __date($date) {
    if ($date=='') return ('');
    list($yyyy, $mm, $dd) = explode('-',$date);
    return $dd."/".$mm."/".$yyyy;
}
function __dateDB($date){
    if ($date=='') return ('NULL');
    list($dd, $mm, $yyyy) = explode('/',$date);
    return $yyyy."-".$mm."-".$dd;
}
