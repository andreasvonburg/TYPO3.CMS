<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:lang/locallang_tca.xlf:sys_collection',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'default_sortby' => 'ORDER BY crdate',
        'delete' => 'deleted',
        'type' => 'type',
        'rootLevel' => -1,
        'searchFields' => 'title,description',
        'typeicon_column' => 'type',
        'typeicon_classes' => array(
            'default' => 'apps-clipboard-list',
            'static' => 'apps-clipboard-list',
            'filter' => 'actions-system-tree-search-open'
        ),
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group'
        ),
    ),
    'interface' => array(
        'showRecordFieldList' => 'title, description, table_name, items'
    ),
    'columns' => array(
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 30
            )
        ),
        'sys_language_uid' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
                'default' => 0,
                'showIconTable' => true,
            )
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('', 0)
                ),
                'foreign_table' => 'sys_file_collection',
                'foreign_table_where' => 'AND sys_file_collection.pid=###CURRENT_PID### AND sys_file_collection.sys_language_uid IN (-1,0)'
            )
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
                'default' => ''
            )
        ),
        'hidden' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
                'default' => 0
            )
        ),
        'starttime' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 8,
                'max' => 20,
                'eval' => 'date',
                'default' => 0,
            )
        ),
        'endtime' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 8,
                'max' => 20,
                'eval' => 'date',
                'default' => 0,
                'range' => array(
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                )
            )
        ),
        'fe_group' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.fe_group',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('', 0),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.hide_at_login', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.any_login', -2),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.usergroups', '--div--')
                ),
                'foreign_table' => 'fe_groups'
            )
        ),
        'table_name' => array(
            'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_collection.table_name',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'tables'
            )
        ),
        'items' => array(
            'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_collection.items',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'prepend_tname' => true,
                'allowed' => '*',
                'MM' => 'sys_collection_entries',
                'MM_hasUidField' => true,
                'multiple' => true,
                'size' => 5
            )
        ),
        'title' => array(
            'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_collection.title',
            'config' => array(
                'type' => 'input',
                'size' => 60,
                'eval' => 'required'
            )
        ),
        'description' => array(
            'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_collection.description',
            'config' => array(
                'type' => 'text',
                'cols' => 60,
                'rows' => 5
            )
        ),
        'type' => array(
            'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_collection.type',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('LLL:EXT:lang/locallang_tca.xlf:sys_collection.type.static', 'static')
                ),
                'default' => 'static'
            )
        )
    ),
    'types' => array(
        'static' => array(
            'showitem' => 'title, --palette--;;1, type, description,table_name, items',
        ),
    ),
    'palettes' => array(
        '1' => array('showitem' => 'starttime, endtime, fe_group, sys_language_uid, l10n_parent, l10n_diffsource, hidden')
    )
);
