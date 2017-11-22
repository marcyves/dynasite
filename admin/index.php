<?php

echo "<h1>La page d'administration</h1>";

//echo realpath('index.php');
$fichier_config = '../config.inc.php';

if(is_readable($fichier_config)){
  include($fichier_config);
} else {
  echo "<h2>Le fichier config n'existe pas</h2>";
}

echo "<form></form>";

function write_config_file($path)
{

	$content = file_get_contents('configuration.php');

	$config['{dossier_template}'] = date('r');
	$config['{dossier_menu}'] = $dbHostForm;
	$config['{dossier_social}'] = $dbUsernameForm;
	$config['{theme}'] = $dbPassForm;
	$config['titre'] = trueFalse($enableTrackingForm);
	$config['intro'] = trueFalse($singleDbForm);
	$config['{header}'] = ($singleDbForm ? 'crs_' : '');
	$config['{contact}'] = ($singleDbForm ? '_' : '`.`');
	$config['{footer}'] = $dbPrefixForm;

	foreach ($config as $key => $value)
	{
		$content = str_replace($key, $value, $content);
	}

	$fp = @ fopen($path, 'w');

	if (!$fp)
	{
		echo '<b><font color="red">Your script doesn\'t have write access to the config directory</font></b><br />
						<em>('.str_replace('\\', '/', realpath($path)).')</em><br /><br />
						You probably do not have write access on Dokeos root directory,
						i.e. you should <em>CHMOD 777</em> or <em>755</em> or <em>775</em>.<br /><br />
						Your problems can be related on two possible causes:<br />
						<ul>
						  <li>Permission problems.<br />Try initially with <em>chmod -R 777</em> and increase restrictions gradually.</li>
						  <li>PHP is running in <a href="http://www.php.net/manual/en/features.safe-mode.php" target="_blank">Safe-Mode</a>. If possible, try to switch it off.</li>
						</ul>
					    <p><input type="submit" name="step5" value="&lt; Back" /></p>
					    </td></tr></table></form></body></html>';

		exit ();
	}
	fwrite($fp, $content);
	fclose($fp);
}
?>
