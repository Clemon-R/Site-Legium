<?php
class rejoindre extends Controller{
    function index(){
        $infos['titre'] = 'Nous Rejoindre';
        $cache_name = 'rejoindre';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('rejoindre');
    }
}
?>
