<div class="conteneur">
    <p class="page">Choisissez le pnj qui vend votre item</p>
    <center><img src="<?php echo WEBROOT; ?>theme/officiel/img/barre.png"/></center>
    <table frame="void" rules="rows" class="table">
        <?php 
        for ($a = 0;$a < count($liste);$a++){
            $value = $liste[$a];
        ?>
        <tr class="header"><td><a href="<?php echo WEBROOT; ?>boutique/itemjp/<?php echo $value['id']; ?>/"><?php echo $value['titre']; ?></a></td></tr>
        <?php
        }
        ?>
    </table>
</div>
