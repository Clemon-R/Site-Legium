<div class="conteneur">
<center>Change de titre tu vera sa sera mieux pour toi !</center>
</div>
<form method="POST" action="">
<table id="table">
	<tr>
		<th width="10%">#</th>
		<th width="70%">Titre</th>
		<th width="20%">Prix</th>
	</tr>
	<?php
	foreach ($value as $i => $titre){
	?>
	<tr>
		<td><input type="radio" name="titre" value="<?php echo $titre['args']; ?>"/></td>
		<td><?php echo $titre['titre']; ?></td>
		<td><?php echo $titre['prix']; ?></td>
	</tr>
	<?php
	}
	?>
</table>
<center><input id="submit" type="submit" value="Valider" name="valider"/></center>
</form>