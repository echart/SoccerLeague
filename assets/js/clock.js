function clock() {
  var hours = digital.getHours();
  var minutes = digital.getMinutes();
  var seconds = digital.getSeconds();
  digital.setSeconds( seconds+1 ); // aquin que faz a mágica

  // acrescento zero
  if (minutes <= 9) minutes = "0" + minutes;
  if (seconds <= 9) seconds = "0" + seconds;

  dispTime = hours + ":" + minutes + ":" + seconds;
  document.getElementById("sltime").innerHTML = dispTime;
  setTimeout("clock()", 1000);
}
