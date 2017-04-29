<?php
class supports extends Base{
    function getCompte(){
        $this->open();
        try{
            if (isset($_SESSION['guid'])){
                $requete = "SELECT * FROM accounts WHERE guid=?;";
                if ($this->nombre($requete,array($_SESSION['guid']))==1){
                    $compte = $this->lire($requete, array($_SESSION['guid']), 0);
                    if (isset($compte) && $compte != null){
                        $requete = "SELECT * FROM personnages WHERE account=? ORDER BY xp;";
                         if ($this->nombre($requete,array($_SESSION['guid']))>=1){
                            $perso = $this->lire($requete, array($_SESSION['guid']));
                            if (isset($perso) && $perso != null){
                                $compte['perso'] = $perso;
                                return $compte;
                            }
                         }
                    }
                }
            }
            return null;
        }catch(PDOException $e){new Erreur($e->getMessage());return null;}catch(ErrorException $e){new Erreur($e->getMessage());return null;}
    }
    function ValideMsg(){
        $this->open();
        $this->msg = "<font color='red'>Une erreur c'est produite !</font>";
        try{
            if (isset($_POST['perso'],$_POST['sujet'],$_POST['message'])){
                $requete = "INSERT INTO legium_support(sujet,compte,perso,msg) VALUES (?,?,?,?);";
                $msg = $this->secu($_POST['message']);
                $perso = $this->secu($_POST['perso']);
                if ($this->nombre("SELECT guid FROM personnages WHERE account=? and guid=?;",array($_SESSION['guid'],$perso))==1){
                    $sujet = $this->secu($_POST['sujet']);
                    $infos = array($sujet,$_SESSION['guid'],$perso,$msg);
                    $verif = $this->add($requete, $infos);
                    if ($verif){
                        $this->msg = "<font color='green'>Votre message a bien été envoyé au support ! Vous aurez une réponse En jeux dés que possible</font>";
                    }
                }
            }else{
                $this->msg = "<font color='red'>Vous devez remplir tout les champs !</font>";
            }
            return $this->msg;
        }catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
    }
}
?>
