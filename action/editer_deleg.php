<?php
/**
 * Formulaire de délégation du plugin Délégation
 *
 * @plugin     Délégation
 * @copyright  2019
 * @author     François Mauviard
 * @licence    GNU/GPL
 * @package    SPIP\Deleg\Autorisations
 *
 * Fonctions permettant l'insertion et la modification de délégations
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

// Basé sur editer_notation.php
include_spip('base/abstract_sql');
/**
 * Inserer une nouvelle note
 *
 * @param string $objet
 * @param int $id_objet
 * @return int|bool
 */

// Il faut tout d'anord revoir plusieurs choses :
// 1. D'abord si les champs sont bons et bien configurés
// 2. Si le nom de la table est bon.
// 3. enfin, $objet et $id_objet est un reliquat de notation, mais il est possible qu'ill serve mes intérêts car tout comme Delegation, Notation est basé sur l'idée qu'il puisse y avoir des notations sur des objets différents (brèves, threads, etc.)
function deleg_inserer($objet, $id_objet){
	$champs = array(
		"id_auteur" => 0,
		"objet" => $objet,
		"id_objet" => $id_objet,
		"delegue" => "",
		"ecrit" => "",
		"commente" => ""
	);

	// Envoyer aux plugins
	$champs = pipeline('pre_insertion',
		array(
			'args' => array(
				'table' => 'spip_deleg',
			),
			'data' => $champs
		)
	);

	$id_notation = sql_insertq("spip_deleg", $champs);

	pipeline('post_insertion',
		array(
			'args' => array(
				'table' => 'spip_deleg',
				'id_objet' => $id_deleg
			),
			'data' => $champs
		)
	);

	return $id_deleg;
}

/**
 * Modifier une délégation existante. J'en suis à peu près là. A priori, c'est bon pour deleg-supprimer (c'est fait). a nouveau, il va falloir tout corriger en fonction du nom des champs après correction.
 *
 * @param int $id_notation
 * @param array|null $set
 * @return bool|string
 */
function deleg_modifier($id_deleg, $set=null) {
	include_spip('inc/modifier');
	include_spip('inc/filtres');
	$c = collecter_requests(
		// white list. C'est à dire la liste des éléments qu'on peut modifier.
		array('id_auteur','ip','hash','cookie','note'),
		// black list : on ne peut pas changer sur quoi porte une note. C'est à dire la liste des éléments qu'on ne peut pas modifier.
		array("objet","id_objet"),
		// donnees eventuellement fournies
		$set
	);

	// recuperer l'objet sur lequel porte la notation
	$t = sql_fetsel("objet,id_objet", "spip_deleg", "id_deleg=".intval($id_deleg));
	if ($err = objet_modifier_champs('deleg', $id_deleg,
		array(
			'data' => $set,
		),
		$c))
		return $err;

	// invalider les caches
	include_spip('inc/invalideur');
	suivre_invalideur("id='deleg/".$t['objet']."/".$t['id_objet']."'");

	return $err;
}

/**
 * Supprimer une delegation existante. Notez que la délégation doit être terminée avant une date fixe. Pour l'instant, on ne va pas s'amuser à ajouter des chamos extras aux articles et rubriques pour savoir quand doit se finir la votation, mais c'est une chose à laquelle il va falloir penser.
 * 
 * @param int $id_deleg
 * @return bool
 */
function deleg_supprimer($id_deleg) {
	// recuperer l'objet sur lequel porte la notation
	$t = sql_fetsel("objet,id_objet", "spip_deleg", "id_deleg=".intval($id_deleg));


	// Envoyer aux plugins
	$champs = pipeline('pre_edition',
		array(
			'args' => array(
				'table' => 'spip_deleg',
				'id_objet' => $id_deleg,
				'action'=>'supprimer',
			),
			'data' => array()
		)
	);

	sql_delete('spip_deleg','id_deleg='.sql_quote($id_deleg));
	
	// Envoyer aux plugins
	$champs = pipeline('post_edition',
		array(
			'args' => array(
				'table' => 'spip_deleg',
				'id_objet' => $id_deleg,
				'action'=>'supprimer',
			),
			'data' => array()
		)
	);

	// invalider les caches
	include_spip('inc/invalideur');
	suivre_invalideur("id='deleg/".$t['objet']."/".$t['id_objet']."'");

	return true;
}

