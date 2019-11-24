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
 * Tiré de l'exemple de Saisies dans CVT.
 */
function mes_saisies_deleguer() {
  $mes_saisies = array(
    array(
      'saisie' => 'fieldset',
      'options' => array(
        'nom' => 'delegation',
        'label' => _T('deleg_titre')
      ),
      'saisies' => array(
        array(
            'saisie' => 'hidden',
            'options' => array(
              'nom' => 'auteur',
              'defaut' => ''
            )
        ),        
        array(
            'saisie' => 'hidden',
            'options' => array(
              'nom' => 'id_objet',
              'defaut' => ''
            )
        ),        
        array(
            'saisie' => 'hidden',
            'options' => array(
              'nom' => 'objet',
              'defaut' => ''
            )
        ),        
        array(
            'saisie' => 'auteurs',
            'options' => array(
              'nom' => 'delegue',
              'label' => _T('choix_auteur'),
              'explication' => _T('explications_choix_auteur'),
              '' => '',
              'obligatoire' => 'oui'
            )
        ),
        array(
    		'saisie' => 'radio',
    		'options' => array(
        		'nom' => 'ecrit',
        		'label' => _T('peut_ecrire'),
        		'datas' => array(
        			'oui' => 'Oui',
        			'non' => 'Non'
        		),
        		'defaut' => 'oui'
    		)
    	),
        array(
    		'saisie' => 'radio',
    		'options' => array(
        		'nom' => 'commente',
        		'label' => _T('peut_commenter'),
        		'datas' => array(
        			'oui' => 'Oui',
        			'non' => 'Non'
        		),
        		'defaut' => 'oui'
    		)
    	),

      )
    ),
    array(
      'saisie' => 'mon_submit',
      'options' => array (
        'nom' => 'envoyer',
        'texte' => 'Je délègue'
      )
    )
  );
  return $mes_saisies;
}

function formulaires_deleguer_charger_dist($arg1) {
// on charge les champs et les saisies qui nécessitent un accès par les fonctions
  $valeurs = array(
    'auteur' => $arg1,
    'id_objet' => '',
    'objet' => '',
    'delegue' => '',
    'commente' => '',
    'ecrit' => '',
    'mes_saisies' => mes_saisies_deleguer()
  );
  return $valeurs;
}

function formulaires_deleguer_verifier_dist() {
  // on va chercher le pipeline saisies_verifier() dans son fichier
  include_spip('inc/saisies');
  // on récupère les saisies
  $mes_saisies = mes_saisies_deleguer();
  // saisies_verifier retourne un tableau des erreurs s'il y en a, sinon traiter() prend le relais
  return saisies_verifier($mes_saisies);
}

function formulaires_deleguer_traiter_dist() {
  // on charge les saisies, si besoin
  // $mes_saisies = mes_saisies_film();
  
  // Traitement des données reçues du formulaire, 
  // par mail par ex ou insertion dans une base
  //  ...
   
  // S'il y a des erreurs, elles sont retournées au formulaire
  // return array('message_erreur'=>'Le film n\'a pas été enregistré');
  
  // Sinon, le message de confirmation est envoyé
  return array('message_ok'=>'Le film a été enregistré');
}


?>