<?
/**
 * random function adapted from
 *  http://stackoverflow.com/questions/10419501/use-php-to-generate-random-decimal-beteween-two-decimals
 */
function random($min, $max){
   $decimals = max(strlen(substr(strrchr($min+"", "."), 1)), strlen(substr(strrchr($max+"", "."), 1)));
   $factor = pow(10, $decimals);
   return rand($min*$factor, $max*$factor) / $factor;
}
