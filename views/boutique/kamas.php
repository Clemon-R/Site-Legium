<div class="conteneur">
    <p class="page">Choisisser votre bourse</p>
    <center><img src="<?php echo WEBROOT; ?>theme/officiel/img/barre.png"/></center>
    <form autocomplete="off" method="POST" action="<?php echo WEBROOT; ?>boutique/kamas/check/">
        <table frame="void" rules="rows">
            <tr class="header">
                <th>#</th>
                <th>Kamas</th>
                <th>Prix</th>
            </tr>
            <?php
            for ($a = 0;$a < count($liste);$a++){
            $value = $liste[$a];
            ?>
            <tr class="contenu">
                <td style="width:10%"><input type="checkbox" name="kamas_<?php echo $value['id']; ?>" value=""/></td>
                <td style="width:70%"><?php echo $value['titre']; ?></td>
                <td style="width:20%"><?php echo $value['prix']; ?> <?php echo ($value['id']==$this->bourse_cado)?"(Gratuit sur premier venu)":""; ?></td>
            </tr>
            <?php } ?>
        </table>
        <center><input id="submit" type="submit" name="valider" value="Valider"/></center>
    </form>
</div>