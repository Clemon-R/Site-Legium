<!--
function getInternetExplorerVersion()
// Returns the version of Internet Explorer or a -1
// (indicating te use of another browser).
{
  var rv = -1; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
var ua = navigator.userAgent;
if (re.exec(ua) != null)
var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
  rv = parseFloat( RegExp.$1 );
  }
  return rv;
}

function readCookie(name) {
var nameEQ = name + "=";
var ca = document.cookie.split(';');
for(var i=0;i < ca.length;i++) {
  var c = ca[i];
  while (c.charAt(0)==' ') c = c.substring(1,c.length);
  if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
}
return null;
}

function createCookie(name,value,min) {
if (min) {
  var date = new Date();
  date.setTime(date.getTime()+(min*60*180));
  var expires = "; expires="+date.toGMTString();
}
else var expires = "";
document.cookie = name+"="+value+expires+"; path=/";
}


window.onload = function vote_popup() {

var ver = getInternetExplorerVersion();
if(navigator.appName == 'Microsoft Internet Explorer' && ver < 7.0)
{
return;
}

sgvote6 = readCookie('sgvote6');

if (sgvote6 == null) {
  document.getElementById('vote_popup').style.display = "block";
}

}

function hide_vote_popup() {
createCookie('sgvote6','yes','1440');
document.getElementById('vote_popup').style.display = "none";
document.getElementById('vote_popup').innerHTML = "";
alert("Merci quand même, bon jeux sur Owny");
};
function hide_voted_popup() {
createCookie('sgvote6','yes','1440');
document.getElementById('vote_popup').style.display = "none";
document.getElementById('vote_popup').innerHTML = "";
alert("Merci a vous");
};
// -->