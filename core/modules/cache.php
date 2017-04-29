<?php
class Cache extends Configurations{
    var $cache_url = '';
    var $cache_save = false;
    
    function __construct($name=null) {
        if ($name != null){
            $this->cache_url = ROOT.'cache/'.$name.'.html';
        }
    }
    function readCache() {
	$expire = time()-(60 * $this->cache_timer);
        if(file_exists($this->cache_url) && filemtime($this->cache_url) > $expire)
	{
            return file_get_contents($this->cache_url);
	}
	return null;
    }
    
    function valide(){
        $expire = time()-(60 * $this->cache_timer);
        if(file_exists($this->cache_url) && filemtime($this->cache_url) > $expire)
	{
            return true;
	}
        return false;
    }
    
    function startSave(){
        if (!$this->cache_save){
            ob_start();
            $this->cache_save = true;
        }
    }
    
    function endSave(){
        if ($this->cache_save){
            $page = ob_get_contents();
            ob_end_clean();
            if ($this->cache_url != ''){
				unlink($this->cache_url);
                file_put_contents($this->cache_url, $page);
            }
            echo $page;
            $this->cache_save = false;
        }
    }
}
?>
