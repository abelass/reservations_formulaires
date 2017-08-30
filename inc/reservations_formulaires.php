<?php
/**
 * Fonctions du plugin
 *
 * @plugin     Réservations formulaires
 * @copyright  2017
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Reservations_formulaires\Inc
 */

/**
 * Récupère les définitions des promotions.
 *
 * @param string $type_promotion
 *        	Le Type de promotion.
 * @param array $valeurs
 *        	Les valeurs par défaut
 *
 * @return array défintion en format du plugin saisies.
 */
function reservations_formulaires_definition_saisies($type, $valeurs = array()) {

	$configurations = reservations_formulaires_charger_definitions($type, $valeurs) ;
	if (count($configurations) > 0) {
		if (isset($configurations['saisies'])) {
			$configurations_saisies = $configurations['saisies'];
		}
		else {
			$configurations_saisies = array (
				'saisie' => 'hidden',
				'options' => array(
					'nom' => 'configurations_choix',
					'texte' => _T('reservation_formulaire_configuration:champ_configurations_manquantes'),
					'defaut' => 'non',
				)
			);
		}
	}
	else {
		$configurations_saisies = array (
			'saisie' => 'explication',
			'options' => array(
				'nom' => 'configurations_manquantes',
				'texte' => _T('reservation_formulaire_configuration:champ_configurations_manquantes')
			)
		);
	}

	$saisies = array(
		array(
			'saisie' => 'fieldset',
			'options' => array(
				'nom' => 'configurations',
				'label' => _T('reservation_formulaire_configuration:champ_configuration_label')
			),
			'saisies' => array(
				array(
					'saisie' => 'selection',
					'options' => array(
						'nom' => 'type',
						'label' => _T('reservation_formulaire_configuration:champ_type_label'),
						'datas' => $configurations['noms'],
						'valeur_forcee' => $type
					)
				),
				$saisies = $configurations_saisies,
			),
		)
	);

	return $saisies;
}

function reservations_formulaires_charger_definitions($type, $valeurs = array(), $filtrer = '') {
	// Chercher les fichiers des configurations.
	$configurations_defs = find_all_in_path("formulaire_configurations/", '^');

	$configurations = array();
	if (is_array($configurations_defs)) {

		foreach ($configurations_defs as $fichier => $chemin) {
			list($nom, $extension) = explode('.', $fichier);

			// Charger la définition des champs
			if ($confs = charger_fonction($nom, "formulaire_configurations", true)) {
				$configuration = $confs($valeurs);
				if ($type == $nom and isset($configuration['saisies'])) {
					$configurations['saisies'] = $configuration['saisies'];
				}
				// Lister les configurations disponibles.
				if (isset($configuration['nom']))
					$configurations['noms'][$nom] = $configuration['nom'];
			}
		}
	}

	if ($filtrer and isset($configurations[$filtrer])) {
		$configurations = $configurations[$filtrer];
	}

	return $configurations;
}
