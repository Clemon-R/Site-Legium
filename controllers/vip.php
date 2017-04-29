<?php
class vip extends Controller{
    function index(){
        $infos['titre'] = 'V.I.P';
		if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
		if (isset($_SESSION['vip']) &&	$_SESSION['vip'] == 1){
            $infos['page_erreur'] = "<font color='red'>Vous êtes déjà V.I.P !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        $cache_name = 'vip';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('vip');
    }
	function check(){
		$infos['titre'] = 'V.I.P';
		if (!isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être connecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
		$this->loadModel('vips');
		$infos['page_erreur'] = $this->vips->check();
		$this->set($infos);
        $this->render('check');
	}
}
?>
