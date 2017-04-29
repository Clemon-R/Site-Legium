<div class="conteneur">
<table frame="void" rules="rows" class="table">
    <tr class="header">
        <th>#</th>
        <th>Pseudo</th>
        <th>V.I.P</th>
        <th>Statut</th>
        <th>Vote</th>
    </tr>
    <?php
    $position = 1;
    for ($i = 0, $size = count($liste); $i < $size; ++$i) {
    $value = $liste[$i];
    ?>
    <tr class="contenu">
        <td><?php echo $position; ?></td>
        <td><?php echo (strlen($value['pseudo'])==0)?"Aucun":$value['pseudo']; ?></td>
        <td><?php echo ($value['vip'] == 1)?"<font color='red'>V.I.P</font>":"Joueurs"; ?></td>
        <td><?php echo ($value['logged'] == 1)?"<font color='green'>En ligne</font>":"<font color='red'>Hors ligne</font>"; ?></td>
        <td><?php echo $value['vote']; ?></td>
    </tr>
    <?php $position++; } ?>
</table>
</div>