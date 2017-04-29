<div class="conteneur">
    <p class="page">Choisisser votre item</p>
    <center><img src="<?php echo WEBROOT; ?>theme/officiel/img/barre.png"/></center>
    <form autocomplete="off" method="POST" action="<?php echo WEBROOT; ?>boutique/item/<?php echo $id; ?>/check/">
        <table frame="void" rules="rows">
            <tr class="header">
                <th style="width:5%">#</th>
                <th style="width:35%">Nom de l'item</th>
                <th style="width:35%">Stats</th>
                <th style="width:10%">Prix</th>
				<th>Quantité</th>
            </tr>
            <?php
			if (count($liste) > 0){
            foreach ($liste as $i => $value){
			if ($_SESSION['vip'] < $value['vip']){
				continue;
			}
            ?>
            <tr class="contenu">
                <td><input type="checkbox" name="item_<?php echo $value['id']; ?>" value=""/></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo decryptStats($value['statsTemplate']); ?></td>
                <td><?php echo $value['prix']; ?></td>
				<td><input style="width: 50px;text-align: right;" type="text" name="qua_<?php echo $value['id']; ?>" value="1" required/></td>
            </tr>
            <?php } }?>
        </table>
        <center><input id="submit" type="submit" name="valider" value="Valider"/></center>
    </form>
</div>