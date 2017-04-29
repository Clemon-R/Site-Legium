<?php
class reglement extends Controller{
    function index(){
        $infos['titre'] = 'Réglement Owny';
		/*$cache_name = 'reglement';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;*/
        $this->set($infos);
        $this->render('reglement');
    }
}
?>
