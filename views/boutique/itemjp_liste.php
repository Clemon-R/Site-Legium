<center>Pour avoir plus d'informations sur les items, connectez-vous en jeu.</center>
<div class="conteneur">
    <p class="page">Choisisser votre item</p>
    <center><img src="<?php echo WEBROOT; ?>theme/officiel/img/barre.png"/></center>
    <form autocomplete="off" method="POST" action="<?php echo WEBROOT; ?>boutique/itemjp/<?php echo $id; ?>/check/">
        <table frame="void" rules="rows">
            <tr class="header">
                <th>#</th>
                <th>Nom de l'item</th>
                <th>Stats</th>
                <th>Prix</th>
            <?php
            for ($a = 0;$a < count($liste);$a++){
            $value = $liste[$a];
            ?>
            <tr class="contenu">
                <td><input type="checkbox" name="item_<?php echo $value['id']; ?>" value=""/></td>
                <td style="text-align:top;"><?php echo $value['name']; ?></td>
                <td><?php echo decryptStats($value['statsTemplate']); ?></td>
                <td>150 Points</td>
            </tr>
            <?php } ?>
        </table>
        <center><input id="submit" type="submit" name="valider" value="Valider"/></center>
    </form>
</div>
