<?php

/*
==============================================================================
		Configuration du framework GRETA

This file contains a list of variables that can be modified by the site
administrator. Pay attention when changing these variables, some changes
can cause the site to stop working.
==============================================================================
*/

$dossier_template = './template/';
$dossier_menu     = "menu";
$dossier_social   = "social/";

/* Choix possibles:
 - massively
 - photon
 - arcana
*/
$theme = 'massively';

$etiquette['contact'] = '<h3>Address</h3>
								<p>Lycée Jules Ferry<br />
								CANNES</p>
							</section>
							<section>
								<h3>Phone</h3>
								<p><a href="#">(000) 000-0000</a></p>
							</section>
							<section>
								<h3>Email</h3>
								<p><a href="#">info@untitled.tld</a></p>';

$etiquette['footer']= '<form method="post" action="#">
								<div class="field">
									<label for="name">Name</label>
									<input type="text" name="name" id="name" />
								</div>
								<div class="field">
									<label for="email">Email</label>
									<input type="text" name="email" id="email" />
								</div>
								<div class="field">
									<label for="message">Message</label>
									<textarea name="message" id="message" rows="3"></textarea>
								</div>
								<ul class="actions">
									<li><input type="submit" value="Send Message" /></li>
								</ul>
							</form>';
$etiquette['titre'] = 'Le nouveau site en php';
$etiquette['header']= 'Le header du nouveau site en php';
$etiquette['intro'] = '<h1>This is<br />
						Marc-ively</h1>
						<p>A free, fully responsive HTML5 + CSS3 site template designed by <a href="https://twitter.com/ajlkn">@ajlkn</a> for <a href="https://html5up.net">HTML5 UP</a><br />
						and released for free under the <a href="https://html5up.net/license">Creative Commons license</a>.</p>
						<ul class="actions">
							<li><a href="#header" class="button icon solo fa-arrow-down scrolly">Continue</a></li>
						</ul>';
?>
