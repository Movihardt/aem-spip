<?php

function deleg_upgrade($nom_meta_base_version, $version_cible){
 
	$maj = array();
	$maj['create'] = array(
		array('maj_tables', array('spip_delegations')),
	);
 
	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}
 
function deleg_vider_tables($nom_meta_base_version) {
	sql_drop_table("spip_delegations");
	effacer_meta($nom_meta_base_version);
}