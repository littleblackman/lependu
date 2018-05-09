<?php ob_start();?>

<div style="float: left; width: 50%">

    <!-- affichage du mot --->
    <?php for($i = 0; $i < strlen($c_word); $i++):?>

        <?php $c_letter = $c_word[$i];?>
        <?php if(in_array($c_letter, $lettre_trouvees)):?>
            <?php echo $c_word[$i];?>
        <?php else:?>
            _
        <?php endif;?>
    <?php endfor;?>

    <!-- formulaire de saisie--->
    <?php if(!isset($stop)):?>
        <form action="index.php" method="post">
            <input type="text" name="letter" />
            <input type="submit" value="proposez"/>
        </form>
    <?php else:?>
        <br/>
        <div class="alert">
            <?php echo $message;?>
        </div>
    <?php endif;?>
</div>

<!-- affichage de l'image --->
<div style="float: left; width: 50%">
    <img src="<?= IMG.$img;?>" alt="image du pendu"/>
</div>
<br style="clear: both"/>
<br/>
<a href="index.php?restart=1">Recommencer</a>


<?php $content = ob_get_clean();?>

<?php include(VIEW.'_gabarit.php');?>

