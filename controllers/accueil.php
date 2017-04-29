<?php
class accueil extends Controller{
    function index(){
        $infos['titre'] = 'Accueil';
        $cache_name = 'accueil';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        if (!$cache->valide()){
            $this->loadModel('accueils');
            $infos['news'] = $this->accueils->getNews();
        }
        $this->set($infos);
        $this->render('accueil');
    }
}
?>
