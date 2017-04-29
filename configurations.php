<?php
class Configurations{
    //Information afficher
    var $titre = "Owny"; //Titre du serveur.
    var $cache_timer = 30; //Durée du cache en minutes.
    var $rejoindre_win = "Installateur.exe"; //Nom du fichier a télécharger + l'extension sur window
	var $rejoindre_mac = "Owny Disque.dmg"; //Nom du fichier a télécharger + l'extension sur mac
    var $points_vote = 50; //Points par vote normal
    var $points_vote_vip = 75; //Points par vote VIP
    var $points_achat = 550; //Points par achat de code
    var $points_achat_vip = 770; //Points par achat de code
	var $bourse_cado = -1; //Bourse de kamas a donner a l'inscription par ip
	var $change_name = 100; //Prix pour changer de nom
	var $change_sexe = 50; //Prix pour changer de sexe
	var $id_magasine = 346284; //Id du magasine du serveur
    
    //Serveur
    var $port = "443"; //Port de connexion
    var $ip = "185.13.39.151"; //Ip host
    
    //Lien
    var $facebook = "https://www.facebook.com/ownyFR/"; //Page facebook
    var $youtube = "http://www.youtube.com/embed/HDVhRnhWmmg"; //Lien mini video youtube
    var $rpg_vote = "http://www.rpg-paradize.com/?page=vote&vote=43559"; //Lien page rpg vote
    
    //Starpass
    var $idd = 253871; //idd document starpass 
    var $idp = 31309; //idp document starpass
}
?>
