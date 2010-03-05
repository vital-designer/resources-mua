<?php
/**
 *  Binds product data to HTML rendering
 */
class ProductView {
    /**
    * Private
    * $model an instance of the ProductModel class
    */
    var $model;

    /**
    * Private
    * $output rendered HTML is stored here for display
    */
    var $output;

    //! A constructor.
    /**
    * Constucts a new ProductView object
    * @param $model an instance of the ProductModel class
    */
    function ProductView (&$model) {
        $this->model=& $model;
    }

    //! A manipulator
    /**
    * Builds the top of an HTML page
    * @return void
    */
    function header () {
        $this->output=<<<EOD
<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> Our Products </title>
<style>
body { font-size: 13.75px; font-family: verdana }
td { font-size: 13.75px; font-family: verdana }
.title { font-size: 15.75px; font-weight: bold; font-family: verdana }
.heading {
    font-size: 13.75px; font-weight: bold;
    font-family: verdana; background-color: #f7f8f9 }
.nav { background-color: #f7f8f9 }
</style>
</head>
<body>
<div align="center" class="title">Our Products</div>
EOD;
        $this->output.="\n<div align=\"right\"><a href=\"".
            $_SERVER['PHP_SELF']."\">Start Over</a></div>\n";

    }

    //! A manipulator
    /**
    * Builds the bottom of an HTML page
    * @return void
    */
    function footer () {
        $this->output.="</body>\n</html>";
    }
}

class ProductItemView extends ProductView {
    /**
    * Private
    * $productID ID of product to render
    */
    var $productID;

    //! A constructor.
    /**
    * Constucts a new ProductView object
    * @param $model an instance of the ProductModel class
    */
    function ProductItemView (&$model,$productID) {
        ProductView::ProductView($model);
        $this->productID=$productID;
    }

    //! A manipulator
    /**
    * Renders a single product
    * @return void
    */
    function productItem() {
        $this->model->listProduct($this->productID);
        while ( $product=$this->model->getProduct() ) {
            $this->output.="<p><b>Name</b>:".$product['PRODUCTNAME']."</p>".
                "<p><b>Price</b>:".$product['UNITPRICE']."</p>".
                "<p><b># In Stock</b>:".$product['UNITSINSTOCK']."</p>";
            if ( $product['DISCONTINUED']==1 ) {
                $this->output.="<p>This product has been discontinued.</p>";
            }
        }
    }

    //! An accessor
    /**
    * Returns the rendered HTML
    * @return string
    */
    function display () {
        $this->header();
        $this->productItem();
        $this->footer();
        return $this->output;
    }
}

class ProductTableView extends ProductView {
    /**
    * Private
    * $rowsperpage number of results per page
    */
    var $rowsPerPage;
    /**
    * Private
    * $rownum begin display of rows at this ID
    */
    var $rowNum;

    //! A constructor.
    /**
    * Constucts a new ProductView object
    * @param $model an instance of the ProductModel class
    */
    function ProductTableView (&$model,$rowsPerPage=20,$rowNum=1) {
        ProductView::ProductView($model);
        $this->rowsPerPage=$rowsPerPage;
        $this->rowNum=$rowNum;
    }

    //! A manipulator
    /**
    * Renders a product table
    * @return void
    */
    function productTable() {
        $this->model->listProducts($this->rowNum,$this->rowsPerPage);
        $this->output.="<table width=\"600\" align=\"center\">\n<tr>\n".
                "<td class=\"heading\">Name</td>\n".
                "<td class=\"heading\">Price</td>\n</tr>\n";
        while ( $product=$this->model->getProduct() ) {
            $lastID=$product['PRODUCTID'];
            $this->output.="<tr>\n<td><a href=\"".$_SERVER['PHP_SELF'].
                "?view=product&id=".$product['PRODUCTID']."\">".
                $product['PRODUCTNAME']."</a></td>".
                "<td>".$product['UNITPRICE']."</td>\n</tr>\n";
        }
        $this->output.="<tr class=\"nav\">\n";
        if ( $this->rowNum > 0 && $this->rowNum > $this->rowsPerPage ) {
            $this->output.="<td><a href=\"".$_SERVER['PHP_SELF'].
                "?view=table&rownum=".($this->rowNum-$this->rowsPerPage).
                "\"><< Prev</a></td>";
        } else {
            $this->output.="<td>&nbsp;</td>";            
        }
        if ( $this->rowsPerPage <= ( $lastID - $this->rowNum ) ) {
            $this->output.="<td><a href=\"".$_SERVER['PHP_SELF'].
                "?view=table&rownum=".($this->rowNum+$this->rowsPerPage).
                "\">Next >></a></td>";
        } else {
            $this->output.="<td>&nbsp;</td>\n";            
        }
        $this->output.="</tr>\n</table>\n";
    }

    //! An accessor
    /**
    * Returns the rendered HTML
    * @return string
    */
    function display () {
        $this->header();
        $this->productTable();
        $this->footer();
        return $this->output;
    }
}
?>