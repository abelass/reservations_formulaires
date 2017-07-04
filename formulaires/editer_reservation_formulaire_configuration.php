<?php
/**
 * Gestion du formulaire de d'édition de reservation_formulaire_configuration
 *
 * @plugin     Réservations formulaires
 * @copyright  2017
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Reservations_formulaires\Formulaires
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/reservations_formulaires');


/**
 * Identifier le formulaire en faisant abstraction des paramètres qui ne représentent pas l'objet edité
 *
 * @param int|string $id_reservation_formulaire_configuration
 *     Identifiant du reservation_formulaire_configuration. 'new' pour un nouveau reservation_formulaire_configuration.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_formulaire_configuration créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_formulaire_configuration source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_formulaire_configuration, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return string
 *     Hash du formulaire
 */
function formulaires_editer_reservation_formulaire_configuration_identifier_dist($id_reservation_formulaire_configuration = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	return serialize(array(intval($id_reservation_formulaire_configuration), $associer_objet));
}

/**
 * Chargement du formulaire d'édition de reservation_formulaire_configuration
 *
 * Déclarer les champs postés et y intégrer les valeurs par défaut
 *
 * @uses formulaires_editer_objet_charger()
 *
 * @param int|string $id_reservation_formulaire_configuration
 *     Identifiant du reservation_formulaire_configuration. 'new' pour un nouveau reservation_formulaire_configuration.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_formulaire_configuration créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_formulaire_configuration source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_formulaire_configuration, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Environnement du formulaire
 */
function formulaires_editer_reservation_formulaire_configuration_charger_dist($id_reservation_formulaire_configuration = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$valeurs = formulaires_editer_objet_charger('reservation_formulaire_configuration', $id_reservation_formulaire_configuration, '', $lier_trad, $retour, $config_fonc, $row, $hidden);

	$valeurs_configurations = json_decode($valeurs['configuration'], TRUE);
	$type = _request('type') ? _request('type') :
		(isset($valeurs['type']) ? $valeurs['type'] : '');

		$valeurs['_saisies'] = reservations_formulaires_definition_saisies($type, $valeurs);

	// initialiser les donnees spécifiques de la promotion
	if (isset($valeurs['_saisies'][1]['saisies'])) {
		foreach ($valeurs['_saisies'][1]['saisies'] as $saisie) {
			if (isset($saisie['options']['nom'])) {
				$valeurs[$saisie['options']['nom']] = _request($saisie['options']['nom']) ?
					_request($saisie['options']['nom']) :
					(isset($valeurs_configurations[$saisie['options']['nom']]) ?
						$valeurs_configurations[$saisie['options']['nom']] :
						'');
			}
		}
	}

	return $valeurs;
}

/**
 * Vérifications du formulaire d'édition de reservation_formulaire_configuration
 *
 * Vérifier les champs postés et signaler d'éventuelles erreurs
 *
 * @uses formulaires_editer_objet_verifier()
 *
 * @param int|string $id_reservation_formulaire_configuration
 *     Identifiant du reservation_formulaire_configuration. 'new' pour un nouveau reservation_formulaire_configuration.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_formulaire_configuration créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_formulaire_configuration source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_formulaire_configuration, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Tableau des erreurs
 */
function formulaires_editer_reservation_formulaire_configuration_verifier_dist($id_reservation_formulaire_configuration = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$erreurs = array();

	$erreurs = formulaires_editer_objet_verifier('reservation_formulaire_configuration', $id_reservation_formulaire_configuration, array('titre', 'type'));

	return $erreurs;
}

/**
 * Traitement du formulaire d'édition de reservation_formulaire_configuration
 *
 * Traiter les champs postés
 *
 * @uses formulaires_editer_objet_traiter()
 *
 * @param int|string $id_reservation_formulaire_configuration
 *     Identifiant du reservation_formulaire_configuration. 'new' pour un nouveau reservation_formulaire_configuration.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_formulaire_configuration créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_formulaire_configuration source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_formulaire_configuration, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Retours des traitements
 */
function formulaires_editer_reservation_formulaire_configuration_traiter_dist($id_reservation_formulaire_configuration = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$retours = formulaires_editer_objet_traiter('reservation_formulaire_configuration', $id_reservation_formulaire_configuration, '', $lier_trad, $retour, $config_fonc, $row, $hidden);

	// Un lien a prendre en compte ?
	if ($associer_objet and $id_reservation_formulaire_configuration = $retours['id_reservation_formulaire_configuration']) {
		list($objet, $id_objet) = explode('|', $associer_objet);

		if ($objet and $id_objet and autoriser('modifier', $objet, $id_objet)) {
			include_spip('action/editer_liens');

			objet_associer(array('reservation_formulaire_configuration' => $id_reservation_formulaire_configuration), array($objet => $id_objet));

			if (isset($retours['redirect'])) {
				$retours['redirect'] = parametre_url($retours['redirect'], 'id_lien_ajoute', $id_reservation_formulaire_configuration, '&');
			}
		}
	}

	return $retours;
}
