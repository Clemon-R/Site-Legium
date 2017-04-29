<?php
class cgu extends Controller{
    function index(){
        $infos['titre'] = 'Conditions Générale D\'utilisation';
		/*$cache_name = 'cgu';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;*/
        $this->set($infos);
        $this->render('cgu');
    }
}
?>
