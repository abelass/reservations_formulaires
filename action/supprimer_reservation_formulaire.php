<?php
/**
 * Utilisation de l'action supprimer pour l'objet reservation_formulaire
 *
 * @plugin     Réservations formulaires
 * @copyright  2017
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Reservations_formulaires\Action
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



/**
 * Action pour supprimer un·e reservation_formulaire
 *
 * Vérifier l'autorisation avant d'appeler l'action.
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, reservation_formulaire, #ID_RESERVATION_FORMULAIRE}|oui)
 *         [(#BOUTON_ACTION{<:reservation_formulaire:supprimer_reservation_formulaire:>,
 *             #URL_ACTION_AUTEUR{supprimer_reservation_formulaire, #ID_RESERVATION_FORMULAIRE, #URL_ECRIRE{reservation_formulaires}},
 *             danger, <:reservation_formulaire:confirmer_supprimer_reservation_formulaire:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, reservation_formulaire, #ID_RESERVATION_FORMULAIRE}|oui)
 *         [(#BOUTON_ACTION{
 *             [(#CHEMIN_IMAGE{reservation_formulaire-del-24.png}|balise_img{<:reservation_formulaire:supprimer_reservation_formulaire:>}|concat{' ',#VAL{<:reservation_formulaire:supprimer_reservation_formulaire:>}|wrap{<b>}}|trim)],
 *             #URL_ACTION_AUTEUR{supprimer_reservation_formulaire, #ID_RESERVATION_FORMULAIRE, #URL_ECRIRE{reservation_formulaires}},
 *             icone s24 horizontale danger reservation_formulaire-del-24, <:reservation_formulaire:confirmer_supprimer_reservation_formulaire:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     if (autoriser('supprimer', 'reservation_formulaire', $id_reservation_formulaire)) {
 *          $supprimer_reservation_formulaire = charger_fonction('supprimer_reservation_formulaire', 'action');
 *          $supprimer_reservation_formulaire($id_reservation_formulaire);
 *     }
 *     ```
 *
 * @param null|int $arg
 *     Identifiant à supprimer.
 *     En absence de id utilise l'argument de l'action sécurisée.
**/
function action_supprimer_reservation_formulaire_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$arg = intval($arg);

	// cas suppression
	if ($arg) {
		sql_delete('spip_reservation_formulaires',  'id_reservation_formulaire=' . sql_quote($arg));
	}
	else {
		spip_log("action_supprimer_reservation_formulaire_dist $arg pas compris");
	}
}
