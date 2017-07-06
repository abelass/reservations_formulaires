<?php

function rf_recuperer_contexte($env) {
	$env = unserialize($env);
	if (!isset($env['objet']) or (isset($env['objet']) and empty($env['objet']))) {
		$url =  ltrim(self(), '/');
		list($objet, $ids) = urls_decoder_url($url);
		if ($objet) {
			$options = array();
			$champ_id_table = id_table_objet($objet);
			$id_objet = isset($env[$champ_id_table]) ? $env[$champ_id_table] :
				isset($env['id_objet']) ? $env['id_objet'] :
					isset($env['id']) ? $env['id'] :
					isset($ids[$champ_id_table]) ? $ids[$champ_id_table] : '';

			if ($id_objet) {
				$id_reservation_formulaire = sql_getfetsel(
						'id_reservation_formulaire',
						'spip_reservation_formulaires_liens',
						'objet=' .sql_quote($objet) . ' AND id_objet=' . $id_objet);
				$options['id_reservation_formulaire'] = $id_reservation_formulaire;

			}
		}
	}
	set_request('options', $options);
	return array_merge($env, array('options' => $options));
}
