<?php
function verif_var($var){
    if (isset($var) && $var != ""){
        return true;
    }else{
        return false;
    }
}
function getAlignement($var){
    $type = "";
    if (is_numeric($var)){
        switch ($var){
           case 0:
               $type = "neutre";
               break;
           case 1:
               $type = "bontarien";
               break;
           case 2:
               $type = "brakmarien";
               break;
           case 3:
               $type = "mercenaire";
               break;
        }
        return $type;
    }
}
function base_url(){
  $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
  $protocol = $protocol . "://" . $_SERVER['HTTP_HOST'];
  return $protocol."/";
}
function getSexeClasse($sexe,$class){
    if (is_numeric($sexe) && is_numeric($class)){
        $s = "";
        switch ($sexe) {
            case 0:
                $s = "m";
                break;
            case 1:
                $s = "f";
                break;
        }
        $c = "";
        switch ($class) {
            case 1:
                $c = "feca";
                break;
            case 2:
                $c = "osamodas";
                break;
            case 3:
                $c = "enutrof";
                break;
            case 4:
                $c = "sram";
                break;
            case 5:
                $c = "xelor";
                break;
            case 6:
                $c = "ecaflip";
                break;
            case 7:
                $c = "eniripsa";
                break;
            case 8:
                $c = "iop";
                break;
            case 9:
                $c = "cra";
                break;
            case 10:
                $c = "sadida";
                break;
            case 11:
                $c = "sacrieur";
                break;
            case 12:
                $c = "pandawa";
                break;
            case 13:
                $c = "zob";
                break;
            default:return "Inconnu";
        }
        $type = $c."_".$s;
        return $type;
    }
}
function IsOnligne($ip,$port){
    try{
        $connec = @fsockopen($ip,$port);
        @fclose($connec);
        if(!$connec){
            return false;
        }else{
            return true; 
        }
    }catch(ErrorException $e ){new Erreur($e->getMessage());return false;}catch(Exception $e ){new Erreur($e->getMessage());return false;}
}
function ResetArray($param){
    $new_param = array();
    $a = 0;
    $nbr=$max=count($param);
    while ($a < $nbr && count($new_param) != $max){
        if (!isset($param[$a])){
            $nbr++;
        }else{
            if (strlen($param[$a])<=0){
                $max--;
            }else{
                array_push($new_param, $param[$a]);
            }
        }
        $a++;
    }
    return $new_param;
}
function converType($type, $a){
$t = hexdec($type);
$liste = "";
$valeur = "";
if (strpos($a, 'd') !== FALSE){
	$min = 0;
	$max = 0;
	$infos0 = explode("d",$a);
	$infos1 = explode("+",$infos0[1]);
	$min = $infos0[0]+$infos1[1];
	$max = $infos0[0]*$infos0[1]+$infos1[1];
	if ($min == $max){
		$valeur = $max;
	}else{
		$valeur = $min." à ".$max;
	}
}else{
    $valeur = $a;
	}
	switch ($t){
		case 78:
		$liste = "+".$valeur." Point(s) de mouvement(s)";
		return $liste;
		case 91:
		$liste = "Vol de vie : ".$valeur." (Eau)";
		return $liste;
		case 92:
		$liste = "Vol de vie : ".$valeur." (Terre)";
		return $liste;
		case 93:
		$liste = "Vol de vie : ".$valeur." (Air)";
		return $liste;
		case 94:
		$liste = "Vol de vie : ".$valeur." (Feu)";
		return $liste;
		case 95:
		$liste = "Vol de vie : ".$valeur." (Neutre)";
		return $liste;
		case 96:
		$liste = "Dommages : ".$valeur." (Eau)";
		return $liste;
		case 97:
		$liste = "Dommages : ".$valeur." (Terre)";
		return $liste;
		case 98:
		$liste = "Dommages : ".$valeur." (Air)";
		return $liste;
		case 99:
		$liste = "Dommages : ".$valeur." (Feu)";
		return $liste;
		case 100:
		$liste = "Dommages : ".$valeur." (Neutre)";
		return $liste;
		case 101:
		$liste = "Retrait ".$valeur." Points d'actions";
		return $liste;
		case 110:
		$liste = "+".$valeur." Vitalité";
		return $liste;
		case 111:
		$liste = "+".$valeur." Point(s) d'action(s)";
		return $liste;
		case 112:
		$liste = "+".$valeur." Dommages";
		return $liste;
		case 114:
		$liste = $valeur." Dommage * 2";
		return $liste;
		case 115:
		$liste = "+".$valeur." Coup Critiques";
		return $liste;
		case 116:
		$liste = "-".$valeur." Portée";
		return $liste;
		case 117:
		$liste = "+".$valeur." Portée";
		return $liste;
		case 118:
		$liste = "+".$valeur." Force";
		return $liste;
		case 119:
		$liste = "+".$valeur." Agilité";
		return $liste;
		case 120:
		$liste = "+".$valeur." Points d'actions";
		return $liste;
		case 122:
		$liste = "+".$valeur." Echec Critiques";
		return $liste;
		case 123:
		$liste = "+".$valeur." Chance";
		return $liste;
		case 124:
		$liste = "+".$valeur." Sagesse";
		return $liste;
		case 125:
		$liste = "+".$valeur." Vitalité";
		return $liste;
		case 126:
		$liste = "+".$valeur." Intelligence";
		return $liste;
		case 127:
		$liste = "-".$valeur." Point(s) de mouvement(s)";
		return $liste;
		case 128:
		$liste = "+".$valeur." Point(s) de mouvement(s)";
		return $liste;
		case 138:
		$liste = "+".$valeur." Puissance";
		return $liste;
		case 145:
		$liste = "-".$valeur." Dommage(s)";
		return $liste;
		case 152:
		$liste = "-".$valeur." Chance";
		return $liste;
		case 153:
		$liste = "-".$valeur." Vitalité";
		return $liste;
		case 154:
		$liste = "-".$valeur." Agilité";
		return $liste;
		case 155:
		$liste = "-".$valeur." Intelligence";
		return $liste;
		case 156:
		$liste = "-".$valeur." Sagesse";
		return $liste;
		case 157:
		$liste = "-".$valeur." Force";
		return $liste;
		case 158:
		$liste = "+".$valeur." Pods";
		return $liste;
		case 159:
		$liste = "-".$valeur." Pods";
		return $liste;
		case 160:
		$liste = "+".$valeur." % d'esquiver la perte de PA";
		return $liste;
		case 161:
		$liste = "+".$valeur." % d'esquiver la perte de PM";
		return $liste;
		case 162:
		$liste = "-".$valeur." % d'esquiver la perte de PA";
		return $liste;
		case 163:
		$liste = "-".$valeur." % d'esquiver la perte de Pm";
		return $liste;
		case 168:
		$liste = "-".$valeur." PA";
		return $liste;
		case 169:
		$liste = "-".$valeur." PM";
		return $liste;
		case 171:
		$liste = "-".$valeur." Coup Critiques";
		return $liste;
		case 174:
		$liste = "+".$valeur." Initiative";
		return $liste;
		case 175:
		$liste = "-".$valeur." Initiative";
		return $liste;
		case 176:
		$liste = "+".$valeur." Prospection";
		return $liste;
		case 177:
		$liste = "-".$valeur." Prospection";
		return $liste;
		case 178:
		$liste = "+".$valeur." Soin";
		return $liste;
		case 179:
		$liste = "-".$valeur." Soin";
		return $liste;
		case 182:
		$liste = "+".$valeur." Créature(s) Invocable(s)";
		return $liste;
		case 210:
		$liste = "+".$valeur." % Résistance Force";
		return $liste;
		case 211:
		$liste = "+".$valeur." % Résistance Chance";
		return $liste;
		case 212:
		$liste = "+".$valeur." % Résistance Agilité";
		return $liste;
		case 213:
		$liste = "+".$valeur." % Résistance Intelligence";
		return $liste;
		case 214:
		$liste = "+".$valeur." % Résistance Neutre";
		return $liste;
		case 215:
		$liste = "-".$valeur." % Résistance Force";
		return $liste;
		case 216:
		$liste = "-".$valeur." % Résistance Chance";
		return $liste;
		case 217:
		$liste = "-".$valeur." % Résistance Agilité";
		return $liste;
		case 218:
		$liste = "-".$valeur." % Résistance Intelligence";
		return $liste;
		case 219:
		$liste = "-".$valeur." % Résistance Neutre";
		return $liste;
		case 220:
		$liste = $valeur." Renvoie Dommages";
		return $liste;
		case 225:
		$liste = "+".$valeur." Dommages au piéges";
		return $liste;
		case 226:
		$liste = "+".$valeur." Puissance (Pièges)";
		return $liste;
		case 240:
		$liste = "+".$valeur." Résistances Force";
		return $liste;
		case 241:
		$liste = "+".$valeur." Résistances Chance";
		return $liste;
		case 242:
		$liste = "+".$valeur." Résistances Agilité";
		return $liste;
		case 243:
		$liste = "+".$valeur." Résistances Intelligence";
		return $liste;
		case 244:
		$liste = "+".$valeur." Résistances Neutre";
		return $liste;
		case 245:
		$liste = "-".$valeur." Résistances Force";
		return $liste;
		case 246:
		$liste = "-".$valeur." Résistances Chance";
		return $liste;
		case 247:
		$liste = "-".$valeur." Résistances Agilité";
		return $liste;
		case 248:
		$liste = "-".$valeur." Résistances Intelligence";
		return $liste;
		case 249:
		$liste = "-".$valeur." Résistances Neutre";
		return $liste;
		case 993:
		$liste = "Ajoute la capacité caméléone à votre monture";
		return $liste;
		case 977:
		$liste = "Incarnation : ".$valeur;
		break;
		default:$liste = "Inconnu";break;
	}
return $liste; 
}
function decryptStats($stat)
{
$liste_type = "";
	if ($stat != "")
	{
	$stats = explode(",", $stat);
	$a = 0;
		while ($a < count($stats))
		{
		$infos = explode("#",$stats[$a]);
		$type = $infos[0];
		$value = converType($type,$infos[4]);
		if (strlen($value)>0){
			$liste_type .= converType($type,$infos[4])."</br>";
		}
		$a++;
		}
	}
	return $liste_type;
}
function get_ip() {
	// IP si internet partagé
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	// IP derrière un proxy
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	// Sinon : IP normale
	else {
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}
function is_stringbase(){
    $args = func_get_args();
    foreach ($args as $key => $chaine) {
        if (!ctype_alnum($chaine)){
            return false;
        }
    }
    return true;
}
function is_alpha(){
    $args = func_get_args();
    foreach ($args as $key => $chaine) {
        if (!preg_match("#^[\w.-]+$#", $chaine)){
            return false;
        }
    }
    return true;
}
?>
