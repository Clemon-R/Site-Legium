<?php
class support extends Controller{
    function index(){
        $infos['titre'] = 'Support';
        if (isset($_SESSION['login'])){
        if (isset($_POST['envoyer'])){
        $this->loadModel('supports');
        $infos['page_erreur'] = $this->supports->ValideMsg();
        $this->set($infos);
        $this->render('erreur');
        }else{
        $this->loadModel('supports');
        $infos['compte'] = $this->supports->getCompte();
        $this->set($infos);
        $this->render('support');    
        }
        }else{
        $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
        $this->set($infos);
        $this->render('erreur');    
        }
    }
}
?>
