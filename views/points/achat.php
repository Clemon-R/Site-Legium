<script>
var max=8;
function compter(f) {
	var txt=f.value;
	var nb=txt.length;
	if (nb>max) { 
		alert("Pas plus de "+max+" caractères dans ce champ.");
		f.value=txt.substring(0,max);
		nb=max;
	}
}
</script>
<center>
    Attendre le chargement complet des script !</br>
    Si vous achetez un abonnement, vous pourrez bénéficier plus rapidement de la boutique. </br>
	Si vous achetez un code, vous recevrez <?php echo $this->points_achat; ?> points ou <?php echo $this->points_achat_vip; ?> points pour V.I.P. </br>
    </br>

<div id='starpass_<?php echo $this->idd; ?>'></div><script type='text/javascript' src='http://script.starpass.fr/script.php?idd=<?php echo $this->idd; ?>&amp;hidecodeform=1&amp;datas='></script><noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br /><a href='http://www.starpass.fr/'>Micropaiement StarPass</a></noscript></br>
<form autocomplete="off" method="POST" action="<?php echo WEBROOT."points/check/"; ?>">
    <input id="text" type="text" name="code1" placeholder="Entrer ici votre code" value="" onkeypress="compter(this)" required/>
    <input id="submit" type="submit" name="valider" value="Envoyer"/>
</form>
</center>