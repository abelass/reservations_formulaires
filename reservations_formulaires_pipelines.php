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


/*
 * Un fichier de pipelines permet de regrouper
 * les fonctions de branchement de votre plugin
 * sur des pipelines existants.
 */



/**
 * Ajout de contenu sur certaines pages,
 * notamment des formulaires de liaisons entre objets
 *
 * @pipeline affiche_milieu
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservations_formulaires_affiche_milieu($flux) {
	$texte = '';
	$e = trouver_objet_exec($flux['args']['exec']);

	// auteurs sur les reservation_formulaires, reservation_formulaire_configurations
	if (!$e['edition'] and in_array($e['type'], array('reservation_formulaire', 'reservation_formulaire_configuration'))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'auteurs',
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
	
		$flux['data'] .= recuperer_fond('prive/objets/liste/reservation_formulaire_configurations', array(
			'id_auteur' => $id_auteur,
			'titre' => _T('reservation_formulaire_configuration:info_reservation_formulaire_configurations_auteur')
		), array('ajax' => true));
	}
	return $flux;
}




/**
 * Optimiser la base de données
 *
 * Supprime les objets à la poubelle.
 *
 * @pipeline optimiser_base_disparus
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function reservations_formulaires_optimiser_base_disparus($flux) {

	sql_delete('spip_reservation_formulaires', "statut='poubelle' AND maj < " . $flux['args']['date']);

	return $flux;
}
