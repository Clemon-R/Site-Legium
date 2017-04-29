<div class="conteneur">
<table frame="void" rules="rows" class="table">
    <tr class="header">
        <th>#</th>
        <th>Joueur</th>
        <th>Prestige</th>
        <th>Classe/Sexe</th>
    </tr>
    <?php
    $position = 1;
    for ($i = 0, $size = count($liste); $i < $size; ++$i) {
    $value = $liste[$i];
    ?>
    <tr class="contenu">
        <td><?php echo $position; ?></td>
        <td><?php echo $value['name']; ?></td>
        <td><?php echo $value['prestige']; ?></td>
        <td><img src="<?php echo WEBROOT; ?>theme/officiel/img/infos/class/<?php echo getSexeClasse($value['sexe'],$value['class']);?>.png"/></td>
    </tr>
    <?php $position++; } ?>
</table>
</div>