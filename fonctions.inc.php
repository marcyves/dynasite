<?php

function prepareMenu($dossier_menu, $page_active){
	// Construction du menu
	$tmp = '<ul class="links">';

	$fichiers = scandir( $dossier_menu , SCANDIR_SORT_ASCENDING );
	foreach($fichiers as $fichier){
		$ext  = substr($fichier, strrpos($fichier,'.')+1);
		if($ext == 'menu'){
			$page  = substr($fichier, 0, strrpos($fichier, '.'));
			$label = substr($fichier, 1, strrpos($fichier, '.')-1);
			if ($page == $page_active){
//				$tmp  .= "<li class='active'><a href='index.php?page=$page'>$label</a></li>";
				$tmp  .= "<li class='active'><a href='page-$page.html'>$label</a></li>";
			} else {
//				$tmp .= "<li><a href='index.php?page=$page'>$label</a></li>";
				$tmp  .= "<li><a href='page-$page.html'>$label</a></li>";
			}
		}
	}
	$tmp .= '</ul>';

	return $tmp;
}

function prepareContenu($dossier_menu, $page_active){
	// Extraction du contenu
	$fichier_contenu = $dossier_menu."/$page_active.menu";

	if(is_readable($fichier_contenu)){
		$tmp = file_get_contents($fichier_contenu);
	} else {
		$tmp = "<h1>La page demandée n'existe pas</h1>";
	}
	return $tmp;
}

function prepareSocial($dossier_social){
	// Extraction Social
	$tmp = '<ul class="icons">';

	// Obtenir la liste des fichiers contenus dans le dossier $dossier_social
	$fichiers = scandir( $dossier_social , SCANDIR_SORT_ASCENDING );

	// Boucle pour chaque fichier trouvé dans le dossier $dossier_social
	foreach($fichiers as $fichier){
		/*
		Pour obtenir l'extension, on coupe la chaine $fichier à partir du caractère après le point jusqu'à la fin.

		substr  ( string $string , int $start [, int $length ] )
			Retourne le segment de string défini par start et length.

		strrpos ( string $haystack , string $needle [, int $offset = 0 ] )
			Cherche la position numérique de la dernière occurrence de needle dans la chaîne haystack.
		*/
		$ext  = substr($fichier, strrpos($fichier,'.')+1);
		// On ne traite que les fichiers dont l'extension est 'social'
		if($ext == 'social'){
			/*
			On veut extraire le nom du fichier pour obtenir un label en minuscules
			On extrait cette fois avec substr depuis le début (0) jusqu'à la position du point.
			*/
			$label  = strtolower(substr($fichier, 0, strrpos($fichier, '.')));
			// On lit le lien dans le fichier
			$lien   = file_get_contents($dossier_social.'/'.$fichier);
			// On ajoute le code html avec les variables à l'entrée social' du tableau $etiquette
			$tmp .= "<li><a href='http://$lien' class='icon fa-$label'><span class='label'>$label</span></a></li>";
		}
	}
	$tmp .= '</ul>';

	return $tmp;
}

function decodeTemplate($template, $etiquette, $page_active){
	global $dossier_menu, $dossier_social, $dossier_template;

	$fichier_template = "$template.tmpl";

	$etiquette['menu']    = prepareMenu($dossier_menu, $page_active);
	$etiquette['contenu'] = prepareContenu($dossier_menu, $page_active);
	$etiquette['social']  = prepareSocial($dossier_social);

	// Traitement du template
	if (file_exists($dossier_template.$fichier_template)){
		$page_html = file_get_contents($dossier_template . $fichier_template, FILE_USE_INCLUDE_PATH);

		foreach($etiquette as $nom => $valeur){
			$page_html = str_replace("@@$nom@@" , $valeur , $page_html);
		}
	} else {
		$page_html = "<html><header><title>ERREUR</title></header><body><h1>ERREUR TEMPLATE</h1>Le fichier $dossier_template.$fichier_template n'existe pas</body></html>";
	}
	return $page_html;
}

?>
