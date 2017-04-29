<?php
class inscription extends Controller{
    function index(){
        $infos['titre'] = 'Inscription';
        if (!isset($_SESSION['login'])){
        if (isset($_POST['valide_inscription'])){
            $this->loadModel('inscriptions');
            $infos['page_erreur'] = $this->inscriptions->inscription();
            $this->set($infos);
            $this->render('erreur1');
        }else{
        $this->set($infos);
        $this->render('inscription');
        }
        }else{
        $this->set($infos);
        $this->render('erreur');    
        }
    }
}
?>
