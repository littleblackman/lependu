<?php
session_start();

if(isset($_GET['restart'])) session_unset();

include_once('lib/bdd_functions.php');
include_once('lib/helpers.php');


// vérifie si un mot existe sinon on lance le jeu
if(!isset($_SESSION['current_word'])) {

    // tirage au sort du mot
    $words = getWords();
    $key = rand(0,count($words)-1);

    for($i = 0; $i < strlen($words[$key]); $i++)
    {
        $lettre_du_mot[] = $words[$key][$i];
    }

    // variables de sessions
    $_SESSION['current_word']     = $words[$key];
    $_SESSION['lettre_proposees'] = [];
    $_SESSION['lettre_du_mot']    = $lettre_du_mot;
    $_SESSION['lettre_trouvees']  = array();
    $_SESSION['lettre_proposees'] = [];
    $_SESSION['avancement']       = 0;
    $_SESSION['maxlimit']         = 7;
}

// variables utiles
$lettre_proposees = $_SESSION['lettre_proposees'];
$lettre_trouvees  = $_SESSION['lettre_trouvees'];
$lettre_du_mot    = $_SESSION['lettre_du_mot'];
$avancement       = $_SESSION['avancement'];
$maxlimit         = $_SESSION['maxlimit'];



// test si on est en post
if(isset($_POST['letter']))
{
    $letter = strtolower($_POST['letter']);

    // si la lettre n'a pas encore été proposé on l'ajoute aux lettres proposées
    if(!in_array($letter, $lettre_proposees)) {
        $lettre_proposees[] = $letter;
    }

    // si la lettre est-elle dans le mot on l'ajoute aux lettres trouvées
    if(in_array($letter, $lettre_du_mot))
    {
        $lettre_trouvees[] = $letter;
    }

    // verification si toutes les lettres sont trouvées
   $reste_des_lettres = 0;
    foreach($lettre_du_mot as $l) {
        if(!in_array($l, $lettre_trouvees)) $reste_des_lettres++;
    }

    if($reste_des_lettres == 0) {
        $stop    = 1;
        $message = "Bravo vous avez gagné";
    }

    // avance d'un cran le pendu
    $avancement++;
    if($avancement == $maxlimit) {
        $stop = 1;
        $message = "Vous avez perdu !!!";
    }


    // update des variables sessions
    $_SESSION['lettre_proposees'] = $lettre_proposees;
    $_SESSION['lettre_trouvees']  = $lettre_trouvees;
    $_SESSION['avancement']       = $avancement;

}

$img = "images/".$avancement.".jpg";


$c_word = $_SESSION['current_word'];


/**** affichage des données pour tester le jeu ************/
echo '<br/>mot en cours:'.$c_word;
echo '<br/>Lettres du mots:'; print_r($lettre_du_mot);
echo '<br/>lettres proposées:'; print_r($lettre_proposees);
echo '<br/>lettres trouvées:'; print_r($lettre_trouvees);
echo '<br/>avancement:'.$avancement;
/**** ********** ********* *********  ************/

;?>
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
    <img src="<?= $img;?>" alt="image du pendu"/>
</div>
<br style="clear: both"/>
<br/>
<a href="index.php?restart=1">Recommencer</a>


<?php $content = ob_get_clean();?>
<?php include('view/gabarit.php');?>

