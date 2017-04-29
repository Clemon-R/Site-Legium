<script>
function open_ext_link()
{
    var lien = "<?php echo $this->rpg_vote; ?>";
    window.open(lien);
    <?php $_SESSION['voted'] = true;?>
    return false;
}
</script>
<center>
Vous avez voté <?php echo (isset($_SESSION['vote']))?$_SESSION['vote']:0;?> fois pour le serveur et vous avez <?php echo (isset($_SESSION['points']))?$_SESSION['points']:0;?> points.</br>
Vous pouvez voter toutes les 3 heures et gagner <?php echo $this->points_vote; ?> Points ou <?php echo $this->points_vote_vip; ?> Points si vous êtes VIP.</br>
</br>
<?php
$heur_vote = (isset($_SESSION['heurevote']))?$_SESSION['heurevote']:0;
if (time() > ($heur_vote+(60*60*3))){
    echo "<a href='".WEBROOT."vote/voted/' onclick='open_ext_link()'>Cliquer ici pour voter</a>";
}else{
    echo "Vous avez voté il y a moins de 3 heures à ".date("H:i",$heur_vote);
}
?>
</center>
