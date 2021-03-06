<?php
return array(
    'ctrl' => array(
        'label' => 'title',
        'descriptionColumn' => 'description',
        'tstamp' => 'tstamp',
        'sortby' => 'sorting',
        'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xlf:LGL.prependAtCopy',
        'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        // Only admin, if any
        'adminOnly' => true,
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime'
        ),
        'typeicon_column' => 'root',
        'typeicon_classes' => array(
            'default' => 'mimetypes-x-content-template-extension',
            '1' => 'mimetypes-x-content-template'
        ),
        'searchFields' => 'title,constants,config'
    ),
    'interface' => array(
        'showRecordFieldList' => 'title,clear,root,basedOn,nextLevel,sitetitle,description,hidden,starttime,endtime'
    ),
    'columns' => array(
        'title' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.title',
            'config' => array(
                'type' => 'input',
                'size' => 25,
                'max' => 255,
                'eval' => 'required'
            )
        ),
        'hidden' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.disable',
            'exclude' => true,
            'config' => array(
                'type' => 'check',
                'default' => 0
            )
        ),
        'starttime' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'exclude' => true,
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0
            )
        ),
        'endtime' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'exclude' => true,
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => array(
                    'upper' => mktime(0, 0, 0, 12, 31, 2020)
                )
            )
        ),
        'root' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.root',
            'config' => array(
                'type' => 'check'
            )
        ),
        'clear' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.clear',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    array('Constants', ''),
                    array('Setup', '')
                ),
                'cols' => 2
            )
        ),
        'sitetitle' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.sitetitle',
            'config' => array(
                'type' => 'input',
                'size' => 25,
                'max' => 255
            )
        ),
        'constants' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.constants',
            'config' => array(
                'type' => 'text',
                'cols' => 48,
                'rows' => 10,
                'wrap' => 'OFF',
                'softref' => 'email[subst],url[subst]'
            ),
            'defaultExtras' => 'fixed-font : enable-tab'
        ),
        'nextLevel' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.nextLevel',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'sys_template',
                'show_thumbs' => true,
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
                'default' => '',
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest'
                    )
                )
            )
        ),
        'include_static_file' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.include_static_file',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 10,
                'maxitems' => 100,
                'items' => array(),
                'enableMultiSelectFilterTextfield' => true,
                'softref' => 'ext_fileref'
            )
        ),
        'basedOn' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.basedOn',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'sys_template',
                'show_thumbs' => true,
                'size' => 3,
                'maxitems' => 50,
                'autoSizeMax' => 10,
                'minitems' => 0,
                'default' => '',
                'wizards' => array(
                    '_VERTICAL' => 1,
                    'suggest' => array(
                        'type' => 'suggest'
                    ),
                    'edit' => array(
                        'type' => 'popup',
                        'title' => 'Edit template',
                        'module' => array(
                            'name' => 'wizard_edit',
                        ),
                        'popup_onlyOpenIfSelected' => 1,
                        'icon' => 'actions-open',
                        'JSopenParams' => 'width=800,height=600,status=0,menubar=0,scrollbars=1'
                    ),
                    'add' => array(
                        'type' => 'script',
                        'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.basedOn_add',
                        'icon' => 'actions-add',
                        'params' => array(
                            'table' => 'sys_template',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ),
                        'module' => array(
                            'name' => 'wizard_add'
                        )
                    )
                )
            )
        ),
        'includeStaticAfterBasedOn' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.includeStaticAfterBasedOn',
            'exclude' => true,
            'config' => array(
                'type' => 'check',
                'default' => 0
            )
        ),
        'config' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.config',
            'config' => array(
                'type' => 'text',
                'rows' => 10,
                'cols' => 48,
                'wrap' => 'OFF',
                'softref' => 'email[subst],url[subst]'
            ),
            'defaultExtras' => 'fixed-font : enable-tab'
        ),
        'description' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.description',
            'config' => array(
                'type' => 'text',
                'rows' => 5,
                'cols' => 48
            )
        ),
        'static_file_mode' => array(
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.static_file_mode',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.static_file_mode.0', '0'),
                    array('LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.static_file_mode.1', '1'),
                    array('LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.static_file_mode.2', '2'),
                    array('LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.static_file_mode.3', '3')
                ),
                'default' => 0
            )
        ),
        'tx_impexp_origuid' => array('config' => array('type' => 'passthrough')),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255
            )
        )
    ),
    'types' => array(
        '1' => array('showitem' => '
			hidden, title, sitetitle, constants, config, description,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.tabs.options, clear, root, nextLevel,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.tabs.include, includeStaticAfterBasedOn, include_static_file, basedOn, static_file_mode,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:sys_template.tabs.access, starttime, endtime')
    )
);
