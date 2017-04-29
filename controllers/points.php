<?php
class points extends Controller{
    function index(){
        $infos['titre'] = 'Achat de points';
        if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        $cache_name = 'achat_points';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('achat');
    }
    function check(){
        $infos['titre'] = 'Achat de points';
        if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        $this->loadModel('starpass');
        $infos['page_erreur'] = $this->starpass->check();
        $this->set($infos);
        $this->render('check');
    }
}
?>
