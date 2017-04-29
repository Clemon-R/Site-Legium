<?php
class classements extends Base{

    function getListeJoueurs($nbr=50){
        $this->open();
        try
        {
            $requete = "SELECT name,level,sexe,class FROM personnages WHERE (SELECT level FROM accounts WHERE guid=personnages.account)=0 ORDER BY level DESC,xp DESC LIMIT 0, $nbr;";
            if ($this->nombre($requete) >= 1){
                $donne = $this->lire($requete);
                if ($donne){
                    return $donne;
                }
            }
            return array();
        } catch (PDOException $e){new Erreur($e->getMessage());return;}
    }
    function getListeVotes($nbr=50){
        $this->open();
        try
        {
            $requete = "SELECT pseudo,logged,vip,vote FROM accounts WHERE level=0 ORDER BY vote DESC LIMIT 0, $nbr;";
            if ($this->nombre($requete) >= 1){
                $donne = $this->lire($requete);
                if ($donne){
                    return $donne;
                }
            }
            return array();
        } catch (PDOException $e){new Erreur($e->getMessage());return;}
    }
    function getListeGuildes($nbr=20){
        $this->open();
        try
        {
            $requete = "SELECT lvl,name,xp,id,emblem FROM guilds ORDER BY lvl DESC LIMIT 0, $nbr;";
            if ($this->nombre($requete) >= 1){
                $donne = $this->lire($requete);
                if ($donne){
                    return $donne;
                }
            }
            return array();
        } catch (PDOException $e){new Erreur($e->getMessage());return;}
    }
    function getListePrestige($nbr=50){
        $this->open();
        try
        {
            $requete = "SELECT * FROM personnages WHERE (SELECT level FROM accounts WHERE guid=personnages.account)=0 ORDER BY prestige DESC,xp DESC LIMIT 0, $nbr;";
            if ($this->nombre($requete) >= 1){
                $donne = $this->lire($requete);
                if ($donne){
                    return $donne;
                }
            }
            return array();
        } catch (PDOException $e){new Erreur($e->getMessage());return;}
    }
    function getListePvp($nbr=50){
        $this->open();
        try
        {
            $requete = "SELECT * FROM personnages WHERE (SELECT level FROM accounts WHERE guid=personnages.account)=0 ORDER BY honor DESC LIMIT 0, $nbr;";
            if ($this->nombre($requete) >= 1){
                $donne = $this->lire($requete);
                if ($donne){
                    return $donne;
                }
            }
            return array();
        } catch (PDOException $e){new Erreur($e->getMessage());return;}
    }
}
?>