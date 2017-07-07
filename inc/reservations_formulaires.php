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
function reservations_formulaires_definition_saisies($type, $valeurs) {

	// Chercher les fichiers promotions
	$configurations_defs = find_all_in_path("formulaire_configurations/", '^');
	$configurations_noms = array();
	$configurations = array();
	if (is_array($configurations_defs)) {

		foreach ($configurations_defs as $fichier => $chemin) {
			list($nom, $extension) = explode('.', $fichier);;
			// Charger la définition des champs
			if ($confs = charger_fonction($nom, "formulaire_configurations", true)) {
				$configuration = $confs($valeurs);
				if ($type == $nom and isset($configuration['saisies'])) {
					$configurations[] = array(
						'saisie' => 'fieldset',
						'options' => array(
							'nom' => 'specifique',
							'label' => _T('reservation_formulaire_configuration:champ_configuration_label')
						),
						'saisies' => $configuration['saisies']
					);
				}
				// Lister les promotions dipsonibles
				if (isset($configuration['nom']))
					$configurations_noms[$nom] = $configuration['nom'];
			}
		}
	}

	$defaut = array(
		'saisies' => array(
			'saisie' => 'selection',
			'options' => array(
				'nom' => 'type',
				'label' => _T('reservation_formulaire_configuration:champ_type_label'),
				'datas' => $configurations_noms
			)
		)
	);

	$saisies = array_merge($defaut, $configurations);

	return $saisies;
}
