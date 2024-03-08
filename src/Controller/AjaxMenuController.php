<?php

namespace Alnv\ContaoAjaxMenuBundle\Controller;


use Contao\CoreBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 *
 * @Route("/", defaults={"_scope" = "frontend", "_token_check" = false})
 */
class AjaxMenuController extends AbstractController
{

    /**
     *
     * @Route("/parse-menu/{strId}", methods={"POST", "GET"}, name="parse-menu")
     */
    public function menu($strId)
    {

        $this->container->get('contao.framework')->initialize();

        global $objPage;

        $objDatabase = \Database::getInstance();
        $objPageEntity = $objDatabase->prepare('SELECT * FROM tl_page ORDER BY id ASC')->limit(1)->execute();

        $objPage = \PageModel::findByPk($objPageEntity->id);
        $objPage->trail = [];

        $arrData = [];
        $objMenuButton = $objDatabase->prepare('SELECT * FROM tl_module WHERE id = ?')->limit(1)->execute($strId);

        $objTemplate = new \FrontendTemplate('mod_overlay_navigation');
        $strNavigation = \Controller::getFrontendModule($objMenuButton->menuNavigation);
        $strNavigation = \Controller::replaceInsertTags($strNavigation);

        $arrModule = $objMenuButton->row();

        foreach ($arrModule as $strKey => $strValue) {
            if ($strKey == 'closeIcon') $strValue = $this->getIcon($strValue);
            $arrData[$strKey] = $strValue ?: '';
        }

        $arrData['navigation'] = $strNavigation;
        $objTemplate->setData($arrData);

        $arrResponse = [

            'navigation' => $objTemplate->parse()
        ];

        return new JsonResponse($arrResponse);
    }


    protected function getIcon($strSingleSrc)
    {

        if (!$strSingleSrc) return [];

        $objFile = \FilesModel::findByUuid($strSingleSrc);

        if ($objFile !== null) return $objFile->row();

        return [];
    }
}