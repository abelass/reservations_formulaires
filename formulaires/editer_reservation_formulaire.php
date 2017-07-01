<?php
/**
 * Gestion du formulaire de d'édition de reservation_formulaire
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
function reservation_formulaire_definition_saisies($type_promotion, $valeurs = array()) {

	// Chercher les fichiers promotions
	$configurations = find_all_in_path("formulaire_configurations/", '^');

	$promotions_noms = array();
	$promotions_defs = array();

	$promotions_dispos = isset($valeurs['promotions']) ? $valeurs['promotions'] : '';
	$rangs = isset($valeurs['rangs']) ? $valeurs['rangs'] : '';
	$nombre_promotions = isset($valeurs['nombre_promotions']) ? $valeurs['nombre_promotions'] : 0;

	if (is_array($promotions)) {
		foreach ($promotions as $fichier => $chemin) {
			list($nom, $extension) = explode('.', $fichier);
			// Charger la définition des champs
			if ($defs = charger_fonction($nom, "promotions", true)) {
				$promotion = $defs($valeurs);
				if ($type_promotion == $nom and isset($promotion['saisies'])) {
					$promotions_defs = array(
						array(
							'saisie' => 'fieldset',
							'options' => array(
								'nom' => 'specifique',
								'label' => _T('promotion:label_parametres_specifiques')
							),
							'saisies' => $promotion['saisies']
						)
					);
				}
				// Lister les promotions dipsonibles
				if (isset($promotion['nom']))
					$promotions_noms[$nom] = $promotion['nom'];
			}
		}
	}



	$saisies = array_merge($promotions_defs);

	return $saisies;
}


/**
 * Identifier le formulaire en faisant abstraction des paramètres qui ne représentent pas l'objet edité
 *
 * @param int|string $id_reservation_formulaire
 *     Identifiant du reservation_formulaire. 'new' pour un nouveau reservation_formulaire.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_formulaire créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_formulaire source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_formulaire, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return string
 *     Hash du formulaire
 */
function formulaires_editer_reservation_formulaire_identifier_dist($id_reservation_formulaire = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	return serialize(array(intval($id_reservation_formulaire), $associer_objet));
}

/**
 * Chargement du formulaire d'édition de reservation_formulaire
 *
 * Déclarer les champs postés et y intégrer les valeurs par défaut
 *
 * @uses formulaires_editer_objet_charger()
 *
 * @param int|string $id_reservation_formulaire
 *     Identifiant du reservation_formulaire. 'new' pour un nouveau reservation_formulaire.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_formulaire créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_formulaire source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_formulaire, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Environnement du formulaire
 */
function formulaires_editer_reservation_formulaire_charger_dist($id_reservation_formulaire = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$valeurs = formulaires_editer_objet_charger('reservation_formulaire', $id_reservation_formulaire, '', $lier_trad, $retour, $config_fonc, $row, $hidden);
	return $valeurs;
}

/**
 * Vérifications du formulaire d'édition de reservation_formulaire
 *
 * Vérifier les champs postés et signaler d'éventuelles erreurs
 *
 * @uses formulaires_editer_objet_verifier()
 *
 * @param int|string $id_reservation_formulaire
 *     Identifiant du reservation_formulaire. 'new' pour un nouveau reservation_formulaire.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_formulaire créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_formulaire source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_formulaire, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Tableau des erreurs
 */
function formulaires_editer_reservation_formulaire_verifier_dist($id_reservation_formulaire = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$erreurs = array();

	$erreurs = formulaires_editer_objet_verifier('reservation_formulaire', $id_reservation_formulaire, array('titre'));

	return $erreurs;
}

/**
 * Traitement du formulaire d'édition de reservation_formulaire
 *
 * Traiter les champs postés
 *
 * @uses formulaires_editer_objet_traiter()
 *
 * @param int|string $id_reservation_formulaire
 *     Identifiant du reservation_formulaire. 'new' pour un nouveau reservation_formulaire.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param string $associer_objet
 *     Éventuel `objet|x` indiquant de lier le reservation_formulaire créé à cet objet,
 *     tel que `article|3`
 * @param int $lier_trad
 *     Identifiant éventuel d'un reservation_formulaire source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du reservation_formulaire, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Retours des traitements
 */
function formulaires_editer_reservation_formulaire_traiter_dist($id_reservation_formulaire = 'new', $retour = '', $associer_objet = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$retours = formulaires_editer_objet_traiter('reservation_formulaire', $id_reservation_formulaire, '', $lier_trad, $retour, $config_fonc, $row, $hidden);

	// Un lien a prendre en compte ?
	if ($associer_objet and $id_reservation_formulaire = $retours['id_reservation_formulaire']) {
		list($objet, $id_objet) = explode('|', $associer_objet);

		if ($objet and $id_objet and autoriser('modifier', $objet, $id_objet)) {
			include_spip('action/editer_liens');

			objet_associer(array('reservation_formulaire' => $id_reservation_formulaire), array($objet => $id_objet));

			if (isset($retours['redirect'])) {
				$retours['redirect'] = parametre_url($retours['redirect'], 'id_lien_ajoute', $id_reservation_formulaire, '&');
			}
		}
	}

	return $retours;
}
