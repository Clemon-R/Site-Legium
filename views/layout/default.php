<?php
function getmicrotime(){
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}
$debut = getmicrotime();
?>
<!DOCTYPE html>
<html>
    <head>
            <title><?php echo $this->titre ?> - <?php echo $titre; ?></title>
            <link href="<?php echo WEBROOT; ?>theme/officiel/css/style.css" rel="stylesheet" type="text/css"/>
			<script type="text/javascript" src="<?php echo WEBROOT; ?>theme/officiel/js/popup.js"></script>
            <link rel="Shortcut Icon" type="image/png" href="<?php echo WEBROOT; ?>theme/officiel/img/favicon.png">
			<div id="vote_popup">
				<div class="msg">
					<span class="text"><strong>Bienvenu Sur <?php echo $this->titre ?></strong></span>
					<br>
					<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $this->facebook; ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px; margin-left: 240px; margin-right: auto;" allowTransparency="true"></iframe>
					<br>
					<br>
					<span style="color: white; font-size: small;">Il est possible de jouer sur site !</span>
					<p><a onclick="hide_voted_popup();" href="<?php echo $this->rpg_vote; ?>" target="_new"> <img style="border-color:" title="Clique pour voter pour <?php echo $this->titre; ?>" src="<?php echo WEBROOT; ?>theme/officiel/img/img_vote.png" border="0" alt="" /> </a><br /> <br /><span onclick="hide_vote_popup();"> <span class="msg_neg"> <span class="text">Je ne souhaite pas voter pour <?php echo $this->titre ?> !</span> </span> </span></p>
				</div>
			</div>
			<a href="<?php echo WEBROOT; ?>core/modules/anti_aspirateur.php"></a>
    </head>
    <header>
            <a href="<?php echo WEBROOT; ?>"><img style="margin-top:30px;" src="<?php echo WEBROOT; ?>theme/officiel/img/logo.png"/></a>
    </header>
    <body>
    <div id="contenu">
    <div class="haut"></div>
    <div class="fond">
    <div id="menu">
        <div class="module_connexion">
            <?php
            if (!isset($_SESSION['login'])){
            ?>
            <center>
                <form autocomplete="off" action="<?php echo WEBROOT; ?>connexion/login/" method="POST">
                Nom de compte</br>
                <input name="login" type="text" placeholder="Nom de compte" required/></br>
                Mot de passe</br>
                <input name="pass" type="password" placeholder="Mot de passe" required/></br>
                <a href="<?php echo WEBROOT; ?>oublie/">Mot de passe oublié ?</a></br>
                <input class="connexion" name="connexion" type="submit" value=""/>
                </form>
            </center>
            <?php
            }else{
            ?>
            <center>
				<a title="Acheter des points" href="<?php echo WEBROOT; ?>points/">Acheter des points</a></br>
				<?php
				if (!isset($_SESSION['vip']) || $_SESSION['vip'] == 0){
				?>
				<a title="Devenir V.I.P" href="<?php echo WEBROOT; ?>vip/">Devenir V.I.P</a></br>
				<?php } ?>
				<a href="<?php echo WEBROOT; ?>profil/">Mon Profil</a></br>
				</br>
                <a href="<?php echo WEBROOT; ?>connexion/logout/"><button class="deconnexion"></button></a>
            </center>
            <?php } ?>
        </div>
        <a href="<?php echo WEBROOT; ?>vote/"><div class="vote"></div></a>
        <a href="<?php echo WEBROOT; ?>boutique/"><div class="boutique"></div></a>
        <div class="sous_menu">
		
            <div style="background: url('<?php echo WEBROOT; ?>theme/officiel/img/menu/titre/mon_compte.png');" class="titre"></div>
            <?php
            if (isset($_SESSION['login'])){
            ?>
            <a href="<?php echo WEBROOT; ?>points/"><div class="rubrique">Acheter des points</div></a>
			<?php
			if (!isset($_SESSION['vip']) || $_SESSION['vip'] == 0){
			?>
			<a href="<?php echo WEBROOT; ?>vip/"><div class="rubrique">Devenir V.I.P</div></a>
            <?php }}else{ ?>
            <a href="<?php echo WEBROOT; ?>inscription/"><div class="rubrique">Créer un compte</div></a>
	         <?php } ?>
		
            <div style="background: url('<?php echo WEBROOT; ?>theme/officiel/img/menu/titre/communaute.png');" class="titre"></div>
            <a href="<?php echo WEBROOT; ?>news/"><div class="rubrique">Accueil</div></a>
			<a href="<?php echo base_url(); ?>forum/"><div class="rubrique">Forum</div></a>
			<a href="<?php echo WEBROOT; ?>staff/"><div class="rubrique">Staff</div></a>
            <a href="<?php echo WEBROOT; ?>rejoindre/"><div class="rubrique">Nous Rejoindre</div></a>
			<a href="<?php echo WEBROOT; ?>information/"><div class="rubrique">Informations</div></a>
			<a href="http://updaterowny.alwaysdata.net/client/"><div class="rubrique">Jouer en ligne</div></a>
			<div style="background: url('<?php echo WEBROOT; ?>theme/officiel/img/menu/titre/classements.png');" class="titre"></div>
            <a href="<?php echo WEBROOT; ?>classement/joueurs/"><div class="rubrique">Top "Joueurs"</div></a>
            <a href="<?php echo WEBROOT; ?>classement/prestige/"><div class="rubrique">Top "Prestige"</div></a>
            <a href="<?php echo WEBROOT; ?>classement/pvp/"><div class="rubrique">Top "Pvp"</div></a>
            <a href="<?php echo WEBROOT; ?>classement/guildes/"><div class="rubrique">Top "Guildes"</div></a>
            <a href="<?php echo WEBROOT; ?>classement/votes/"><div class="rubrique">Top "Voteurs"</div></a>
			
            <div style="background: url('<?php echo WEBROOT; ?>theme/officiel/img/menu/titre/admnistration.png');" class="titre"></div>
            <a href="<?php echo WEBROOT; ?>cgu/"><div class="rubrique">C.G.U</div></a>
            <a href="<?php echo WEBROOT; ?>reglement/"><div class="rubrique">Réglement Owny</div></a>
			
           <div style="background: url('<?php echo WEBROOT; ?>theme/officiel/img/menu/titre/video.png');" class="titre"></div>
            <center><iframe style="width: 100%;" src="<?php echo $this->youtube; ?>" frameborder="0"></iframe></center>
			
            <div style="background: url('<?php echo WEBROOT; ?>theme/officiel/img/menu/titre/facebook.png');" class="titre"></div>
            <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $this->facebook; ?>&amp;width=250&amp;height=258&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=315116601835632" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:258px;" allowTransparency="true"></iframe>
        </div>
    </div>
    <div id="page">
    <?php
    if (isset($_SESSION['heurevote'],$_SESSION['points'])){
    $cache2 = new Cache("statut_serveur");
    if (isset($cache2) && $cache2->valide()){
        $cache2->readCache();
    }else{
        if (isset($cache2)){
            $cache2->startSave();
        }
    $etat = IsOnligne($this->ip,$this->port);
    $color = "#559e3b";
    $statut = "Ouvert";
    if (!$etat){
    $color = "red";
    $statut = "Fermer";
    }
    ?>
    <div class="infos"><font style="color: <?php echo $color; ?>;" class="status"><?php echo $statut; ?></font>
    <?php
        if (isset($cache2)){
            $cache2->endSave();
        }
    }
    ?>
        <font class="points"><?php echo (isset($_SESSION['points']))?$_SESSION['points']:0;?></font><font class="msg"><?php echo (isset($_SESSION['heurevote']))?date("H:i",$_SESSION['heurevote']):"Pas encore voter";?></font></div>
    <?php
    }
    if (isset($cache) && $cache->valide()){
        $cache->readCache();
    }else{
        if (isset($cache)){
            $cache->startSave();
        }
    ?>
    <div class="titre"><?php echo $titre; ?></div>
    <div class="barre_gauche"></div>
    <div class="barre_droit"></div>
    <div class="contenu">
    <?php echo $contenu; ?>
    <?php
        if (isset($cache)){
            $cache->endSave();
        }
    }            
    ?>
    </div>
    </div>
    </div>
    <div class="bas"></div>
    </div>
    </body>
    <footer>
		<?php
        $fin = getmicrotime();
        echo "<font>Page générée en ".round($fin-$debut, 3) ." sec.</font></br><a style='margin-left:-60px;' href='".WEBROOT."mentions/'>Mentions Légale</a>";
        ?>	
		</br>
		</br>
		</br>
		<div id="google_translate_element"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'fr'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <!--<font><object type="application/x-shockwave-flash" data="<?php echo WEBROOT; ?>theme/officiel/swf/dewplayer-mini.swf" width="21" height="20" id="dewplayer" name="dewplayer"> <param name="wmode" value="transparent" /><param name="movie" value="<?php echo WEBROOT; ?>theme/officiel/swf/dewplayer-mini.swf" /> <param name="flashvars" value="mp3=<?php echo WEBROOT; ?>theme/officiel/musique/ambiance.mp3&amp;autostart=1&amp;autoreplay=1&amp;nopointer=1&amp;volume=20" /> </object></font>
		--><script type="text/javascript">
			try {Noowho_ref = top.document.referrer;}catch(e) {Noowho_ref = document.referrer;} Noowho_ref.replace(/[<>"]/g, '').replace(/&/g, '%26');
			document.write('<script type="text/javascript" src="http://www.noowho.com/textimage.php?site=23714592&ref='+Noowho_ref+'">');  
		</script></script>
	</footer>
</html>