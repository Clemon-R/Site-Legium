<div class="conteneur">
<table frame="void" rules="rows" class="table">
    <tr class="header">
        <th>#</th>
        <th>Nom</th>
        <th>Blason</th>
        <th>Level</th>
        <th>Expérience</th>
    </tr>
    <?php
    $position = 1;
    for ($i = 0, $size = count($liste); $i < $size; ++$i) {
    $value = $liste[$i];
    $explode_guild = explode(",", $value['emblem']);
    $bg_src = base_convert($explode_guild['0'], 36, 10); 
    $bg_color = base_convert($explode_guild['1'], 36, 10); 
    $logo_src = base_convert($explode_guild['2'], 36, 10); 
    $logo_color = base_convert($explode_guild['3'], 36, 10); 
    ?>
    <tr class="contenu">
        <td><?php echo $position; ?></td>
        <td><?php echo $value['name']; ?></td>
        <td>
        <object id="logo_guilde_container" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="50" height="50" >
		<param name="movie" value="<?php echo WEBROOT."theme/officiel/swf/DofusGuildes.swf";?>" />
		<param name="play" value="true" />
		<param name="flashvars" value="bcgSrc=<?php echo $bg_src; ?>&bcgColor=<?php echo "25"; ?>&frtSrc=<?php echo $logo_src; ?>&frtColor=<?php echo "25"; ?>" />
		<param name="loop" value="true" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
			<!--[if !IE]>-->
			<object id="logo_guilde_container" type="application/x-shockwave-flash" data="<?php echo WEBROOT."theme/officiel/swf/DofusGuildes.swf"; ?>" width="50" height="50">
				<param name="play" value="true" />
				<param name="flashvars" value="bcgSrc=<?php echo $bg_src; ?>&bcgColor=<?php echo "25"; ?>&frtSrc=<?php echo $logo_src; ?>&frtColor=<?php echo "25"; ?>" />
				<param name="loop" value="true" />
				<param name="quality" value="high" />
				<param name="wmode" value="transparent" />
			<!--<![endif]-->
				<a href="http://www.adobe.com/go/getflashplayer">
					<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
				</a>
			<!--[if !IE]>-->
			</object>
		<!--<![endif]-->
	</object>
        </td>
        <td><?php echo $value['lvl']; ?></td>
        <td><?php echo $value['xp']; ?></td>
    </tr>
    <?php $position++; } ?>
</table>
</div>