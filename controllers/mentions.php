<?php
class mentions extends Controller{
    function index(){
        $infos['titre'] = 'Mentions l�gale';
        $cache_name = 'mentions';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        $this->set($infos);
        $this->render('mentions');
    }
}
?>
