<?php
class oublies extends Base{
    function Mdp(){
        $this->open();
        $this->msg = "<font color='red'>Une erreur c'est produite !</font>";
        try
        {
            if (isset($_POST['email']) && strlen($_POST['email'])>0){
				if (!isset($_COOKIE['oublie_mdp'])){
					$requete = "SELECT account,pass FROM accounts WHERE email=?;";
					if ($this->nombre($requete,array($_POST['email'])) >= 1){
						$donne = $this->lire($requete,array($_POST['email']));
						if (isset($donne) && $donne != null){
							$header="Serveur ".$this->titre.".";
							$subject="Récupération des Informations de votre compte.";
							$to=$_POST['email'];
							$msg = "
							   Vous avez fait une demande pour retrouver vos identifiants chez ".$this->titre."

							   Ce mail vous permettra de connaître les identifiants lié à votre/vos compte(s) soit le nom de compte et le mot de passe

							   
							";
							foreach ($donne as $value => $i){
								if (isset($i['account'],$i['pass'])){
									$msg .= "Nom de compte : ".$i['account']." \nMot de passe : ".$i['pass']."\n\n";
								}
							}
							$msg .= "Bon jeu sur ".$this->titre.".";
							$a=mail($to,$subject,$msg,$header);
							setcookie('oublie_mdp', 'oublie', (time() + (60*5)));
							if ($a){
								$this->msg = "<font color='green'>L'e-mail a bien été envoyé !</font>";
							}
						}
					}else{
						$this->msg = "<font color='red'>Aucun compte trouvé !</font>";
					}
				}else{
					$this->msg = "<font color='red'>Vous avez fait une demande il y a moins de 5 minutes !</font>";
				}
            }else{
                $this->msg = "<font color='red'>Vous devez indiquer votre e-mail !</font>";
            }
            return $this->msg;
        } catch (PDOException $e){new Erreur($e->getMessage());return $this->msg;} catch (ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
    }
}
?>
