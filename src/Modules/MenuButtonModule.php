<?php

namespace Alnv\ContaoAjaxMenuBundle\Modules;

class MenuButtonModule extends \Module
{

    protected $strTemplate = 'mod_menu_button';

    public function generate()
    {

        if (TL_MODE == 'BE') {

            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->title = $this->headline;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
            $objTemplate->wildcard = '### MENU ###';

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    protected function compile()
    {

        $this->Template->menuIcon = $this->getIcon($this->Template->menuIcon);
    }

    protected function getIcon($strSingleSrc)
    {

        if (!$strSingleSrc) return [];

        $objFile = \FilesModel::findByUuid($strSingleSrc);

        if ($objFile !== null) return $objFile->row();

        return [];
    }
}