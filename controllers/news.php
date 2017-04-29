<?php
class news extends Controller{
    function index(){
        $infos['titre'] = 'News';
        $cache_name = 'news';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('news');
    }
}
?>
