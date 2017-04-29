<?php
class connexions extends Base{

    function connexion(){
        $this->open();
        $this->msg = "<font color='red'>Aucune information reçu !</font>";
        try
        {
            if (isset($_POST['connexion'])){
                if (isset($_POST['login'],$_POST['pass'])){
                    $login = $this->secu($_POST['login']);
                    $pass = $this->secu($_POST['pass']);
                    $compte = array($login,$pass);
                    $verif = $this->nombre("SELECT guid FROM accounts WHERE account=? and pass=?;",$compte);
                    if ($verif==1){
                        $infos = $this->lire("SELECT pack,ip_register,guid,account,points,heurevote,vote,vip,level FROM accounts WHERE account=? and pass=?;",$compte, 0);
                        $_SESSION['guid'] = $infos['guid'];
                        $_SESSION['login'] = $infos['account'];
                        $_SESSION['points'] = $infos['points'];
                        $_SESSION['heurevote'] = $infos['heurevote'];
                        $_SESSION['vote'] = $infos['vote'];
                        $_SESSION['pack'] = $infos['pack'];
                        $_SESSION['ip_register'] = $infos['ip_register'];
						$_SESSION['vip'] = $infos['vip'];
						$_SESSION['gm'] = $infos['level'];
						$_SESSION['last_vote'] = (isset($_SESSION['last_vote'])?$_SESSION['last_vote']:$infos['heurevote']+(60*60*3));
						if (strlen($_SESSION['ip_register'])<5){
							$this->add("UPDATE accounts SET ip_register=? WHERE guid=?;",array(get_ip(),$_SESSION['guid']));
						}
                        $this->msg = "<font color='green'>Vous avez bien été connecté !</font>";
                    }else{
                        $this->msg = "<font color='red'>Votre nom de compte ou mot de passe est incorrecte !</font>";
                    }
                }else{
                    $this->msg = "<font color='red'>Veuillez remplir tout les champs !</font>";
                }
            }else{
                $this->msg = "<font color='red'>Aucune information reçu !</font>";
            }
        }catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(Exception $e){new Erreur($e->getMessage());return $this->msg;}
    return $this->msg;    
    }
    function deconnexion(){
        $this->msg = "<font color='red'>Une erreur c'est produite !</font>";
        try{
            if (isset($_SESSION['login'])){
                $_SESSION['guid'] = null;
                $_SESSION['login'] = null;
                $_SESSION['points'] = null;
                $_SESSION['heurevote'] = null;
                $_SESSION['vote'] = null;
                $_SESSION['pack'] = null;
                $_SESSION['ip_register'] = null;
				$_SESSION['vip'] = null;
				$_SESSION['gm'] = null;
                $this->msg = "<font color='green'>Vous avez bien été déconnecté !</font>";
            }else{
                $this->msg = "<font color='red'>Vous devez être connecté !</font>";
            }
        }catch(Exception $e){new Erreur($e->getMessage());return $this->msg;}
        return $this->msg;
    }
}
?>
