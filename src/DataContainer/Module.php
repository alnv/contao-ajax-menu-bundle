<?php

namespace Alnv\ContaoAjaxMenuBundle\DataContainer;

class Module {

    private $objDatabase = null;


    public function __construct() {

        $this->objDatabase = \Database::getInstance();
    }


    public function getNavigationIds() {

        $arrRows = [];
        $arrTypes = [ 'navigation', 'customnav', 'breadcrumb', 'quicknav', 'quicklink', 'booknav', 'articlenav', 'sitemap', 'html' ];
        $objNavigation = $this->objDatabase->prepare( 'SELECT * FROM tl_module' )->execute();

        if ( $objNavigation->numRows ) {

            while ( $objNavigation->next() ) {

                if ( in_array( $objNavigation->type, $arrTypes ) ) {

                    $arrRows[ $objNavigation->id ] = $objNavigation->name;
                }
            }
        }

        return $arrRows;
    }
}