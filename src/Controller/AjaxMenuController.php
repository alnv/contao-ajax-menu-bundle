<?php

namespace Alnv\ContaoAjaxMenuBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 * @Route(defaults={"_scope" = "frontend", "_token_check" = false })
 */
class AjaxMenuController extends \Contao\CoreBundle\Controller\AbstractController {


    /**
     *
     * @Route( "/parse-menu/{strId}", name="parse-menu" )
     */
    public function menu( $strId ) {

        $this->container->get( 'contao.framework' )->initialize();

        $arrData = [];
        $objDatabase = \Database::getInstance();
        $objMenuButton = $objDatabase->prepare( 'SELECT * FROM tl_module WHERE id = ?' )->limit( 1 )->execute( $strId );

        $objTemplate = new \FrontendTemplate( 'mod_overlay_navigation' );
        $strNavigation = \Controller::getFrontendModule( $objMenuButton->menuNavigation );
        $strNavigation = \Controller::replaceInsertTags( $strNavigation );

        $arrModule = $objMenuButton->row();

        foreach ( $arrModule as $strKey => $strValue ) {

            if ( $strKey == 'closeIcon' ) $strValue = $this->getIcon( $strValue );

            $arrData[ $strKey ] = $strValue ?: '';
        }

        $arrData['navigation'] = $strNavigation;

        $objTemplate->setData( $arrData );

        $arrResponse = [

            'navigation' => $objTemplate->parse()
        ];

        return new JsonResponse($arrResponse);
    }


    protected function getIcon( $strSingleSrc ) {

        if ( !$strSingleSrc ) return [];

        $objFile = \FilesModel::findByUuid( $strSingleSrc );

        if ( $objFile !== null ) return $objFile->row();

        return [];
    }
}