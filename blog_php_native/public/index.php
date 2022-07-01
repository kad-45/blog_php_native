<?php
//session_start() crée une session ou restaure celle trouvée sur le serveur, via l'identifiant de session passé dans une requête GET, POST ou par un cookie.
session_start();
require_once  dirname(__DIR__) . "/src/service/router.php";
require_once  dirname(__DIR__) . "/template/base.phtml";
//require_once  dirname(__DIR__) . "/template/Contact/contact.phtml";
//require_once  dirname(__DIR__) . "/template/template_part/__navbar.phtml";