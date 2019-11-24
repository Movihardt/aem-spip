<?php 
/**
 * Plugin Delegation
 * par Movihardt (fmauviard@mobile-adenum.fr) 
 *
 * Copyright (c) 2019
 * Logiciel libre distribue sous licence GNU/GPL.
 * 
**/

function deleg_declarer_tables_objets_sql($tables){
	$tables['spip_delegations'] = array(
 
		'principale' => "oui",
		'field'=> array(
			"id_delegation"	=> "bigint(21) NOT NULL",
			"id_notation"	=> "bigint(21) NOT NULL",
			"id_auteur1"	=> "bigint(21) NOT NULL",
			"id_auteur2"	=> "bigint(21) NOT NULL",
			"id_objet"	=> "bigint(21) NOT NULL",
			"objet"	=> "tinytext DEFAULT '' NOT NULL",
			"vote"	=> "TINYINT(1) NOT NULL DEFAULT '0'",
			"ecrit"	=> "TINYINT(1) NOT NULL DEFAULT '0'",
			"commente"	=> "TINYINT(1) NOT NULL DEFAULT '0'"
		),
		'key' => array(
			"PRIMARY KEY"	=> "id_delegation",
		)
	);
 
	return $tables;
}