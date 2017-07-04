<?php
/**
 * Déclarations relatives à la base de données
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
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function reservations_formulaires_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['reservation_formulaires'] = 'reservation_formulaires';
	$interfaces['table_des_tables']['reservation_formulaire_configurations'] = 'reservation_formulaire_configurations';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function reservations_formulaires_declarer_tables_objets_sql($tables) {

	$tables['spip_reservation_formulaires'] = array(
		'type' => 'reservation_formulaire',
		'principale' => 'oui',
		'table_objet_surnoms' => array('reservationformulaire'), // table_objet('reservation_formulaire') => 'reservation_formulaires' 
		'field'=> array(
			'id_reservation_formulaire' => 'bigint(21) NOT NULL',
			'titre'              => 'varchar(255) NOT NULL DEFAULT ""',
			'descriptif'         => 'text NOT NULL DEFAULT ""',
			'date'               => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'statut'             => 'varchar(20)  DEFAULT "0" NOT NULL',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_reservation_formulaire',
			'KEY statut'         => 'statut',
		),
		'titre' => 'titre AS titre, "" AS lang',
		'date' => 'date',
		'champs_editables'  => array('titre', 'descriptif'),
		'champs_versionnes' => array('titre', 'descriptif'),
		'rechercher_champs' => array("titre" => 10, "descriptif" => 8),
		'tables_jointures'  => array('spip_reservation_formulaires_liens'),
		'statut_textes_instituer' => array(
			'prepa'    => 'texte_statut_en_cours_redaction',
			'prop'     => 'texte_statut_propose_evaluation',
			'publie'   => 'texte_statut_publie',
			'refuse'   => 'texte_statut_refuse',
			'poubelle' => 'texte_statut_poubelle',
		),
		'statut'=> array(
			array(
				'champ'     => 'statut',
				'publie'    => 'publie',
				'previsu'   => 'publie,prop,prepa',
				'post_date' => 'date',
				'exception' => array('statut','tout')
			)
		),
		'texte_changer_statut' => 'reservation_formulaire:texte_changer_statut_reservation_formulaire',


	);

	$tables['spip_reservation_formulaire_configurations'] = array(
		'type' => 'reservation_formulaire_configuration',
		'principale' => 'oui',
		'table_objet_surnoms' => array('reservationformulaireconfiguration'), // table_objet('reservation_formulaire_configuration') => 'reservation_formulaire_configurations' 
		'field'=> array(
			'id_reservation_formulaire_configuration' => 'bigint(21) NOT NULL',
			'titre'              => 'varchar(255) NOT NULL DEFAULT ""',
			'descriptif'         => 'text NOT NULL DEFAULT ""',
			'configuration'      => 'text NOT NULL DEFAULT ""',
			'type'               => 'varchar(25) NOT NULL DEFAULT ""',
			'date'               => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_reservation_formulaire_configuration',
		),
		'titre' => 'titre AS titre, "" AS lang',
		'date' => 'date',
		'champs_editables'  => array('titre', 'descriptif', 'configuration', 'type'),
		'champs_versionnes' => array('titre', 'descriptif', 'configuration', 'type'),
		'rechercher_champs' => array("titre" => 10, "descriptif" => 8),
		'tables_jointures'  => array('spip_reservation_formulaire_configurations_liens'),


	);

	return $tables;
}


/**
 * Déclaration des tables secondaires (liaisons)
 *
 * @pipeline declarer_tables_auxiliaires
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function reservations_formulaires_declarer_tables_auxiliaires($tables) {

	$tables['spip_reservation_formulaires_liens'] = array(
		'field' => array(
			'id_reservation_formulaire' => 'bigint(21) DEFAULT "0" NOT NULL',
			'id_objet'           => 'bigint(21) DEFAULT "0" NOT NULL',
			'objet'              => 'VARCHAR(25) DEFAULT "" NOT NULL',
			'vu'                 => 'VARCHAR(6) DEFAULT "non" NOT NULL',
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_reservation_formulaire,id_objet,objet',
			'KEY id_reservation_formulaire' => 'id_reservation_formulaire',
		)
	);
	$tables['spip_reservation_formulaire_configurations_liens'] = array(
		'field' => array(
			'id_reservation_formulaire_configuration' => 'bigint(21) DEFAULT "0" NOT NULL',
			'id_objet'           => 'bigint(21) DEFAULT "0" NOT NULL',
			'objet'              => 'VARCHAR(25) DEFAULT "" NOT NULL',
			'vu'                 => 'VARCHAR(6) DEFAULT "non" NOT NULL',
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_reservation_formulaire_configuration,id_objet,objet',
			'KEY id_reservation_formulaire_configuration' => 'id_reservation_formulaire_configuration',
		)
	);

	return $tables;
}
