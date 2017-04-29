<?php
    $fichier="../../.htaccess";
    $fp=fopen($fichier,"a");
    //Votre adresse IP de connexion � Internet
    $ip_simple = $_SERVER['REMOTE_ADDR'];
    fputs($fp,"\n deny from $ip_simple");
    fclose($fp);
?>