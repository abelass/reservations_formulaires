<?php
/**
 * Définition d'une configuration pour Réservation Formulaires
 *
 * @plugin     Réservations formulaires
 * @copyright  2017 - 2021
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

	$objets = array(
		'rubrique' => array(
			'saisie' => 'selecteur_rubrique'
		),
		'article' => array(
			'saisie' => 'selecteur_article'
		),
		'evenement' => array(
			'saisie' => 'input',
		)
	);

	$liste_objets =lister_tables_objets_sql();
	$choix_objets = array();
	foreach(array_keys($objets) AS $objet) {
		$table_objet = _T($liste_objets['spip_' . $objet . 's']['texte_objets']);
		$choix_objets[$objet] = _T($liste_objets['spip_' . $objet . 's']['texte_objets']);
	}

	$saisies = array (
		'nom' => _T('reservation_formulaire:nom_formulaire_configuration_specifier_evenements'),
		'saisies' => array(
			'saisie' => 'fieldset',
			'options' => array(
				'nom' => 'specifique',
				'label' => _T($desc['texte_objets'])
			),
			'saisies' => array (
				array(
					'saisie' => 'selection',
					'options' => array(
						'nom' => 'choix_objet',
						'label' => _T('organiseur:info_message_objet'),
						'datas' => $choix_objets,
						'obligatoire' => 'oui',
					),
				),
			),
		),
	);

	foreach($objets AS $objet => $donnees) {
		$saisies['saisies']['saisies'][] =
			array(
				'saisie' => $donnees['saisie'],
				'options' => array(
					'nom' => 'limiter_' . $objet,
					'label' => _T('reservation_formulaire:champ_selection_label'),
					'afficher_si' => '@choix_objet@ == "' . $objet . '"',
					'multiple' => 'oui',
				),
		);
	}

	$configuration = isset($saisies[_request('choix_objet')]) ? $saisies[_request('choix_objet')] : '';

	return $saisies;
}
