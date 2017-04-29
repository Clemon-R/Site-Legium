<?php
class gmcommands extends Controller{
    function index(){
        $infos['titre'] = 'Tutoriel Commandes GM';
		if (!isset($_SESSION['gm']) || $_SESSION['gm'] < 1){
            $infos['page_erreur'] = "<font color='red'>Vous devez être un membre du staff !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        $cache_name = 'staff';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('gmcommands');
    }
}
?>
