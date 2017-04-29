<?php
class votes extends Base{
    function voted(){
        $this->open();
        $this->msg = "<font color='red'>Une erreur c'est produite ! Votre vote n'a pas été pris en compte !</font>";
        if (!isset($_SESSION['voted']) || $_SESSION['voted'] != "true"){
            return "<font color='red'>Vous devez passer par la page vote pour pouvoir voter !</font>";
        }
        $_SESSION['voted'] = false;
        try
        {
            $requete = "SELECT heurevote,vote,points FROM accounts WHERE guid=?LIMIT 0, 1;";
            if ($this->nombre($requete,array($_SESSION['guid'])) == 1){
                $donne = $this->lire($requete,array($_SESSION['guid']),0);
                if (isset($donne)){
                    $requete = "SELECT time FROM vote_ip WHERE ip=? LIMIT 0, 1;";
                    if ($this->nombre($requete,array($_SERVER['REMOTE_ADDR'])) == 0){
                        $this->add("INSERT INTO vote_ip(ip,time) VALUES (?,?);", array($_SERVER['REMOTE_ADDR'],0)); 
                    }
                    $donne2 = $this->lire($requete,array($_SERVER['REMOTE_ADDR']),0);
                    if (isset($donne2)){
                        $heur_vote = (isset($donne['heurevote']))?$donne['heurevote']:0;
                        $heur_vote_ip = (isset($donne2['time']))?$donne2['time']:0;
                        if (($heur_vote+(60*60*3))<time() and ($_SESSION['heurevote']+(60*60*3))<time()){
                            if (($heur_vote_ip+(60*60*3)<time()) and !isset($_COOKIE['heurevote']) and $_SESSION['last_vote'] < time()){
                                $vote = ((isset($donne['vote']))?$donne['vote']:0)+1;
                                $points = ((isset($donne['points']))?$donne['points']:0)+((isset($_SESSION['vip']) && $_SESSION['vip'] == 1)?$this->points_vote_vip:$this->points_vote);
                                $infos = array($points,$vote,time(),$_SESSION['guid']);
                                $this->add("UPDATE accounts SET points=?,vote=?,heurevote=? WHERE guid=?;",$infos);
                                $this->add("UPDATE vote_ip SET time=? WHERE ip=?;", array(time(),$_SERVER['REMOTE_ADDR'])); 
                                $_SESSION['heurevote'] = time();
								setcookie('heurevote', time(), (time() + (60*60*3)));
								$_SESSION['last_vote'] = time() + (60*60*3);
								$compte = $this->lire("SELECT points FROM accounts WHERE guid=?;",array($_SESSION['guid']),0);
								$_SESSION['points'] = $compte['points'];
                                $_SESSION['points'] = $points;
                                $_SESSION['vote'] = $vote;
                                $this->add("INSERT INTO legium_historique(titre,args,date,compte,prix) VALUES (?,?,?,?,?);",array("Vote","1",date("H:i d/m/Y",time()),$_SESSION['guid'],((isset($_SESSION['vip']) && $_SESSION['vip'] == 1)?$this->points_vote_vip:$this->points_vote)));
                                $this->msg = "<font color='green'>Vous avez bien voté !</font>";
                            }else{
                                $this->msg = "<font color='red'>Vous ne pouvez pas encore voter avec cette ip !</font>";
                            }
                        }else{
                            $this->msg = "<font color='red'>Vous ne pouvez pas encore voter avec ce compte !</font>";
                        }
                    }
                }
            }
        }catch (PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch (Exception $e){new Erreur($e->getMessage());return $this->msg;}
        return $this->msg;
    }
}
?>
