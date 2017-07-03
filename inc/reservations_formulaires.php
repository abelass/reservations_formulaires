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
 *      Le Type de promotion.
 * @param array $valeurs
 *      Les valeurs par défaut
 *
 * @return array
 *      défintion en format du plugin saisies.
 */
function reservations_formulaires_definition_saisies($type, $valeurs) {

	// Chercher les fichiers promotions
	$configurations_defs = find_all_in_path("formulaire_configurations/", '^');

	$configurations_noms = array();
	$configurations = array();


	if (is_array($configurations_defs)) {
		foreach ($configurations_defs as $fichier => $chemin) {
			list($nom, $extension) = explode('.', $fichier);
			// Charger la définition des champs
			if ($confs = charger_fonction($nom, "configurations", true)) {
				$configuration = $confs($valeurs);
				if ($type_configuration== $nom and isset($promotion['saisies'])) {
					$promotions_defs[] = array(
							'saisie' => 'fieldset',
							'options' => array(
								'nom' => 'specifique',
								'label' => _T('reservation_formulaire_configuration:champ_configuration_label'),
							),
						'saisies' => $configuration['saisies']

					);
				}
				// Lister les promotions dipsonibles
				if (isset($promotion['nom']))
					$configurations_noms[$nom] = $promotion['nom'];
			}
		}
	}

	$defaut = array (
		'saisie' => 'selection',
		'options' => array (
			'nom' => 'type',
			'label' => _T('reservation_formulaire:champ_type_configuration_label'),
			'obligatoire' => 'oui',
			'datas' => $configurations_noms,
			'class' => 'auto_submit'
		)
	);

	$saisies = array_merge($defaut, $promotions_defs);

	return $saisies;
}