<?php
require_once('lib/DataAccess.php');
require_once('lib/ProductModel.php');
require_once('lib/ProductView.php');
require_once('lib/ProductController.php');

$dao=& new DataAccess ('localhost','user','pass','dbname');
switch ( $_GET['view'] ) {
    case "product":
        $controller=& new ProductItemController($dao,$_GET);
        break;
    default:
        $controller=& new ProductTableController($dao,$_GET);
        break;
}
$view=$controller->getView();
echo ("<pre>" );
// print_r($controller);
echo ("</pre>" );
echo ($view->display());
?>