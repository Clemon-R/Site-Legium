<div class="conteneur">
<table frame="void" rules="rows" class="table">
    <tr class="header">
        <th>#</th>
        <th>Joueur</th>
        <th>Classe/Sexe</th>
        <th>Alignement</th>
        <th>Honneur</th>
    </tr>
    <?php
    $position = 1;
    for ($i = 0, $size = count($liste); $i < $size; ++$i) {
    $value = $liste[$i];
    ?>
    <tr class="contenu">
        <td><?php echo $position; ?></td>
        <td><?php echo $value['name']; ?></td>
        <td><img src="<?php echo WEBROOT; ?>theme/officiel/img/infos/class/<?php echo getSexeClasse($value['sexe'],$value['class']);?>.png"/></td>
        <th><img class="alignement" style="border-radius: 5px;" src="<?php echo WEBROOT; ?>theme/officiel/img/infos/alignement/<?php echo getAlignement($value['alignement']); ?>.png"/></th>
        <td><?php echo $value['honor']; ?></td>
    </tr>
    <?php $position++; } ?>
</table>
</div>