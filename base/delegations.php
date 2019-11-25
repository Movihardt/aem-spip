<?php 
/**
 * Plugin Delegation
 * par Movihardt (fmauviard@mobile-adenum.fr) 
 *
 * Copyright (c) 2019
 * Logiciel libre distribue sous licence GNU/GPL.
 * 
**/

/**
 * Insertion dans le pipeline declarer_tables_principales (SPIP)
 * Déclarer la table principale spip_declarations pour le compilateur
 * 
 * @pipeline declarer_tables_principales
 * @param array $tables_principales
 * 		Déclarations des tables pour le compilateur
 * @return array
 * 		Déclarations des tables pour le compilateur
 */
function deleg_declarer_tables_principales($tables_principales){
	
	/**
	 * Un champ accepter_deleg sur les articles permettant de choisir si oui ou non on peut déléguer un vote pour 
	 * l'article
	 */
	$tables_principales['spip_articles']['field']['accepter_deleg'] = "CHAR(3) DEFAULT '' NOT NULL";

	// Cette table reçoit les délégations, associées aux votes possibles du plugin Notation.
	// Modification au 24 Novembre : j'ai ôté vote et mis tout en tinytext (pour oui/non, c'est plus simple). Je garde id_notation pour l'instant, mais il n'est pas nécessaire.

	$spip_delegations = array(
		"id_delegation"	=> "bigint(21) NOT NULL",
		"id_notation"	=> "bigint(21) NOT NULL",
		"id_auteur1"	=> "bigint(21) NOT NULL",
		"id_auteur2"	=> "bigint(21) NOT NULL",
		"id_objet"	=> "bigint(21) NOT NULL",
		"objet"	=> "tinytext DEFAULT '' NOT NULL",
		"ecrit"	=> "tinytext DEFAULT '' NOT NULL",
		"commente"	=> "tinytext DEFAULT '' NOT NULL",
	);

	$spip_delegations_key = array(
		"PRIMARY KEY" => "id_delegation"
	);

	$tables_principales['spip_delegations'] = array(
		'field' => &$spip_delegations,
		'key' => &$spip_delegations_key
	);
 
	return $tables_principales;
}