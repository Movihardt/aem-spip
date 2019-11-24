<?php

function balise_DELEGATION_MODALE ($p) {
	$args = array();
	return calculer_balise_dynamique ($p, 'DELEGATION_MODALE' , $args);
};


function balise_DELEGATION_MODALE_stat($args, $filtres) {
	include_spip("balise/formulaire_notation");
	return balise_FORMULAIRE_NOTATION_stat($args,$filtres);
}
?>