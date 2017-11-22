<?php

require('config.inc.php');
require('fonctions.inc.php');
					
if (isset($_GET['page'])){
	$page_active = $_GET['page'];
} else {
	$page_active = "accueil";
}
						
echo decodeTemplate($theme,$etiquette, $page_active);
?>