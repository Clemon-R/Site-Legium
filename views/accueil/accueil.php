<?php
for ($i = 0, $size = count($news); $i < $size; ++$i) {
$infos = $news[$i];
    try{
        if (!isset($infos['type']) || $infos['type'] == "" || !isset($infos['titre']) || $infos['titre'] == "" || !isset($infos['message']) || $infos['message'] == ""){
            continue;
        }
        $image = isset($infos['img']) && $infos['img'] != '' && file_exists(WEBROOT.'theme/officiel/img/contenu/avatar/'.$infos['img'].'.png') ? '<img src="'.WEBROOT.'theme/officiel/img/contenu/avatar/'.$infos['img'].'.png"/>' : '';
        $color = isset($infos['color']) && $infos['color'] != '' ? " color='".$infos['color']."'" : "";
        echo "<div class='news'>".$image."<font".$color."><b>".$infos['type'] ." :</b></font> ".$infos['titre']."</div>";
        echo $infos['message']; 
    } catch (Exception $e){continue;}
}
?>