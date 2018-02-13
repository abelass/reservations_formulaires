<?php
/**
 * Utilisations de pipelines par Réservations formulaires
 *
 * @plugin     Réservations formulaires
 * @copyright  2017
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Reservations_formulaires\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Ajout de contenu sur certaines pages,
 * notamment des formulaires de liaisons entre objets
 *
 * @pipeline affiche_milieu
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservations_formulaires_affiche_milieu($flux) {
	include_spip('inc/config');
	$texte = '';
	$e = trouver_objet_exec($flux['args']['exec']);

	// auteurs sur les reservation_formulaires
	if (!$e['edition'] and in_array($e['type'], array('reservation_formulaire'))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'auteurs',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}


	// reservation_formulaires sur les objets choisis
	if (!$e['edition'] and in_array($e['table_objet_sql'],
			array_filter(lire_config('reservations_formulaires/objets', array ())))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'reservation_formulaires',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}
	// reservation_formulaire_configurations sur les reservation_formulaires
	if (!$e['edition'] and in_array($e['type'], array('reservation_formulaire'))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'reservation_formulaire_configurations',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}

	if ($texte) {
		if ($p = strpos($flux['data'], '<!--affiche_milieu-->')) {
			$flux['data'] = substr_replace($flux['data'], $texte, $p, 0);
		} else {
			$flux['data'] .= $texte;
		}
	}

	return $flux;
}

/**
 * Ajout de liste sur la vue d'un auteur
 *
 * @pipeline affiche_auteurs_interventions
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservations_formulaires_affiche_auteurs_interventions($flux) {
	if ($id_auteur = intval($flux['args']['id_auteur'])) {
		$flux['data'] .= recuperer_fond('prive/objets/liste/reservation_formulaires', array(
			'id_auteur' => $id_auteur,
			'titre' => _T('reservation_formulaire:info_reservation_formulaires_auteur')
		), array('ajax' => true));
	}
	return $flux;
}

/**
 * Optimiser la base de données
 *
 * Supprime les liens orphelins de l'objet vers quelqu'un et de quelqu'un vers l'objet.
 * Supprime les liens orphelins de l'objet vers quelqu'un et de quelqu'un vers l'objet.
 * Supprime les objets à la poubelle.
 *
 * @pipeline optimiser_base_disparus
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservations_formulaires_optimiser_base_disparus($flux) {

	include_spip('action/editer_liens');
	$flux['data'] += objet_optimiser_liens(array('reservation_formulaire'=>'*', 'reservation_formulaire_configuration'=>'*'), '*');

	sql_delete('spip_reservation_formulaires', "statut='poubelle' AND maj < " . $flux['args']['date']);

	return $flux;
}

/**
 * Intervient lors du chargement d'un objet.
 *
 * @pipeline formulaire_charger
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservations_formulaires_formulaire_charger($flux) {
	$form = $flux['args']['form'];
	$forms = array (
		'reservation',
		'editer_reservation'
	);
	$contexte = $flux['data'];
	// Charger les valeurs par défaut
	if (in_array($form, $forms)) {
		if (isset($contexte['id_reservation_formulaire'])) {
			$contexte['_hidden'] .= '<input type="hidden" name="id_reservation_formulaire" value="' . $contexte['id_reservation_formulaire'] . '" />';
		}

		$configurations = array();
		if (isset($contexte['configurations'])) {
			$configurations = $contexte['configurations'];
			$type = $configurations['type'];
		}
		elseif(!empty($contexte['id_reservation_formulaire'])) {
			$sql = sql_select('type,configuration,titre',
					'spip_reservation_formulaire_configurations_liens AS liens, spip_reservation_formulaire_configurations AS confs',
					'liens.id_reservation_formulaire_configuration = confs.id_reservation_formulaire_configuration AND objet=' . sql_quote('reservation_formulaire') . ' AND id_objet=' . $contexte['id_reservation_formulaire']);

			while ($data = sql_fetch($sql)) {
				$type = $data['type'];
				$configurations[$type] = $contexte[$type] = json_decode($data['configuration'], true);
			}
		}


		$flux['data']['contexte']['formulaire_configurations'] = $configurations;

		foreach ($configurations AS $type => $configuration) {
			if ($charger = charger_fonction('charger', 'formulaire_configurations/' .$type, true)) {
				$contexte = $charger($type, $contexte, $configuration);
			}
		}

		$flux['data'] = $contexte;
	}
	return $flux;
}

/**
 * Intervient lors du chargement d'un objet.
 *
 * @pipeline formulaire_verifier
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservations_formulaires_formulaire_verifier($flux) {
	$form = $flux['args']['form'];
	$forms = array (
		'reservation',
		'editer_reservation'
	);
	$erreurs = $flux['data'];

	// Charger les valeurs par défaut
	if (in_array($form, $forms)) {
		$id_reservation_formulaire = _request('id_reservation_formulaire');

		if($id_reservation_formulaire) {
			$sql = sql_select(
					'type,configuration',
					'spip_reservation_formulaire_configurations_liens,spip_reservation_formulaire_configurations',
					'objet=' . sql_quote('reservation_formulaire') . ' AND id_objet=' . $id_reservation_formulaire);

			while ($data = sql_fetch($sql)) {
				$type = $data['type'];
				$configurations = json_decode($data['configuration'], true);
				if ($charger = charger_fonction('verifier', 'formulaire_configurations/' .$type, true)) {
					$erreurs= $charger($type, $erreurs, $configurations);
				}
			}
		}
		$flux['data'] = $erreurs;
	}
	return $flux;
}

/**
 * Ajouter une entré au menu de navigation de résrvation événement.
 *
 * @pipeline reservation_evenement_objets_navigation
 *
 * @param array $flux
 *        	Données du pipeline
 * @return array
 *          Données du pipeline
 */
function reservations_formulaires_reservation_evenement_objets_navigation($flux) {

	$flux['data']['reservation_formulaires'] = array(
		'label' => _T('reservations_formulaires:reservations_formulaires_titre'),
		'objets' => array('reservation_formulaires', 'reservation_formulaire')
	);

	return $flux;
}

/**
 * Ajouter les configurations dans celle de réservation événements.
 *
 * @pipeline reservation_evenement_objets_configuration
 *
 * @param array $flux
 *        	Données du pipeline
 * @return array Données du pipeline
 */
function reservations_formulaires_reservation_evenement_objets_configuration($flux) {
	$flux['data']['reservations_formulaires'] = array(
			'label' => _T('reservations_formulaires:reservations_formulaires_titre')
		);

	return $flux;
}
