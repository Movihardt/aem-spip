<?php
/**
 * Utilisations de pipelines par Délégation
 *
 * @plugin     Délégation
 * @copyright  2019
 * @author     François Mauviard
 * @licence    GNU/GPL
 * @package    SPIP\Deleg\Pipelines
 */
<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Inserer les css de notation
 * @param string $flux
 * @return string
 */
function deleg_insert_head_css($flux){
	$flux .= '<link rel="stylesheet" href="'.find_in_path('css/delegation.css').'" type="text/css" media="all" />';
	return $flux;
}

