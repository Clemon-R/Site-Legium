<?php

/*
CHMOD /iplog/ to 777
Create and CHMOD /iplog/iplogfile.dat to 666
add the following line in any important .php file in the same directory as your anti_dos.php file so it can check IPs when that file is loaded, best example is index.php if you have it.
include("anti_dos.php"); //anti-DoS, prevents rapid accessing

if you have a known cookie on your site, 
you can use this, otherwise just ignore this, it will set a different limit 
for people with this cookie

I use yourothercookie as the cookie ID for the forum, my forum uses ID 
greater than 0 for all members and -1 for guests and members who have logged out, 
so making it match greater than zero means members will get better access and 
guests with or without cookies won't

Also I use these cookies in the "flood alert" emails to make sure an important user didn't get banned. Someone could fake a cookie, so always be suspicious. Tez
*/
$mail = "r.goulmot@hotmail.fr"; //Mon email en cas de ddos



$cookie = (isset($_COOKIE['cookie1']))?$_COOKIE['cookie1']:0;
$othercookie = (isset($_COOKIE['cookie2']))?$_COOKIE['cookie2']:0;


if($cookie && $othercookie > 0) $iptime = 10;  // Minimum number of seconds between visits for users with certain cookie
else $iptime = 10; // Minimum number of seconds between visits for everyone else


$ippenalty = 60; // Seconds before visitor is allowed back 


if($cookie && $othercookie > 0)$ipmaxvisit = 30; // Maximum visits, per $iptime segment
else $ipmaxvisit = 15; // Maximum visits per $iptime segment


$iplogdir = ROOT."iplog/";
$iplogfile = "iplog.dat";

$ipfile = substr(md5($_SERVER["REMOTE_ADDR"]),-2);
$oldtime = 0;
if (file_exists($iplogdir.$ipfile)) $oldtime = filemtime($iplogdir.$ipfile);

$time = time();
if ($oldtime < $time) $oldtime = $time;
$newtime = $oldtime + $iptime;

if ($newtime >= $time + $iptime*$ipmaxvisit)
{
touch($iplogdir.$ipfile, $time + $iptime*($ipmaxvisit-1) + $ippenalty);
$oldref = $_SERVER['HTTP_REFERER'];
header("HTTP/1.0 503 Service Temporarily Unavailable");
header("Connection: close");
header("Content-Type: text/html");
echo "<html><title>DDoS détecté !</title>
<body bgcolor=#999999 text=#ffffff link=#ffff00>
<font face='Verdana, Arial'><p><b>
<h1>Accès suspendu temporairement.</h1>Trop de pages ont été ouvertes simultanément avec votre adresse IP (plus de ".$ipmaxvisit." visites en ".$iptime." secondes).</b>
";
echo "<br />Attendez ".$ippenalty." secondes et réssayez.</p></font></body></html>";
touch($iplogdir.$iplogfile); //create if not existing
$fp = fopen($iplogdir.$iplogfile, "a");
$yourdomain = $_SERVER['HTTP_HOST'];
   if ($fp)
   {
   $useragent = "<unknown user agent>";
   if (isset($_SERVER["HTTP_USER_AGENT"])) $useragent = $_SERVER["HTTP_USER_AGENT"];
   fputs($fp, $_SERVER["REMOTE_ADDR"]." ".date("d/m/Y H:i:s")." ".$useragent."\n");
   fclose($fp);
   $yourdomain = $_SERVER['HTTP_HOST'];
   
   //the @ symbol before @mail means 'supress errors' so you wont see errors on the page if email fails.
if($_SESSION['reportedflood'] < 1 && ($newtime < $time + $iptime + $iptime*$ipmaxvisit))
   @mail($mail, 'site ddos par '.$cookie.' '
   .$_SERVER['REMOTE_ADDR'],'http://'.$yourdomain.' site ddos, ip bannie :'.$_SERVER['REMOTE_ADDR'].' a http://'.$yourdomain.$_SERVER['REQUEST_URI'].' de '.$oldref.' agent '.$_SERVER['HTTP_USER_AGENT'].' '
   .$cookie.' '.$othercookie, "De: ".$yourdomain."n");
   $_SESSION['reportedflood'] = 1;
   }
   exit();
}
else $_SESSION['reportedflood'] = 0;

//echo("loaded ".$cookie.$iplogdir.$iplogfile.$ipfile.$newtime);
touch($iplogdir.$ipfile, $newtime); //this just updates the IP file access date or creates a new file if it doesn't exist in /iplog
?>