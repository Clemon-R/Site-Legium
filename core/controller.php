<?php
class Controller extends Configurations{
    
    var $donne = array();
    var $layout = 'default';
    
    function set($var){
        $this->donne = array_merge($this->donne,$var);
    }
    
    function render($filename){
        extract($this->donne);
        if (isset($erreur) && $erreur = true){
            die("Directory access is forbidden.");
        }
		if (isset($cache)){
			if ($cache->valide()){
				$contenu = $cache->readCache();
			}else{
				$cache->startSave();
				if (isset($page_erreur) && $page_erreur != ""){echo "<center>".$page_erreur."</center>";} 
				(file_exists(ROOT.'views/'.get_class($this).'/'.$filename.'.php'))?require(ROOT.'views/'.get_class($this).'/'.$filename.'.php'):"";
				$contenu = $cache->endSave();
			}
		}else{
			ob_start();
			if (isset($page_erreur) && $page_erreur != ""){echo "<center>".$page_erreur."</center>";} 
			(file_exists(ROOT.'views/'.get_class($this).'/'.$filename.'.php'))?require(ROOT.'views/'.get_class($this).'/'.$filename.'.php'):"";
			$contenu = ob_get_contents();
			ob_end_clean();
		}
        require(ROOT.'views/layout/'.$this->layout.'.php');
    }
    
    function loadModel($name){
        require_once (ROOT.'models/'.strtolower($name).'.php');
        $this->$name = new $name();
    }
}
?>
