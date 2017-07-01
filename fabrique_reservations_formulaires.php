<?php

/**
 *  Fichier généré par la Fabrique de plugin v6
 *   le 2017-07-01 17:14:23
 *
 *  Ce fichier de sauvegarde peut servir à recréer
 *  votre plugin avec le plugin «Fabrique» qui a servi à le créer.
 *
 *  Bien évidemment, les modifications apportées ultérieurement
 *  par vos soins dans le code de ce plugin généré
 *  NE SERONT PAS connues du plugin «Fabrique» et ne pourront pas
 *  être recréées par lui !
 *
 *  La «Fabrique» ne pourra que régénerer le code de base du plugin
 *  avec les informations dont il dispose.
 *
**/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$data = array (
  'fabrique' => 
  array (
    'version' => 6,
  ),
  'paquet' => 
  array (
    'prefixe' => 'reservations_formulaires',
    'nom' => 'Réservations formulaires',
    'slogan' => 'Gérer ses formulaires depuis l\'espace privé',
    'description' => 'Permet d\'attacher depuis l\'espace privé des formulaires à un objet d\'en définir ces caractéristiques et de l\'afficher en conséquence sur le site public.

',
    'logo' => 
    array (
      0 => '',
    ),
    'version' => '1.0.0',
    'auteur' => 'Rainer Müller',
    'auteur_lien' => '',
    'licence' => 'GNU/GPL',
    'categorie' => 'maintenance',
    'etat' => 'dev',
    'compatibilite' => '[3.1.6;3.2.*]',
    'documentation' => '',
    'administrations' => 'on',
    'schema' => '1.0.0',
    'formulaire_config' => 'on',
    'formulaire_config_titre' => 'Configurations',
    'fichiers' => 
    array (
      0 => 'autorisations',
      1 => 'fonctions',
      2 => 'pipelines',
    ),
    'inserer' => 
    array (
      'paquet' => '',
      'administrations' => 
      array (
        'maj' => '',
        'desinstallation' => '',
        'fin' => '',
      ),
      'base' => 
      array (
        'tables' => 
        array (
          'fin' => '',
        ),
      ),
    ),
    'scripts' => 
    array (
      'pre_copie' => '',
      'post_creation' => '',
    ),
    'exemples' => 'on',
  ),
  'objets' => 
  array (
    0 => 
    array (
      'nom' => 'Formulaires de réservation',
      'nom_singulier' => 'Formulaire de réservation',
      'genre' => 'masculin',
      'logo' => 
      array (
        0 => '',
        32 => '',
        24 => '',
        16 => '',
        12 => '',
      ),
      'logo_variantes' => 'on',
      'table' => 'spip_reservation_formulaires',
      'cle_primaire' => 'id_reservation_formulaire',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'reservation_formulaire',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'Titre',
          'champ' => 'titre',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '10',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'Déscriptif',
          'champ' => 'descriptif',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '8',
          'saisie' => 'textarea',
          'explication' => '',
          'saisie_options' => 'conteneur_class=pleine_largeur, class=inserer_barre_edition, rows=4',
        ),
      ),
      'champ_titre' => 'titre',
      'champ_date' => 'date',
      'statut' => 'on',
      'chaines' => 
      array (
        'titre_objets' => 'Formulaires de réservation',
        'titre_objet' => 'Formulaire de réservation',
        'info_aucun_objet' => 'Aucun formulaire de réservation',
        'info_1_objet' => 'Un formulaire de réservation',
        'info_nb_objets' => '@nb@ formulaires de réservation',
        'icone_creer_objet' => 'Créer un formulaire de réservation',
        'icone_modifier_objet' => 'Modifier ce formulaire de réservation',
        'titre_logo_objet' => 'Logo de ce formulaire de réservation',
        'titre_langue_objet' => 'Langue de ce formulaire de réservation',
        'texte_definir_comme_traduction_objet' => 'Ce formulaire de réservation est une traduction du formulaire de réservation numéro :',
        'titre_\\objets_lies_objet' => 'Liés à ce formulaire de réservation',
        'titre_objets_rubrique' => 'Formulaires de réservation de la rubrique',
        'info_objets_auteur' => 'Les formulaires de réservation de cet auteur',
        'retirer_lien_objet' => 'Retirer ce formulaire de réservation',
        'retirer_tous_liens_objets' => 'Retirer tous les formulaires de réservation',
        'ajouter_lien_objet' => 'Ajouter ce formulaire de réservation',
        'texte_ajouter_objet' => 'Ajouter un formulaire de réservation',
        'texte_creer_associer_objet' => 'Créer et associer un formulaire de réservation',
        'texte_changer_statut_objet' => 'Ce formulaire de réservation est :',
        'supprimer_objet' => 'Supprimer cet formulaire de réservation',
        'confirmer_supprimer_objet' => 'Confirmez-vous la suppression de cet formulaire de réservation ?',
      ),
      'liaison_directe' => '',
      'table_liens' => '',
      'vue_liens' => 
      array (
        0 => 'spip_articles',
      ),
      'afficher_liens' => 'on',
      'roles' => '',
      'auteurs_liens' => 'on',
      'vue_auteurs_liens' => 'on',
      'fichiers' => 
      array (
        'echafaudages' => 
        array (
          0 => 'prive/squelettes/contenu/objets.html',
          1 => 'prive/objets/infos/objet.html',
          2 => 'prive/squelettes/contenu/objet.html',
        ),
        'explicites' => 
        array (
          0 => 'action/supprimer_objet.php',
        ),
      ),
      'saisies' => 
      array (
        0 => 'objets',
      ),
      'autorisations' => 
      array (
        'objet_creer' => '',
        'objet_voir' => '',
        'objet_modifier' => '',
        'objet_supprimer' => '',
        'associerobjet' => '',
      ),
      'boutons' => 
      array (
        0 => 'menu_edition',
      ),
    ),
    1 => 
    array (
      'nom' => 'Configurations de formulaire',
      'nom_singulier' => 'Configuration de formulaire',
      'genre' => 'feminin',
      'logo' => 
      array (
        32 => '',
        24 => '',
        16 => '',
        12 => '',
      ),
      'logo_variantes' => '',
      'table' => 'spip_reservation_formulaire_configurations',
      'cle_primaire' => 'id_reservation_formulaire_configuration',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'reservation_formulaire_configuration',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'Titre',
          'champ' => 'titre',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '10',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'Déscriptif',
          'champ' => 'descriptif',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '8',
          'saisie' => 'textarea',
          'explication' => '',
          'saisie_options' => '',
        ),
        2 => 
        array (
          'nom' => 'Configuration',
          'champ' => 'configuration',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => '',
          'explication' => '',
          'saisie_options' => '',
        ),
        3 => 
        array (
          'nom' => 'Type de configuration',
          'champ' => 'type',
          'sql' => 'varchar(25) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'selection',
          'explication' => '',
          'saisie_options' => '',
        ),
      ),
      'champ_titre' => 'titre',
      'champ_date' => 'date',
      'statut' => '',
      'chaines' => 
      array (
        'titre_objets' => 'Configurations de formulaire',
        'titre_objet' => 'Configuration de formulaire',
        'info_aucun_objet' => 'Aucune configuration de formulaire',
        'info_1_objet' => 'Une configuration de formulaire',
        'info_nb_objets' => '@nb@ configurations de formulaire',
        'icone_creer_objet' => 'Créer une configuration de formulaire',
        'icone_modifier_objet' => 'Modifier cette configuration de formulaire',
        'titre_logo_objet' => 'Logo de cette configuration de formulaire',
        'titre_langue_objet' => 'Langue de cette configuration de formulaire',
        'texte_definir_comme_traduction_objet' => 'Cette configuration de formulaire est une traduction de la configuration de formulaire numéro :',
        'titre_\\objets_lies_objet' => 'Liés à cette configuration de formulaire',
        'titre_objets_rubrique' => 'Configurations de formulaire de la rubrique',
        'info_objets_auteur' => 'Les configurations de formulaire de cet auteur',
        'retirer_lien_objet' => 'Retirer cette configuration de formulaire',
        'retirer_tous_liens_objets' => 'Retirer toutes les configurations de formulaire',
        'ajouter_lien_objet' => 'Ajouter cette configuration de formulaire',
        'texte_ajouter_objet' => 'Ajouter une configuration de formulaire',
        'texte_creer_associer_objet' => 'Créer et associer une configuration de formulaire',
        'texte_changer_statut_objet' => 'Cette configuration de formulaire est :',
        'supprimer_objet' => 'Supprimer cette configuration de formulaire',
        'confirmer_supprimer_objet' => 'Confirmez-vous la suppression de cette configuration de formulaire ?',
      ),
      'liaison_directe' => '',
      'table_liens' => '',
      'vue_liens' => 
      array (
        0 => 'spip_reservation_formulaires',
      ),
      'afficher_liens' => 'on',
      'roles' => '',
      'auteurs_liens' => 'on',
      'vue_auteurs_liens' => 'on',
      'autorisations' => 
      array (
        'objet_creer' => '',
        'objet_voir' => '',
        'objet_modifier' => '',
        'objet_supprimer' => '',
        'associerobjet' => '',
      ),
    ),
  ),
  'images' => 
  array (
    'paquet' => 
    array (
      'logo' => 
      array (
        0 => 
        array (
          'extension' => 'png',
          'contenu' => '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',
        ),
      ),
    ),
    'objets' => 
    array (
      0 => 
      array (
        'logo' => 
        array (
          0 => 
          array (
            'extension' => 'png',
            'contenu' => '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',
          ),
        ),
      ),
      1 => 
      array (
        'logo' => 
        array (
          0 => 
          array (
            'extension' => 'png',
            'contenu' => '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',
          ),
        ),
      ),
    ),
  ),
);
