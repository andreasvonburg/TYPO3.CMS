<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post',
        'label' => 'title',
        'label_alt' => 'author',
        'label_alt_force' => true,
        'tstamp'   => 'tstamp',
        'crdate'   => 'crdate',
        'versioningWS' => true,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'delete'   => 'deleted',
        'enablecolumns'  => array(
            'disabled' => 'hidden'
        ),
        'iconfile' => 'EXT:blog_example/Resources/Public/Icons/icon_tx_blogexample_domain_model_post.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'title, date, author',
        'maxDBListItems' => 100,
        'maxSingleDBListItems' => 500
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid, hidden, blog, title, date, author, content, tags, comments, related_posts')
    ),
    'columns' => array(
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
                'default' => 0
            )
        ),
        'l18n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_blogexample_domain_model_post',
                'foreign_table_where' => 'AND tx_blogexample_domain_model_post.uid=###REC_FIELD_l18n_parent### AND tx_blogexample_domain_model_post.sys_language_uid IN (-1,0)',
            )
        ),
        'l18n_diffsource' => array(
            'config'=>array(
                'type' => 'passthrough',
                'default' => ''
            )
        ),
        'hidden' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => array(
                'type' => 'check'
            )
        ),
        'blog' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post.blog',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_blogexample_domain_model_blog',
                'maxitems' => 1,
            )
        ),
        'title' => array(
            'label' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post.title',
            'config' => array(
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim, required',
                'max' => 256
            )
        ),
        'date' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post.date',
            'config' => array(
                'type' => 'input',
                'size' => 12,
                'eval' => 'datetime, required',
                'default' => time()
            )
        ),
        'author' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post.author',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_blogexample_domain_model_person',
                'wizards' => array(
                     '_VERTICAL' => 1,
                     'edit' => array(
                         'type' => 'popup',
                         'title' => 'Edit',
                         'module' => array(
                             'name' => 'wizard_edit',
                         ),
                         'icon' => 'actions-open',
                         'popup_onlyOpenIfSelected' => 1,
                         'JSopenParams' => 'width=800,height=600,status=0,menubar=0,scrollbars=1',
                     ),
                     'add' => array(
                         'type' => 'script',
                         'title' => 'Create new',
                         'icon' => 'actions-add',
                         'params' => array(
                             'table'=>'tx_blogexample_domain_model_person',
                             'pid' => '###CURRENT_PID###',
                             'setValue' => 'prepend'
                         ),
                         'module' => array(
                             'name' => 'wizard_add',
                         ),
                     ),
                 )
            )
        ),
        'content' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post.content',
            'config' => array(
                'type' => 'text',
                'rows' => 30,
                'cols' => 80
            )
        ),
        'tags' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post.tags',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_blogexample_domain_model_tag',
                'MM' => 'tx_blogexample_post_tag_mm',
                'maxitems' => 9999,
                'appearance' => array(
                    'useCombination' => 1,
                    'useSortable' => 1,
                    'collapseAll' => 1,
                    'expandSingle' => 1,
                )
            )
        ),
        'comments' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post.comments',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_blogexample_domain_model_comment',
                'foreign_field' => 'post',
                'size' => 10,
                'maxitems' => 9999,
                'autoSizeMax' => 30,
                'multiple' => 0,
                'appearance' => array(
                    'collapseAll' => 1,
                    'expandSingle' => 1,
                )
            )
        ),
        'related_posts' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post.related',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 10,
                'maxitems' => 9999,
                'autoSizeMax' => 30,
                'multiple' => 0,
                'foreign_table' => 'tx_blogexample_domain_model_post',
                'foreign_table_where' => 'AND ###THIS_UID### != tx_blogexample_domain_model_post.uid',
                'MM' => 'tx_blogexample_post_post_mm',
                'MM_opposite_field' => 'related_posts',
            )
        ),
    )
);
