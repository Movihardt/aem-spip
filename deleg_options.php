<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

// on protège les formulaires de notation d'attaques de type CSRF (absurbe mais welcome on internet...)
$GLOBALS['formulaires_no_spam'][] = 'delegation';

