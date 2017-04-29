<?php
class accueils extends Base{

    function getNews($nbr=5){
        $this->open();
        try
        {
            $requete = "SELECT * FROM legium_news ORDER BY id DESC LIMIT 0, $nbr;";
            if ($this->nombre($requete) >= 1){
                $donne = $this->lire($requete);
                if ($donne){
                    return $donne;
                }
            }
            return null;
        } catch (PDOException $e){new Erreur($e->getMessage());return;}
    }
}
?>
