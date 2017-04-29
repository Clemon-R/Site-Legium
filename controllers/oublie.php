<?php
class oublie extends Controller{
    function index(){
        $infos['titre'] = 'Mot de passe oublié ?';
        if (isset($_SESSION['guid'])){
            $infos['page_erreur'] = "<font color='red'>Vous devez être déconnecté !</font>";
            $this->set($infos);
            $this->render('erreur');
            return;
        }
        if (isset($_POST['valider'])){
            $this->loadModel('oublies');
            $infos['page_erreur'] = $this->oublies->Mdp();
            $this->set($infos);
            $this->render('mdp_check');
        }else{
            $cache_name = 'oublie_mdp';
            $cache = new Cache($cache_name);
            $infos['cache'] = $cache;
            $this->set($infos);
            $this->render('mdp');
        }
    }
}
?>
