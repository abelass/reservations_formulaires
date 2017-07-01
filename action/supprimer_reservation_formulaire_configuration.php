<?php
/**
 * Utilisation de l'action supprimer pour l'objet reservation_formulaire_configuration
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
 * Action pour supprimer un·e reservation_formulaire_configuration
 *
 * Vérifier l'autorisation avant d'appeler l'action.
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, reservation_formulaire_configuration, #ID_RESERVATION_FORMULAIRE_CONFIGURATION}|oui)
 *         [(#BOUTON_ACTION{<:reservation_formulaire_configuration:supprimer_reservation_formulaire_configuration:>,
 *             #URL_ACTION_AUTEUR{supprimer_reservation_formulaire_configuration, #ID_RESERVATION_FORMULAIRE_CONFIGURATION, #URL_ECRIRE{reservation_formulaire_configurations}},
 *             danger, <:reservation_formulaire_configuration:confirmer_supprimer_reservation_formulaire_configuration:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, reservation_formulaire_configuration, #ID_RESERVATION_FORMULAIRE_CONFIGURATION}|oui)
 *         [(#BOUTON_ACTION{
 *             [(#CHEMIN_IMAGE{reservation_formulaire_configuration-del-24.png}|balise_img{<:reservation_formulaire_configuration:supprimer_reservation_formulaire_configuration:>}|concat{' ',#VAL{<:reservation_formulaire_configuration:supprimer_reservation_formulaire_configuration:>}|wrap{<b>}}|trim)],
 *             #URL_ACTION_AUTEUR{supprimer_reservation_formulaire_configuration, #ID_RESERVATION_FORMULAIRE_CONFIGURATION, #URL_ECRIRE{reservation_formulaire_configurations}},
 *             icone s24 horizontale danger reservation_formulaire_configuration-del-24, <:reservation_formulaire_configuration:confirmer_supprimer_reservation_formulaire_configuration:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     if (autoriser('supprimer', 'reservation_formulaire_configuration', $id_reservation_formulaire_configuration)) {
 *          $supprimer_reservation_formulaire_configuration = charger_fonction('supprimer_reservation_formulaire_configuration', 'action');
 *          $supprimer_reservation_formulaire_configuration($id_reservation_formulaire_configuration);
 *     }
 *     ```
 *
 * @param null|int $arg
 *     Identifiant à supprimer.
 *     En absence de id utilise l'argument de l'action sécurisée.
**/
function action_supprimer_reservation_formulaire_configuration_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$arg = intval($arg);

	// cas suppression
	if ($arg) {
		sql_delete('spip_reservation_formulaire_configurations',  'id_reservation_formulaire_configuration=' . sql_quote($arg));
	}
	else {
		spip_log("action_supprimer_reservation_formulaire_configuration_dist $arg pas compris");
	}
}
