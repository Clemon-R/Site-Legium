<center>
<font color="red">
Quand vous acheter quoi que se soit !</br>
Vous devez êtres apsolument déconnecter est pas juste dans le menu du choix du personnage !</br>
Sinon vous ne recevrez pas par exemple votre tite !</br>
(Si cela vous arriver vous ne serrez pas rembourser)</br>
</font>
</Center>
<div class="conteneur">
    <p class="page">Choisisser votre personnage</p>
    <center><img src="<?php echo WEBROOT; ?>theme/officiel/img/barre.png"/></center>
    <form method="POST" action="<?php echo WEBROOT; ?>boutique/">
        <table frame="void" rules="rows">
                <tr class="header">
                    <th>#</th>
                    <th>Nom du personnage</th>
               </tr>
                <?php
                for ($a=0;$a<count($liste);$a++){
                $value = $liste[$a];
                ?>
                <tr class="contenu">
                    <td><input type="radio" name="perso" value="<?php echo $value['guid']; ?>"/></td>
                    <td><?php echo $value['name']; ?></td>
                </tr>
                <?php } ?>
        </table>
        <center><input id="submit" type="submit" name="valider" value="Valider"/></center>
    </form>
</div>