<?php
class jeux extends Controller{
    function index(){
        $infos['titre'] = 'Jeux en ligne';
        $cache_name = 'jeux';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('jeux');
    }
}
?>
