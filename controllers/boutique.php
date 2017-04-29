<?php
class boutique extends Controller{
    function index(){
        $infos['titre'] = 'Boutique';
        if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (isset($_POST['valider'])){
            $this->loadModel('boutiques');
            $infos['page_erreur'] = $this->boutiques->savePersonnage();
            $this->set($infos);
            $this->render('nickel');
        }else{
            $this->loadModel('boutiques');
            $infos['liste'] = $this->boutiques->getPersonnages();
            $this->set($infos);
            $this->render('personnages');
        }
    }
    function shop(){
        $infos['titre'] = 'Boutique';
        if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (!isset($_SESSION['perso'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez suivre les instructions !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        $cache_name = 'boutique_shop';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('boutique');
    }
    function itemjp($args=array()){
        $infos['titre'] = 'Boutique';
        if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (!isset($_SESSION['perso'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez suivre les instructions !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (count($args)==0){
            $this->loadModel('boutiques');
            $infos['liste'] = $this->boutiques->getDemande(0);
            $this->set($infos);
            $this->render('itemjp');
        }else{
            if (isset($args[0]) && !isset($args[1]) && is_numeric($args[0])){
                $this->loadModel('boutiques');
                $infos['liste'] = $this->boutiques->getItemjpListe($args[0]);
                $infos['id'] = $args[0];
                $this->set($infos);
                $this->render('itemjp_liste');
            }elseif (isset($args[0]) && isset($args[1]) && is_numeric($args[0])){
                $this->loadModel('boutiques');
                $infos['page_erreur'] = $this->boutiques->ItemjpValide($args[0]);
                $this->set($infos);
                $this->render('itemjp_check');
            }
        }
    }
    function item($args=array()){
        $infos['titre'] = 'Boutique';
        if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (!isset($_SESSION['perso'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez suivre les instructions !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (isset($args[0]) && !isset($args[1]) && is_string($args[0])){
            $type = -1;
            switch ($args[0]){
                case "potion":
                    $type = 1;
                break;
                case "runes":
                    $type = 2;
                break;
				case "vivant":
                    $type = 4;
                break;
				case "autre":
                    $type = 6;
                break;
				case "gemme":
                    $type = 7;
                break;
				case "personnalise":
					$type = 8;
				break;
           }
            $infos['id'] = $args[0];
            $this->loadModel('boutiques');
            $infos['liste'] = $this->boutiques->getItem($type);
            $this->set($infos);
            $this->render('item');
        }elseif (isset($args[0]) && isset($args[1]) && is_string($args[0])){
            $this->loadModel('boutiques');
            $infos['page_erreur'] = $this->boutiques->ItemValide();
            $this->set($infos);
            $this->render('item_check');
        }else{
            $infos['page_erreur'] = "<font color='red'>Vous devez suivre les instructions !</font>";
            $this->set($infos);
            $this->render('erreur');
        }
    }
    function kamas($args=array()){
        $infos['titre'] = 'Boutique';
        if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (!isset($_SESSION['perso'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez suivre les instructions !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (isset($args[0]) && is_string($args[0])){
            $this->loadModel('boutiques');
            $infos['page_erreur'] = $this->boutiques->KamasValide();
            $this->set($infos);
            $this->render('kamas_check');
        }else{
            $this->loadModel('boutiques');
            $infos['liste'] = $this->boutiques->getDemande(3);
            $this->set($infos);
            $this->render('kamas');
        }
    }
	function service($args=array()){
        $infos['titre'] = 'Boutique';
		if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
		if (!isset($_SESSION['perso'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez suivre les instructions !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (isset($args[0]) && is_string($args[0])){
			if ($args[0] == "nom"){
				if (isset($_POST['valider'])){
					$this->loadModel('boutiques');
					$infos['page_erreur'] = $this->boutiques->ValideName();
					$this->set($infos);
					$this->render('nickel');
				}else{
					$this->set($infos);
					$this->render('service_nom');
				}
			}elseif ($args[0] == "sexe"){
				if (isset($_POST['valider'])){
					$this->loadModel('boutiques');
					$infos['page_erreur'] = $this->boutiques->ChangerDeSexe();
					$this->set($infos);
					$this->render('nickel');
				}else{
					$this->loadModel('boutiques');
					$infos['value'] = $this->boutiques->getSexePerso();
					$this->set($infos);
					$this->render('service_sexe');
				}
			}elseif ($args[0] == "titre"){
				if (isset($_POST['valider'])){
					$this->loadModel('boutiques');
					$infos['page_erreur'] = $this->boutiques->ValiderTitre();
					$this->set($infos);
					$this->render('nickel');
				}else{
					$this->loadModel('boutiques');
					$infos['value'] = $this->boutiques->getTitre();
					$this->set($infos);
					$this->render('service_titre');
				}
			}
        }
    }
}
?>
