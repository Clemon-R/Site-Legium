<center>
<form autocomplete="off" method="POST" action="">
<fieldset style="width: 90%;border-radius: 5px;">	
    <legend align="top"><b>Votre E-mail</b></legend>
	<table style='border:none;'>
	<tr>
		<td colspan="2" class="description"><font color="grey"><em>Le Support répondra a votre message sur Cette Email</em></font></td>
	</tr>
	<tr>
		<td><input id="text" type="text" value="<?php echo $compte['email'];?>" size="25" disabled="disabled"></td>
	</tr>
	</table>
</fieldset>
<br />
<br />
<fieldset style="width: 90%;border-radius: 5px;">	
    <legend align="top"><b>Votre Nom de Compte</b></legend>	     
	<table style='border:none;'>
	<tr>
		<td colspan="2" class="description"><font color="grey"><em>Vôtre Nom de compte Servira au support afin de vous reperer</em></font></td>
	</tr>
	<tr>
		<td><input id="text" type="text" value="<?php echo $compte['account'];?>" size="25" disabled="disabled"></td>
	</tr>
	</table>
</fieldset>
<br />
<br />
<fieldset style="width: 90%;border-radius: 5px;">	
    <legend align="top"><b>Votre Personnage Principal</b></legend>	     
	<table style='border:none;'>
	<tr>
		<td colspan="2" class="description"><font color="grey"><em>Entrez le Nom du Personage que Nous pourrons contacter En Jeu</em></font></td>
	</tr>
	<tr>
		<center><td width="45%">
                        <select id="text" name="perso" size="1" required>
                            <?php
                            $first = true;
                            foreach ($compte['perso'] as $key => $value) {
                            ?>
                            <OPTION value="<?php echo $value['guid'];?>" <?php echo ($first)?"selected":""?>><?php echo $value['name'];?>
                            <?php } ?>
                        </select>
                    </td></center>
	</tr>
	</table>
</fieldset>
<br />
<br />
<fieldset style="width: 90%;border-radius: 5px;">	
    <legend align="top"><b>Le Sujet</b></legend>	     
	<table style='border:none;'>
	<tr>
		<td colspan="2" class="description"><font color="grey"><em>Entrez le Sujet de Votre message Ici. Soyez le Plus Claire possible !</em></font></td>
	</tr>
	<tr>
		<center><td width="45%"><input id="text" type="text" name="sujet" value="" required/></td></center>
	</tr>
	</table>
</fieldset>
<fieldset style="width: 90%;border-radius: 5px;">	
    <legend align="top"><b>Votre Message</b></legend>	     
	<table style='border:none;'>
	<tr>
		<td colspan="2" class="description"><font color="grey"><em>Entrez Vôtre message Ici. Soyez le Plus Claire possible !</em></font></td>
	</tr>
	<tr>
		<td><textarea id="text" style='resize: none;' type="text"  rows="8" cols="50" name="message" required></textarea></td>
	</tr>
	</table>
</fieldset>
</br>
	<center><input id="submit" type="submit" name="envoyer" value="Envoyer Mon Message Au Support"/></center>
</form>
</br>
</br>
<fieldset style="width: 90%;border-radius: 5px;">
  <legend align="top" style="color:#a70000">Information</legend>
<center>
	<p style="color:white">Le Support est destiné a tout problèmes lié aux comptes et aux achats et au Rapports de Bugs.
</br>
	Pour les dépositions de plaintes, C'est sur le forum et dans la catégorie adéquate.</p>
</center>
</fieldset>
</center>