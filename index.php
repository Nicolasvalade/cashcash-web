
<?php
// gestion des routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$domaine = '/cashcash';
$index = '/cashcash/index.php';

if ($index == $uri) {
  require_once 'views/accueil.php';
} elseif ($index . '/interventions' == $uri) {
  require_once 'controllers/interv_liste.php';
} elseif ($index . '/intervention' == $uri && isset($_GET['id'])) {
  require_once 'controllers/interv_details.php';
} elseif ($index . '/intervention/edit' == $uri && isset($_GET['id'])) {
  require_once 'controllers/interv_edit.php';
} elseif ($index . '/pdf/intervention' == $uri && isset($_GET['id'])) {
  require_once 'controllers/pdf/interv_pdf.php';
} elseif ($index . '/pdf/test' == $uri) {
  require_once 'controllers/pdf/test.php';
} else {
  header('Status: 404 Not Found');
  echo '<!DOCTYPE html><html><body><h1>' . $uri . ' : page Not Found</h1></body></html>';
}
