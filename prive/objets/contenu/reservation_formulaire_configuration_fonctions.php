<?php
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/reservations_formulaires');
include_spip('inc/saisies');

/*
 * no utilisé, verifier sens
 * function reservations_formulaires_traduire_configuration($type, $configuration) {

	$saisies = reservations_formulaires_charger_definitions($type);

	$configuration = json_decode($configuration, true);

	$saisies = saisies_lister_par_nom($saisies['saisies']['saisies']);

	$saisies_labels = array();

	$conf = array();
	foreach ($saisies AS $index => $values) {
		if (isset($values['saisie'])) {
			$label = $values['options']['label'];
		}
		elseif('saisies') {
			$saisies_labels[$index]['label'] = $label;
			$saisies_labels[$index]['name'] = $values['options']['nom'];
			$saisies_labels[$index['options']['nom']]['values'] = $values['options']['label'];
		}
	}

	foreach($configuration AS $champ => $valeur) {
		$conf['label'] = $saisies['noms'][$type];

		if(isset($saisies_labels[$champ])) {
			$conf[][$saisies_labels[$champ]] = $valeur;
		}
	}

	return $conf;
}*/