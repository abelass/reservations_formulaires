<?php
/**
 * Définition d'une configuration pour Réservation Formulaires
 *
 * @plugin     Réservations formulaires
 * @copyright  2017
 * @author     Rainer
 * @licence    GNU/GPL
 * @package    SPIP\Reservations_formulaires\Formulaire_configuration
 */


/**
 * Prépare les saisies pour l'objet reservation.
 *
 * @param array $valeurs.
 *        Les valeurs par défaut du formulaire.
 *
 * @return array
 *        Les valeurs.
 */
function formulaire_configurations_rf_limiter_dist($valeurs) {

	return array (
		'nom' => _T('reservation_formulaire:nom_formulaire_configuration_specifier_evenements'),
		'saisies' => array(
			'saisie' => 'selecteur_rubrique',
			'options' => array(
				'nom' => 'limiter_rubrique',
				'label' => _T('reservation_formulaire:champ_limiter_rubrique_label'),
			),
		),
	);
}
