<?php
class boutiques extends Base{
    function getDemande($type){
        $this->open();
        try
        {   
            $requete = "SELECT * FROM legium_boutique WHERE type=?;";
            if ($this->nombre($requete,array($type)) >= 1){
                $donne = $this->lire($requete,array($type));
                if (isset($donne) && $donne != null){
                    return $donne;
                }
            }
            return null;
        }catch(PDOException $e){new Erreur($e->getMessage());return null;}catch(ErrorException $e){new Erreur($e->getMessage());return null;}
    }
	function ValideName(){
        $this->open();
		$this->msg = "<font color='red'>Une erreur c'est produite !</font>";
        try
        {   
            if (isset($_POST['name'])){
				if (is_alpha($_POST['name'])){
					$requete = "SELECT name FROM personnages WHERE name=?;";
					if ($this->nombre($requete,array($_POST['name'])) == 0){
						if ($this->nombre("SELECT guid FROM accounts WHERE guid=? and logged=1;",array($_SESSION['guid'])) == 1){
                            $this->msg = "<font color='red'>Vous devez être déconnecté !</font>";
                            return $this->msg;
                        }
						$compte = $this->lire("SELECT points FROM accounts WHERE guid=?;",array($_SESSION['guid']),0);
						$_SESSION['points'] = $compte['points'];
						if ($_SESSION['points']>=$this->change_name){
                            $requete = "UPDATE personnages SET name=? WHERE guid=?;";
                            $points = $_SESSION['points']-$this->change_name;
                            $_SESSION['points'] = $points;
                            $infos = array($_POST['name'],$_SESSION['perso']);
                            if ($this->add($requete, $infos)){
                                $this->add("INSERT INTO legium_historique(titre,args,date,compte,prix,personnage) VALUES (?,?,?,?,?,?);",array("Nom",$_POST['name'],date("H:i d/m/Y",time()),$_SESSION['guid'],$this->change_name,$_SESSION['perso']));
                                $_SESSION['perso'] = null;
								$this->add("UPDATE accounts SET points=? WHERE guid=?;", array($points,$_SESSION['guid']));
                                $this->msg = "<font color='green'>Votre changement de nom a bien était appliaquer !</font></br><meta http-equiv='refresh' content='5; ".WEBROOT."'>Refresh en cours veuillez patienter 5 secondes.";
                            }
                        }else{
							$this->msg = "<font color='red'>Vous n'avez pas asser de points !</font>";
						}                            
					}else{
						$this->msg = "<font color='red'>Nom déjà prit !</font>";
					}
				}else{
					$this->msg = "<font color='red'>Votre nom ne doit pas contenir de caractéres spéciale !</font>";
				}
            }else{
				$this->msg = "<font color='red'>Veuillez entrer un nom !</font>";
			}
            return $this->msg;
        }catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
    }
    function getItem($type){
        $this->open();
        if (!isset($type) || !is_numeric($type)){
            return null;
        }
        try
        {
            $requete = "SELECT * FROM legium_boutique WHERE type=?;";
            if ($this->nombre($requete,array($type)) >= 1){
                $donne = $this->lire($requete,array($type));
                if (isset($donne) && $donne != null){
                    $items = array();
                    foreach ($donne as $i => $infos){
                        if($infos==null)continue;
                        $requete = "SELECT statsTemplate,pod FROM item_template WHERE id=?;";
                        if (isset($infos['args']) && $this->nombre($requete,array($infos['args']))==1){
                            $donne2 = $donne = $this->lire($requete,array($infos['args']),0);
                            $item = array(
                                "name" => $infos['titre'],
                                "prix" => $infos['prix'],
                                "pod" => $donne2['pod'],
                                "statsTemplate" => $donne2['statsTemplate'],
                                "id" => $infos['id'],
								"vip" => $infos['vip']
                            );
                            array_push($items, $item);
                        }
                    }
                    return $items;
                }
            }
            return null;
        }catch(PDOException $e){new Erreur($e->getMessage());return null;}catch(ErrorException $e){new Erreur($e->getMessage());return null;}
    } 
	function getTitre(){
        $this->open();
        try
        {
            $requete = "SELECT * FROM legium_boutique WHERE type=?;";
            if ($this->nombre($requete,array(5)) >= 1){
                $donne = $this->lire($requete,array(5));
                if (isset($donne) && $donne != null){
                    return $donne;
                }
            }
            return null;
        }catch(PDOException $e){new Erreur($e->getMessage());return null;}catch(ErrorException $e){new Erreur($e->getMessage());return null;}
    }
	function ValiderTitre(){
		$this->open();
		$this->msg = "<font color='red'>Une erreur c'est produite !</font>";
		try{
			if (isset($_POST['titre'])){
				$titre = $_POST['titre'];
				if (is_numeric($titre)){
					$requete = "SELECT * FROM legium_boutique WHERE args=? and type='5';";
					if ($this->nombre($requete,array($titre)) == 1){
						$donne = $this->lire($requete,array($titre),0);
						if (isset($donne) && $donne != null){
							if ($this->nombre("SELECT guid FROM accounts WHERE guid=? and logged=1;",array($_SESSION['guid'])) == 1){
                                $this->msg = "<font color='red'>Vous devez être déconnecté !</font>";
                                return $this->msg;
                            }
							$compte = $this->lire("SELECT points FROM accounts WHERE guid=?;",array($_SESSION['guid']),0);
							$_SESSION['points'] = $compte['points'];
							if ($_SESSION['points']>=$donne['prix']){
								$requete = "SELECT lastTitles FROM personnages WHERE guid=?;";
								$perso = $this->lire($requete,array($_SESSION['perso']),0);
								$lasttitres = $perso['lastTitles']."";
								$liste = explode(",", $lasttitres);
								$ok = true;
								foreach ($liste as $i => $value){
									if ($value == $titre){
										$ok = false;
									}
								}
								if ($ok){
									if ($lasttitres == ""){
										$lasttitres = $titre;
									}else{
										$lasttitres .= ",".$titre;
									}
								}
								$requete = "UPDATE personnages SET title=?,lastTitles=? WHERE guid=?;";
								$verif = $this->add($requete,array($titre,$lasttitres,$_SESSION['perso']));
								$this->msg = "<font color='green'>Vous avez reçu votre titre !</font>";
								if ($verif){
									$points = $_SESSION['points']-$donne['prix'];
									$_SESSION['points'] = $points;
									$requete = "UPDATE accounts SET points=? WHERE guid=?;";
									$this->add("INSERT INTO legium_historique(titre,args,date,compte,prix,personnage) VALUES (?,?,?,?,?,?);",array("Titre",$titre,date("H:i d/m/Y",time()),$_SESSION['guid'],$donne['prix'],$_SESSION['perso']));
									$this->add($requete,array($points,$_SESSION['guid']));
									$_SESSION['perso'] = null;
								}
							}else{
								$this->msg = "<font color='red'>Tu n'a pas asser de points !</font>";
							}
						}
					}else{
						$this->msg = "<font color='red'>Votre titre n'a pas étais trouver !</font>";
					}
				}
			}else{
				$this->msg = "<font color='red'>Vous devez choisir un titre !</font>";
			}
		return $this->msg;
		}catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
	}
    function getItemjpListe($id){
        $this->open();
        if (!is_numeric($id) && $id > 100){
            return null;
        }
        try
        {
            $requete = "SELECT * FROM legium_boutique WHERE id=?;";
            if ($this->nombre($requete,array($id)) == 1){
                $donne = $this->lire($requete,array($id),0);
                if (isset($donne) && $donne != null){
                    if (isset($donne['args']) && is_numeric($donne['args'])){
                        $id_pnj = $donne['args'];
                        $requete = "SELECT ventes FROM npc_template WHERE id=?;";
                        if ($this->nombre($requete,array($id_pnj)) == 1){
                            $donne2 = $this->lire($requete,array($id_pnj),0);
                            if (isset($donne2,$donne2['ventes']) && strlen($donne2['ventes']) > 0){
                                $liste_item = explode(",", $donne2['ventes']);
                                $items = array();
                                for ($a = 0;$a < count($liste_item);$a++){
                                    $id = $liste_item[$a];
                                    $requete = "SELECT name,id,statsTemplate FROM item_template WHERE id=?;";
                                    if ($this->nombre($requete,array($id))==1){
                                        $item = $this->lire($requete,array($id),0);
                                        if (isset($item) && $item != null){
                                            array_push($items, $item);
                                        }
                                    }
                                }
                                return $items;
                            }
                        }
                    }
                }
            }
            return null;
        }catch(PDOException $e){new Erreur($e->getMessage());return null;}catch(ErrorException $e){new Erreur($e->getMessage());return null;}  
    }
    function ItemjpValide($id){
        $this->open();
        $this->msg = "<font color='red'>Une erreur c'est produite !</font>";
        if (isset($_POST['valider'])){
        if (!is_numeric($id) && $id > 100){
            $this->msg = "<font color='red'>Veuillez suivre les instructions !</font>";
            return $this->msg;
        }
        try
        {
            $requete = "SELECT * FROM legium_boutique WHERE id=?;";
            if ($this->nombre($requete,array($id)) == 1){
                $donne = $this->lire($requete,array($id),0);
                if (isset($donne) && $donne != null){
                    if (isset($donne['args']) && is_numeric($donne['args'])){
                        $id_pnj = $donne['args'];
                        $requete = "SELECT ventes FROM npc_template WHERE id=?;";
                        if ($this->nombre($requete,array($id_pnj)) == 1){
                            $donne2 = $this->lire($requete,array($id_pnj),0);
                            if (isset($donne2,$donne2['ventes']) && strlen($donne2['ventes']) > 0){
                                $liste_item = explode(",", $donne2['ventes']);
                                if ($this->nombre("SELECT guid FROM accounts WHERE guid=? and logged=0;",array($_SESSION['guid'])) == 1){
                                    $this->msg = "<font color='red'>Vous devez être connecté !</font>";
                                    return $this->msg;
                                }
                                $first = false;
                                foreach ($_POST as $value => $a) {
                                    if (substr($value, 0, 4) == "item"){
                                        $infos = explode("_",$value);
                                        if (isset($infos[1]) && strlen($infos[1])>0 && is_numeric($infos[1])){
                                            for ($a = 0;$a < count($liste_item);$a++){
                                                $id = $liste_item[$a];
                                                if ($id == $infos[1]){
												$compte = $this->lire("SELECT points FROM accounts WHERE guid=?;",array($_SESSION['guid']),0);
												$_SESSION['points'] = $compte['points'];
                                                    if ($_SESSION['points']>=$donne['prix']){
                                                        $requete = "INSERT INTO live_action(playerid,action,nombre) VALUES (?,?,?);";
                                                        $points = $_SESSION['points']-$donne['prix'];
                                                        $_SESSION['points'] = $points;
                                                        $live_action = array($_SESSION['perso'],21,$id);
                                                        if ($this->add($requete, $live_action)){
                                                            $this->add("INSERT INTO legium_historique(titre,args,date,compte,prix,personnage) VALUES (?,?,?,?,?,?);",array("Item",$id,date("H:i d/m/Y",time()),$_SESSION['guid'],$donne['prix'],$_SESSION['perso']));
                                                            $this->add("UPDATE accounts SET points=? WHERE guid=?;", array($points,$_SESSION['guid']));
                                                            $this->msg = "<font color='green'>Votre achat vous a été envoyé !</font></br><meta http-equiv='refresh' content='5; ".WEBROOT."'>Refresh en cours veuillez patienter 5 secondes.";
                                                            $first = true;
                                                        }
                                                    }else{
                                                        if ($first){
                                                            $this->msg = "<font color='red'>Vous n'avez pas assez de points ! Mais certains items vous ont été facturé et envoyé !</font>";
                                                        }else{
                                                            $this->msg = "<font color='red'>Vous n'avez pas assez de point !</font>"; 
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                $_SESSION['perso'] = null;
                            }
                        }
                    }
                }
            }
            return $this->msg;
        }catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
        }else{
            $this->msg = "<font color='red'>Veuillez suivre les instructions !</font>";
            return $this->msg;
        }       
    }
    function ItemValide(){
        $this->open();
        $this->msg = "<font color='red'>Une erreur c'est produite !</font>";
        try{
            if (isset($_POST['valider'])){
                if ($this->nombre("SELECT guid FROM accounts WHERE guid=? and logged=0;",array($_SESSION['guid'])) == 1){
                    $this->msg = "<font color='red'>Vous devez être connecté !</font>";
                    return $this->msg;
                }
					foreach ($_POST as $value => $a) {
						if (substr($value, 0, 4) == "item"){
							$infos = explode("_",$value);
							if (isset($infos[1]) && strlen($infos[1])>0 && is_numeric($infos[1])){
								$qua = $_POST["qua_".$infos[1]];
								echo $qua;
								if ($qua > 0){
									$item = $this->lire("SELECT id,args,prix,vip FROM legium_boutique WHERE id=? LIMIT 0,1;", array($infos[1]),0);
									$id = $item['id'];
									if ($id == $infos[1] && $_SESSION['vip'] >= $item['vip']){
										$item_id = $item['args'];
										$compte = $this->lire("SELECT points FROM accounts WHERE guid=?;",array($_SESSION['guid']),0);
										$_SESSION['points'] = $compte['points'];
										if ($_SESSION['points']>=($item['prix']*$qua)){
											$requete = "INSERT INTO live_action(playerid,action,nombre,quantite) VALUES (?,?,?,?);";
											$points = $_SESSION['points']-($item['prix']*$qua);
											$_SESSION['points'] = $points;
											$live_action = array($_SESSION['perso'],21,$item_id,$qua);
											if ($this->add($requete, $live_action)){
												$this->add("INSERT INTO legium_historique(titre,args,date,compte,prix,personnage,quantite) VALUES (?,?,?,?,?,?,?);",array("Item",$item_id,date("H:i d/m/Y",time()),$_SESSION['guid'],($item['prix']*$qua),$_SESSION['perso'],$qua));
												$this->add("UPDATE accounts SET points=? WHERE guid=?;", array($points,$_SESSION['guid']));
												$this->msg = "<font color='green'>Votre achat vous a été envoyé !</font></br><meta http-equiv='refresh' content='5; ".WEBROOT."'>Refresh en cours veuillez patienter 5 secondes.";
											}
										}else{
											$this->msg = "<font color='red'>Vous n'avez pas assez de point !</font>";
										}
									}
								}else{
									$this->msg = "<font color='red'>Vous n'avez pas indiquer une quantité !</font>";
								}
							}
						}
					}
					$_SESSION['perso'] = null;
            }else{
                $this->msg = "<font color='red'>Veuillez suivre les instructions !</font>";
            }
        }catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
        return $this->msg;
    }
    function getPersonnages(){
        $this->open();
        try{
            $requete = "SELECT guid,name FROM personnages WHERE account=?;";
            if ($this->nombre($requete,array($_SESSION['guid'])) >= 1){
                $donne = $this->lire($requete,array($_SESSION['guid']));
                if (isset($donne) && $donne != null){
                    return $donne;
                }
            }
        }catch(PDOException $e){new Erreur($e->getMessage());return null;}catch(ErrorException $e){new Erreur($e->getMessage());return null;}
        return null;
    }
    function savePersonnage(){
        $this->open();
        $this->msg = "<font color='red'>Une erreure c'est produite !</font>";
        if (!isset($_POST['perso']) || !is_numeric($_POST['perso'])){
            $this->msg = "<font color='red'>Vous devez obligatoirement selectionner un personnage !</font>";
            return $this->msg;
        }
        try{
            $requete = "SELECT guid FROM personnages WHERE guid=? and account=? LIMIT 0,1;";
            if ($this->nombre($requete,array($_POST['perso'],$_SESSION['guid'])) == 1){
                $_SESSION['perso'] = $_POST['perso'];
                $this->msg = '<a href="'.WEBROOT.'boutique/shop/">Cliquer-ici pour aller a la page suivante.</a>';
            }else{
                $this->msg = "<font color='red'>Votre personnage n'a pas été trouvé !</font>";
            }
        }catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
        return $this->msg;
    }
    function KamasValide(){
        $this->open();
        $this->msg = "<font color='red'>Une erreure c'est produite !</font>";
        try{
            if (isset($_POST['valider'])){
                if ($this->nombre("SELECT guid FROM accounts WHERE guid=? and logged=0;",array($_SESSION['guid'])) == 1){
                    $this->msg = "<font color='red'>Vous devez être connecté !</font>";
                    return $this->msg;
                }
                foreach ($_POST as $value => $a) {
                    if (substr($value, 0, 5) == "kamas"){
                        $infos = explode("_",$value);
                        if (isset($infos[1]) && strlen($infos[1])>0 && is_numeric($infos[1])){
                            $item = $this->lire("SELECT id,args,prix FROM legium_boutique WHERE id=? LIMIT 0,1;", array($infos[1]),0);
                            $id = $item['id'];
                            if ($id == $infos[1]){
                                $kamas = $item['args'];
                                    $requete = "INSERT INTO live_action(playerid,action,nombre) VALUES (?,?,?);";
                                    $points = $_SESSION['points'];
									$verif = false;
                                    if ($id == $this->bourse_cado){
                                        if ($_SESSION['pack'] != 0 || $this->nombre("SELECT guid FROM accounts WHERE pack='1' and ip_register=?;", array($_SESSION['ip_register']))>0){
                                            if ($_SESSION['points']>=$item['prix']){
												$points -= $item['prix'];
											}else{
												$this->msg = "<font color='red'>Vous n'avez pas assez de point !</font>";
												return $this->msg;
											}
                                        }else{
                                            $this->add("UPDATE accounts SET pack='1' WHERE guid=?;",array($_SESSION['guid']));
                                            $_SESSION['pack'] = 1;
                                        }
                                    }else{
										if ($_SESSION['points']>=$item['prix']){
											$points -= $item['prix'];
										}else{
											$this->msg = "<font color='red'>Vous n'avez pas assez de point !</font>";
											return $this->msg;
										}
                                    }
                                    $_SESSION['points'] = $points;
                                    $live_action = array($_SESSION['perso'],3,$kamas);
                                    print_r($live_action);
                                    if ($this->add($requete, $live_action)){
                                        $this->add("INSERT INTO legium_historique(titre,args,date,compte,prix,personnage) VALUES (?,?,?,?,?,?);",array("Kamas",$kamas,date("H:i d/m/Y",time()),$_SESSION['guid'],$item['prix'],$_SESSION['perso']));
                                        $this->add("UPDATE accounts SET points=? WHERE guid=?;", array($points,$_SESSION['guid']));
                                        $this->msg = "<font color='green'>Votre bourse vous a été envoyé !</font></br><meta http-equiv='refresh' content='5; ".WEBROOT."'>Refresh en cours veuillez patienter 5 secondes.";
                                    }
                            }
                        }
                    }
                }
                $_SESSION['perso'] = null;
            }else{
                $this->msg = "<font color='red'>Vous devez suivre les instructions !</font>";
            }
        }catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
    return $this->msg;       
    }
	function getSexePerso(){
		$this->open();
		try{
			$requete = "SELECT sexe FROM personnages WHERE guid=? and account=? LIMIT 0,1;";
            if ($this->nombre($requete,array($_SESSION['perso'],$_SESSION['guid'])) == 1){
				$perso = $this->lire($requete,array($_SESSION['perso'],$_SESSION['guid']),0);
				return $perso['sexe'];
            }
		return null;
		}catch(PDOException $e){new Erreur($e->getMessage());return null;}catch(ErrorException $e){new Erreur($e->getMessage());return null;}
	}
	function ChangerDeSexe(){
	    $this->open();
        $this->msg = "<font color='red'>Une erreure c'est produite !</font>";
		try{
			$sexe = $this->getSexePerso();
			if ($sexe==null)return $this->msg;
			if ($sexe==1){
				$sexe = 0;
			}else{
				$sexe = 1;
			}
			$compte = $this->lire("SELECT points FROM accounts WHERE guid=?;",array($_SESSION['guid']),0);
			$_SESSION['points'] = $compte['points'];
			if ($_SESSION['points']>=$this->change_sexe){
				if ($this->nombre("SELECT guid FROM accounts WHERE guid=? and logged=1;",array($_SESSION['guid'])) == 1){
                    $this->msg = "<font color='red'>Vous devez être déconnecté !</font>";
					return $this->msg;
                }
				$points = $_SESSION['points'] - $this->change_sexe;
				$_SESSION['points'] = $points;
				$requete = "UPDATE personnages SET sexe=? WHERE guid=? and account=?;";
				$verif = $this->add($requete,array($sexe,$_SESSION['perso'],$_SESSION['guid']));
				if ($verif){
					$this->add("INSERT INTO legium_historique(titre,args,date,compte,prix,personnage) VALUES (?,?,?,?,?,?);",array("Sexe",($sexe==1?"Femelle":"Mal"),date("H:i d/m/Y",time()),$_SESSION['guid'],$this->change_sexe,$_SESSION['perso']));
					$requete = "UPDATE accounts SET points=? WHERE guid=?;";
					$this->add($requete,array($points,$_SESSION['guid']));
					$_SESSION['perso'] = null;
					$this->msg = "<font color='green'>Votre sexe a bien étais changer !</font>";
				}
			}else{
				$this->msg = "<font color='red'>Vous n'avez pas asser de points !</font>";
			}
			return $this->msg;
		}catch(PDOException $e){new Erreur($e->getMessage());return $this->msg;}catch(ErrorException $e){new Erreur($e->getMessage());return $this->msg;}
	}
}
?>
