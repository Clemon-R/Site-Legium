<?php
class classement extends Controller{
    function index(){
        $infos['titre'] = 'Top Joueurs';
        $cache_name = 'classement_joueurs';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        if (!$cache->valide()){
            $this->loadModel('classements');
            $infos['liste'] = $this->classements->getListeJoueurs();
        }
        $this->set($infos);
        $this->render('joueurs');
    }
    function joueurs(){
        $infos['titre'] = 'Top Joueurs';
        $cache_name = 'classement_joueurs';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        if (!$cache->valide()){
            $this->loadModel('classements');
            $infos['liste'] = $this->classements->getListeJoueurs();
        }
        $this->set($infos);
        $this->render('joueurs');
    }
    function votes(){
        $infos['titre'] = 'Top Votes';
        /*$cache_name = 'classement_votes';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        if (!$cache->valide()){
            $this->loadModel('classements');
            $infos['liste'] = $this->classements->getListeVotes();
        }*/
		$this->loadModel('classements');
        $infos['liste'] = $this->classements->getListeVotes();
        $this->set($infos);
        $this->render('votes');
    }
    function guildes(){
        $infos['titre'] = 'Top Guildes';
        $cache_name = 'classement_guildes';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        if (!$cache->valide()){
            $this->loadModel('classements');
            $infos['liste'] = $this->classements->getListeGuildes();
        }
        $this->set($infos);
        $this->render('guildes');
    }
    function prestige(){
        $infos['titre'] = 'Top Prestige';
        $cache_name = 'classement_prestige';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        if (!$cache->valide()){
            $this->loadModel('classements');
            $infos['liste'] = $this->classements->getListePrestige();
        }
        $this->set($infos);
        $this->render('prestige');
    }
    function pvp(){
        $infos['titre'] = 'Top Pvp';
        $cache_name = 'classement_pvp';
        $cache = new Cache($cache_name);
        $infos['cache'] = $cache;
        if (!$cache->valide()){
            $this->loadModel('classements');
            $infos['liste'] = $this->classements->getListePvp();
        }
        $this->set($infos);
        $this->render('pvp');
    }
}
?>
