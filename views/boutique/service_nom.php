<center>
    Vous voulez changer de nom de joueur ?</br>
    Alors n'h�sitez plus et changait votre nom cela ne vous co�tera que <?php echo $this->change_name; ?> points.</br>
    </br>
    <form autocomplete="off" method="POST" action="">
        <input type="text" id="text" name="name" placeholder="Ex : Marcel" value="" required/>
        <input type="submit" id="submit" value="Changer" name="valider"/>
    </form>
</center>