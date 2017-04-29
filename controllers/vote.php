<?php
class vote extends Controller{
    function index(){
        $infos['titre'] = 'Vote';
        if (isset($_SESSION['login'])){
        $this->set($infos);
        $this->render('vote');
        }else{
        $this->set($infos);
        $this->render('erreur');   
        }
    }
    function voted(){
        $infos['titre'] = 'Vote';
        if (isset($_SESSION['login'])){
        $this->loadModel('votes');
        $infos['page_erreur'] = $this->votes->voted();
        $this->set($infos);
        $this->render('voted');
        }else{
         $this->render('erreur');   
        }
    }
}
?>
