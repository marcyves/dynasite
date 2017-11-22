<?php
include('header.html');
echo "<h2>La page d'administration</h2>";
//echo realpath('index.php');

$fichier_config = "../config1.inc.php";
$fichier_modele = "configuration.php";

if(!is_readable($fichier_modele)){
	echo "<p>Le fichier modèle de configuration n'existe pas.</p>";
	die(1);
}

if(is_readable($fichier_config)){
	echo "<p>lecture des paramètres actuels dans le fichier $fichier_config.</p>";
	include($fichier_config);
} else {
	echo "<p>Création du fichier config : $fichier_config.</p>";
	// Initialisation des variables
	$dossier_template     = '';
	$dossier_menu         = '';
	$dossier_social       = ''; 
	$theme                = '';
	$etiquette['contact'] = '';
	$etiquette['footer']  = '';
	$etiquette['titre']   = '';
	$etiquette['header']  = '';
	$etiquette['intro']   = '';
}
// print_r($_POST);
if(@$_POST['ok'] == 'Enregistrer'){
	/*
	Enregistrement des valeurs du formulaire
	dans le fichier config1.inc.php
	*/
		
	$contenu = file_get_contents($fichier_modele);
	
	echo "<ul>";
	foreach($_POST as $nom => $valeur){
		/* 
		  Pour chaque valeur reçue dans le tableau $_POST
		  on reprend la clef dans $nom et la valeur dans $valeur
		*/
		if($nom != 'ok'){
			echo "<li>$nom = $valeur</li>";
			$valeur  = str_replace('"',"'",$valeur);
			$contenu = str_replace("@@$nom@@","$valeur", $contenu);		
		}
	}
	echo "</ul>";
	
	$fichier_sortie = fopen($fichier_config, 'w');
	fwrite($fichier_sortie, $contenu);
	fclose($fichier_sortie);
	
	echo "<h2>Le fichier de configuration a été créé</h2>Fichier : $fichier_config.";
	
	echo "<p><a href='index.php'>Retour Administration</a></p>";
	
} else {
	echo "<form method='post'>
<h3>Les variables de configuration</h3>
<p>
Dossier template : <input type='text' name='template' value='$dossier_template'><br>
Dossier menu     : <input type='text' name='menu' value='$dossier_menu'><br>
Dossier social   : <input type='text' name='social' value='$dossier_social'><br>
Sélectionner un thème : <select name='theme'>";

	$dossiers = scandir( '../themes' , SCANDIR_SORT_ASCENDING );
	foreach($dossiers as $dossier){
		if($dossier != "." && $dossier != ".."){
			if($theme == $dossier){
				echo "<option selected value='$dossier'>$dossier</option>";
			} else {
				echo "<option value='$dossier'>$dossier</option>";
			}
		}
	}
	echo "</select></p>";
	echo "<p>Titre : <textarea name='titre' rows='5' cols='80'>".$etiquette['titre']."</textarea></p>";
	echo "<p>Intro : <textarea name='intro' rows='5' cols='80'>".$etiquette['intro']."</textarea></p>";
	echo "<p>Footer : <textarea name='footer' rows='5' cols='80'>".$etiquette['footer']."</textarea></p>";
	echo "<p>Contact : <textarea name='contact' rows='5' cols='80'>".$etiquette['contact']."</textarea></p>";
	echo "<p>Header : <textarea name='header' rows='5' cols='80'>".$etiquette['header']."</textarea></p>";
	echo "<input type='submit' value='Enregistrer' name='ok'>";
	echo "<input type='submit' value='Cancel'      name='ok'>
	</form>";
}
include('footer.html');
?>
