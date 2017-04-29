<?php
class Base extends Bdd{
    var $db = null;
    function open(){
        try
        {
            $this->db = new PDO("mysql:host=".$this->hote.";dbname=".$this->bdd, $this->utilisateur, $this->pass);
        }
        catch (PDOException $e)
        {
            new Erreur($e->getMessage());
        }
    }
    
    function lire($chaine,$args=array(),$num=-1){
        try{
            $stmt = $this->db->prepare($chaine);
            $stmt->execute($args);
            $donne = $stmt->fetchAll();
            if ($num > -1){
                return $donne[$num];
            }
            return $donne;
        } catch (PDOException $e){
            new Erreur($e->getMessage());
            return null;
	}
    }
    
    function nombre($chaine,$args=array()){
        try{
            $stmt = $this->db->prepare($chaine);
            $stmt->execute($args);
            $nbr = $stmt->rowCount();
            return $nbr;
        } catch (PDOException $e){
            new Erreur($e->getMessage());
            return 0;
	}
    }
    function secu($chaine){
        try{
            $chaine = substr($this->db->quote($chaine), 1, -1);
            return $chaine;
        } catch (PDOException $e){
            new Erreur($e->getMessage());
            return null;
	}
    }
    
    function add($chaine,$infos=array()){
        try{
            $stmt = $this->db->prepare($chaine);
            $stmt->execute($infos);
            return true;
        } catch (PDOException $e){
            new Erreur($e->getMessage());
            return false;
	}
    }
}
?>
