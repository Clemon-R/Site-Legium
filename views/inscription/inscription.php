<center>
<form autocomplete="off" action="" method="POST"> 
<fieldset style="width: 90%;border-radius: 5px;">
<legend align="top"><b>Informations d'utilisateur</b></legend>
<table style="border: none;">
    <tr>
      <td style="color: white;">Nom de Compte</td><td><input placeholder="EX : Clemon" id="text" name="username" type="text"  required /></td>
    </tr>
    <tr>
            <td colspan="2" class="description"><font color="grey"><em>Entrez ici le Nom De Compte que vous souhaitez utiliser pour vous connectez en jeu et sur le site.(4 � 30 caract�res)</em></font>
            <br />
            <br/>
            </td>
    </tr>
    <tr>
      <td style="color: white;">Pseudo</td><td><input placeholder="EX : Clemon" id="text" name="pseudo" type="text" required /></td>
    </tr>
    <tr><td colspan="2" class="description"><font color="grey"><em>Entrez ici le pseudo qui sera affich� en jeu et sur le site.(4 � 30 caract�res)</em></font><br /><br/></td></tr>

    <tr>
      <td style="color: white;">V�tre Adresse E-mail</td><td><input placeholder="EX : Clemon@hotmail.fr" id="text" name="email" type="email" required /></td>
    </tr>
    <tr><td colspan="2" class="description"><font color="grey"><em>/!\ L'adresse Mail servira pour n'importe quel changement d'information du compte afin d'augmenter la s�curit� de v�tre compte/!\ (3 � 100 caract�res)</em></font>
    </td>
    </tr>
</table>
</fieldset>
<br/>
<fieldset style="width: 90%;border-radius: 5px;">
<legend align="top"><b>Authentification</b></legend>
<table style="border: none;">
    <tr>
            <td style="color: white;">Mot de passe</td><td><input placeholder="EX : 12345678" id="text" name="pass" type="password" required /></td>
    </tr>
    <tr>
            <td style="color: white;">Mot de passe (retappez votre mot de passe)</td><td><input placeholder="EX : 12345678" id="text" name="pass_conf" type="password"  required /></td>
    </tr>
    <tr><td colspan="2" class="description"><font color="grey"><em>Entrez ici le mot de passe que vous souhaitez utiliser pour vous connectez en jeu et sur le site.(4 � 50 caract�res)</em></font>
</td></tr>
</table>
</fieldset>
<br/>
<fieldset style="width: 90%;border-radius: 5px;">
<legend align="top"><b>Question et R�ponse secr�te</b></legend>
<table style="border: none;">
    <tr>
            <td style="color: white;">Question secr�te</td><td><input placeholder="EX : Is my web ?" id="text" name="question" type="texte" required /></td>
    </tr>
    <tr>
            <td style="color: white;">Reponse secr�te</td><td><input placeholder="EX : yes" id="text" name="reponse" type="texte" required /></td>
    </tr>
    <tr>
            <td style="color: white;">R�ponse secr�te(Retapez v�tre R�ponse secr�te)</td><td><input placeholder="EX : yes" id="text" name="reponse_conf" type="texte"  required /></td>
    </tr>
    <tr><td colspan="2" class="description"><font color="grey"><em>Entrez ici V�tre question et v�tre R�ponse secr�te.(3 � 100 caract�res)</em></font>
</td></tr>
</table>
</fieldset>
<br/>
<fieldset style="width: 90%;border-radius: 5px;">
<table style="border: none;">
    <tr>
            <td><img src="<?php echo WEBROOT; ?>theme/officiel/img/reload.png" alt="Recharger l'image" title="Recharger l'image" style="cursor:pointer;" onclick="document.captcha2.src='<?php echo WEBROOT; ?>core/modules/captcha.php'" /><img name="captcha2" src="<?php echo WEBROOT; ?>core/modules/captcha.php" alt="Captcha" /></td>
            <td><input id="text" value="" name="captcha" type="text" placeholder="Entrer le code" required/></td>
    </tr>
</table>
</fieldset>
</br>
<fieldset style="width: 90%;border-radius: 5px;">
<table style="border: none;">
    <tr>
            <center><td style="color: white;"><input type="radio" name="validcgu"/> J'ai l� le <a href="<?php echo WEBROOT; ?>cgu/"><b>r�glement</b></a> et je m'engage � le respecter.</td></td></center>
    </tr>
</table>
</fieldset>
<br/>
    <center><input id="submit" name="valide_inscription" type="submit" value="Je M'inscris !"/></center>
</form>
</center>