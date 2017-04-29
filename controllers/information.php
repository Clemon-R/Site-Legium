<?php
class information extends Controller{
    function index(){
        $infos['titre'] = 'Informations';
        $cache_name = 'information';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('information');
    }
}
?>
