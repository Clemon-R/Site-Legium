<?php
class profil extends Controller{
    function index(){
        $infos['titre'] = 'Profil';
		if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
		$this->loadModel('profils');
		if (isset($_POST['valider'])){
            $infos['page_erreur'] = $this->profils->choosePassword();
            $this->set($infos);
            $this->render('nickel');
        }else{
            $infos['compte'] = $this->profils->getProfil($_SESSION['guid']);
			if ($infos['compte'] == null){
				$infos['page_erreur'] = "<font color='red'>Impossible de charger votre page de profil !</font>";
				$this->set($infos);
				$this->render('erreur');
				return;
			}
            $this->set($infos);
            $this->render('default');
        }
    }
}
?>
