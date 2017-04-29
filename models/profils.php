<?php
class profils extends Base{
	function getProfil($guid){
		if (!isset($guid)){
			return null;
		}
		$this->open();
		try{
			$requete = "SELECT * FROM accounts WHERE guid=?;";
			if ($this->nombre($requete,array($guid)) == 1){
				$donne = $this->lire($requete,array($guid),0);
                if (isset($donne) && $donne != null){
                    return $donne;
                }
			}
		}catch(PDOException $e){new Erreur($e->getMessage());return null;}catch(ErrorException $e){new Erreur($e->getMessage());return null;}
		return null;
	}
	function choosePassword(){
		$this->msg = "<font color='red'>Une erreur c'est produite !</font>";
		if (!isset($_POST['mdp_act'],$_POST['new_mdp'],$_POST['new_mdp_conf'],$_POST['reponse'])){
			$this->msg = "<font color='red'>Veuillez compléter tout les champs !</font>";
			return $this->msg;
		}
		$this->open();
		try{
			$requete = "SELECT reponse FROM accounts WHERE guid=? and pass=?;";
			if ($this->nombre($requete,array($_SESSION['guid'],$_POST['mdp_act'])) == 1){
				if ($_POST['new_mdp'] == $_POST['new_mdp_conf']){
					$donne = $this->lire($requete,array($_SESSION['guid'],$_POST['mdp_act']),0);
					if (isset($donne) && $donne != null){
						if ($donne['reponse'] == $_POST['reponse']){
							$this->add("UPDATE accounts SET pass=? WHERE guid=?;", array($_POST['new_mdp'],$_SESSION['guid']));
							$this->msg = "<font color='green'>Votre mot de passe à bien étais changer !</font>";
						}else{
							$this->msg = "<font color='red'>La réponse secréte est incorrecte !</font>";
						}
					}
				}else{
					$this->msg = "<font color='red'>Les deux mot de passe ne corresponde pas !</font>";
				}
			}else{
				$this->msg = "<font color='red'>Le mot de passe actuel est incorrecte !</font>";
			}
		}catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
		return $this->msg;
	}
}
?>