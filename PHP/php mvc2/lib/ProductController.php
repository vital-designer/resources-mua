<?php
/**
 *  Controls the application
 */
class ProductController {
    var $model;
    var $view;

    //! A constructor.
    /**
    * Constucts a new ProductController object
    * @param $model an instance of the ProductModel class
    * @param $getvars the incoming HTTP GET method variables
    */
    function ProductController (& $dao) {
        $this->model=& new ProductModel($dao);
    }
}

class ProductItemController extends ProductController {
   //! A constructor.
    /**
    * Constucts a new ProductItemController object
    * @param $model an instance of the ProductModel class
    * @param $getvars the incoming HTTP GET method variables
    */
    function ProductItemController (& $dao,$getvars=null) {
        ProductController::ProductController($dao);
        $this->view=& new ProductItemView($this->model,$getvars['id']);
    }

    function & getView () {
        return $this->view;
    }
}

class ProductTableController extends ProductController {
   //! A constructor.
    /**
    * Constucts a new ProductTableController object
    * @param $model an instance of the ProductModel class
    * @param $getvars the incoming HTTP GET method variables
    */
    function ProductTableController (& $dao,$getvars=null) {
        ProductController::ProductController($dao);
        if ( !isset ($getvars['rowsperpage']) )
            $rowsperpage=20;
        if ( !isset ($getvars['rownum']) )
            $getvars['rownum']=1;
        $this->view=& new ProductTableView($this->model,
                                    $rowsperpage,
                                    $getvars['rownum']);
    }

    function & getView () {
        return $this->view;
    }
}
?>