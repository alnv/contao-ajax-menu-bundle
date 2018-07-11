<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['menu_button'] = '{title_legend},name,headline,type;{menu_settings},,menuNavigation,menuTitle,closeTitle,menuIconAlt,menuIcon,closeIcon;{protected_legend:hide:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['fields']['menuIcon'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['menuIcon'],
    'inputType' => 'fileTree',

    'eval' => [

        'extensions' => 'png,jpeg,jpg,svg,gif',
        'fieldType' => 'radio',
        'tl_class' => 'clr',
        'files' => true
    ],

    'exclude' => true,
    'sql' => "binary(16) NULL"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['closeIcon'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['closeIcon'],
    'inputType' => 'fileTree',

    'eval' => [

        'extensions' => 'png,jpeg,jpg,svg,gif',
        'fieldType' => 'radio',
        'tl_class' => 'clr',
        'files' => true
    ],

    'exclude' => true,
    'sql' => "binary(16) NULL"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['menuTitle'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['menuTitle'],
    'inputType' => 'text',

    'eval' => [

        'maxlength' => 128,
        'tl_class' => 'w50'
    ],

    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['closeTitle'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['closeTitle'],
    'inputType' => 'text',

    'eval' => [

        'maxlength' => 128,
        'tl_class' => 'w50'
    ],

    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['menuIconAlt'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['menuIconAlt'],
    'inputType' => 'text',

    'eval' => [

        'maxlength' => 128,
        'tl_class' => 'w50'
    ],

    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['menuNavigation'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['menuNavigation'],
    'inputType' => 'select',

    'eval' => [

        'chosen' => true,
        'tl_class' => 'w50',
        'mandatory' => true,
        'includeBlankOption' => true
    ],

    'options_callback' => [ 'menu.datacontainer.module', 'getNavigationIds' ],

    'exclude' => true,
    'sql' => "int(10) unsigned NOT NULL default '0'"
];