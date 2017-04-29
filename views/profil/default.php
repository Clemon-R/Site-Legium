<div class="conteneur">
    <p class="page">Générale</p>
    <img src="<?php echo WEBROOT; ?>theme/officiel/img/barre.png"/>
    <table id="table" frame="void" rules="all">
		<tr>
			<th>Nom de compte : </th>
			<td><input id="text-sizable" type="text" value="<?php echo (isset($compte['account'])?$compte['account']:"Inconnu");?>" disabled="disabled"></td>
		</tr>
		<tr>
			<th>E-Mail : </th>
			<td><input id="text-sizable" type="text" value="<?php echo (isset($compte['email'])?$compte['email']:"Inconnu");?>" disabled="disabled"></td>
		</tr>
		<tr>
			<th>Pseudo : </th>
			<td><input id="text-sizable" type="text" value="<?php echo (isset($compte['pseudo'])?$compte['pseudo']:"Inconnu");?>" disabled="disabled"></td>
		</tr>
		<tr>
			<th>Rang : </th>
			<td><input id="text-sizable" <?php echo (isset($compte['level']) && $compte['level'] > 0 ?"style='color:red;'":(isset($compte['vip']) && $compte['vip'] == 1?"style='color:green;'":""));?> type="text" value="<?php echo (isset($compte['level']) && $compte['level'] > 0 ?"Staff":(isset($compte['vip']) && $compte['vip'] == 1?"V.I.P":"Joueur"));?>" disabled="disabled"></td>
		</tr>
		<tr>
			<th>Points : </th>
			<td><input id="text-sizable" type="text" value="<?php echo (isset($compte['points'])?$compte['points']:"0");?>" disabled="disabled"></td>
		</tr>
		<tr>
			<th>Nombre de votes : </th>
			<td><input id="text-sizable" type="text" value="<?php echo (isset($compte['vote'])?$compte['vote']:"0");?>" disabled="disabled"></td>
		</tr>
	</table>
	<img src="<?php echo WEBROOT; ?>theme/officiel/img/barre.png"/>
	<p class="page">Modifier mon mot de passe ?</p>
    <img src="<?php echo WEBROOT; ?>theme/officiel/img/barre.png"/>
	<form method="POST" action="" autocomplete="off">
		<table id="table" frame="void" rules="all">
			<tr>
				<td>Mot de passe (Actuel)</td>
				<td><input name="mdp_act" id="text-sizable" type="password" placeholder="Ex : Test" required></td>
			</tr>
			<tr>
				<td>Nouveau Mot de passe</td>
				<td><input name="new_mdp" id="text-sizable" type="password" placeholder="Ex : Test2" required></td>
			</tr>
			<tr>
				<td>Nouveau Mot de passe (Confirmer)</td>
				<td><input name="new_mdp_conf" id="text-sizable" type="password" placeholder="Ex : Test2" required></td>
			</tr>
			<tr>
				<td><?php echo (isset($compte['question'])?$compte['question']:"Inconnu");?></td>
				<td><input name="reponse" id="text-sizable" type="text" placeholder="Ex : Non" required></td>
			</tr>
		</table>
		<table id="table" frame="void" rules="all" style="margin-top:-1px;">
			<tr>
				<td><input id="submit" type="submit" name="valider" value="Modifier"></td>
			</tr>
		</table>
	</form>
</div>