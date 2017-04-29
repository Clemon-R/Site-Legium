<?php
class Erreur{
    function __construct($erreur) {
        $fichier="erreur.txt";
        $fp=fopen($fichier,"a");
        fputs($fp,"Erreur : ".$erreur."\n");
        fclose($fp);
    }
    
}
?>
