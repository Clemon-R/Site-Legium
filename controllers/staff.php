<?php
class staff extends Controller{
    function index(){
        $infos['titre'] = 'Equipe';
        /*$cache_name = 'staff';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;*/
        $this->set($infos);
        $this->render('staff');
    }
}
?>
