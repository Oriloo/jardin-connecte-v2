<!-- Barres de navigation et de menu du site -->
<div class="Barres">
	<!-- Barres supérieures du site -->
	<nav class="nav-bar">
		<div class="logo-jc"> <?php include('image/svg/logo-jc-nom.svg'); ?> </div>
		<div class="ico-notife"> <?php include('image/svg/notife-ico.svg'); ?> </div>
	</nav>

	<!-- Barre latérale de menu -->
	<div class="BarreMenu">
		<!-- Informations sur l'utilisateur -->
		<div class="user-info">
			<?php
			// Variable $Avatar contenant le nom de l'avatar avec extension
			$avatarFile = '../image/pp/pp' . $Avatar;
			// Vérifie l'extension du fichier
			if (file_exists($avatarFile . '.png')) {
				$avatarFile .= '.png';
			} elseif (file_exists($avatarFile . '.gif')) {
				$avatarFile .= '.gif';
			} else {
				// Si le fichier n'existe pas, utilisez un avatar par défaut ou un chemin vers une image d'erreur
				$avatarFile = '../image/pp/pp0.png';
			}
			?>
			<img class="pp-user" src="<?php echo $avatarFile; ?>" alt="Avatar"> <br>
			<strong class="grade">
				Administrateur
			</strong>
			<div class="nom"></div>
		</div>

		<!-- Liste des sections avec icônes -->
		<menu id="menu-liste">
			<a href="../tableau-bord/tableau-bord.php?profil=<?php echo $selectedTable; ?>">
				<li id="liste-table">
					<div class="ico-menu">
						<?php include('image/svg/tableau-ico.svg'); ?>
						Tableau de bord
					</div>
				</li>
			</a>
			<a href="../donnee-direct/donnee-direct.php?profil=<?php echo $selectedTable; ?>">
				<li id="liste-direc">
					<div class="ico-menu direct-pulse">
						<div class="pulse"></div>
						<p>Données en direct</p>
					</div>
				</li>
			</a>
			<a href="../graphique/graphique.php?profil=<?php echo $selectedTable; ?>">
				<li id="liste-grphe">
					<div class="ico-menu">
						<?php include('image/svg/graph-ico.svg'); ?>
						Graphiques
					</div>
				</li>
			</a>
			<a href="../controle/controle.php?profil=<?php echo $selectedTable; ?>">
				<li id="liste-contr">
					<div class="ico-menu">
						<?php include('image/svg/sliders-ico.svg'); ?>
						Contrôles
					</div>
				</li>
			</a>
			<a href="../historique/historique.php?profil=<?php echo $selectedTable; ?>">
				<li id="liste-histo">
					<div class="ico-menu">
						<?php include('image/svg/hitorique-ico.svg'); ?>
						Historiques
					</div>
				</li>
			</a>
			<a href="../parametre/parametre.php?profil=<?php echo $selectedTable; ?>">
				<li id="liste-param">
					<div class="ico-menu">
						<?php include('image/svg/param-ico.svg'); ?>
						Paramètres
					</div>
				</li>
			</a>

			<div class="autre-option">
				<!-- Bouton de déconnexion -->
				<a href="../connexion/logout.php">
					<li id="liste-decon">
						<div class="ico-menu">
							<?php include('image/svg/deco-ico.svg'); ?>
							Déconnexion
						</div>
					</li>
				</a>

				<!-- Bouton d'aides -->
				<li id="liste-aides">
					<div class="ico-menu">
						<?php include('image/svg/aides-ico.svg'); ?>
						Prise en main
					</div>
				</li>
			</div>
		</menu>
	</div>
</div>

<!-- Zone de Notif
<div class="notif"></div>
-->
