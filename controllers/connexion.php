<?php
class connexion extends Controller{
    function index(){
        $infos['titre'] = 'Connexion';
        if (isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être déconnecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        $this->loadModel('connexions');
        $infos['page_erreur'] = $this->connexions->connexion();
        $this->set($infos);
        $this->render('connexion');
    }
    function login(){
        $infos['titre'] = 'Connexion';
        if (isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être déconnecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        $this->loadModel('connexions');
        $infos['page_erreur'] = $this->connexions->connexion();
        $this->set($infos);
        $this->render('connexion');
    }
    function logout(){
        $infos['titre'] = 'Déconnexion';
        if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        $this->loadModel('connexions');
        $infos['page_erreur'] = $this->connexions->deconnexion();
        $this->set($infos);
        $this->render('connexion');
    }
}
?>
