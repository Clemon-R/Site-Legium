<?php
class vips extends Base{
	function check(){
		$this->open();
        $this->msg = "<font color='red'>Votre code n'a pas �t� valid� !</font>";
		// D�claration des variables
		$ident=$idp=$ids=$idd=$codes=$code1=$code2=$code3=$code4=$code5=$datas=''; 
		$idp = 31309; 
		// $ids n'est plus utilis�, mais il faut conserver la variable pour une question de compatibilit�
		$idd = 253872; 
		$ident=$idp.";".$ids.";".$idd;
		// On r�cup�re le(s) code(s) sous la forme 'xxxxxxxx;xxxxxxxx'
		if(isset($_POST['code1'])) $code1 = $_POST['code1']; 
		if(isset($_POST['code2'])) $code2 = ";".$_POST['code2']; 
		if(isset($_POST['code3'])) $code3 = ";".$_POST['code3']; 
		if(isset($_POST['code4'])) $code4 = ";".$_POST['code4']; 
		if(isset($_POST['code5'])) $code5 = ";".$_POST['code5']; 
		$codes=$code1.$code2.$code3.$code4.$code5; 
		// On r�cup�re le champ DATAS
		if(isset($_POST['DATAS'])) $datas = $_POST['DATAS']; 
		// On encode les trois chaines en URL
		$ident=urlencode($ident);
		$codes=urlencode($codes);
		$datas=urlencode($datas);

		/* Envoi de la requ�te vers le serveur StarPass
		Dans la variable tab[0] on r�cup�re la r�ponse du serveur
		Dans la variable tab[1] on r�cup�re l'URL d'acc�s ou d'erreur suivant la r�ponse du serveur */
		$get_f=@file( "http://script.starpass.fr/check_php.php?ident=$ident&codes=$codes&DATAS=$datas" ); 
		if(!$get_f) 
		{ 
		exit( "Votre serveur n'a pas acc�s au serveur de StarPass, merci de contacter votre h�bergeur. " ); 
		} 
		$tab = explode("|",$get_f[0]);
		if( substr($tab[0],0,3) == "OUI" ) 
		{ 
			$_SESSION['vip'] = 1;
            $this->add("INSERT INTO legium_historique(titre,args,date,compte,prix) VALUES (?,?,?,?,?);",array("STARPASS V.I.P",$code1." - ".$code2,date("H:i d/m/Y",time()),$_SESSION['guid'],0));
            $this->add("UPDATE accounts SET vip=? WHERE guid=?;", array(1,$_SESSION['guid']));
            $this->msg = "<font color='green'>Vos code ont bien �t� valid� !</font>";
		} 
		return $this->msg;
	}
}
?>