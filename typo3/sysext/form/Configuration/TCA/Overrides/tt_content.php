<?php
defined('TYPO3_MODE') or die();

// add an CType element "mailform"
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['mailform'] = 'mimetypes-x-content-form';

// check if there is already a forms tab and add the item after that, otherwise
// add the tab item as well
$additionalCTypeItem = array(
    'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.I.8',
    'mailform',
    'content-elements-mailform'
);

$existingCTypeItems = $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'];
$groupFound = false;
$groupPosition = false;
foreach ($existingCTypeItems as $position => $item) {
    if ($item[0] === 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.div.forms') {
        $groupFound = true;
        $groupPosition = $position;
        break;
    }
}

if ($groupFound && $groupPosition) {
    // add the new CType item below CType
    array_splice($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'], $groupPosition+1, 0, array(0 => $additionalCTypeItem));
} else {
    // nothing found, add two items (group + new CType) at the bottom of the list
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tt_content', 'CType',
        array('LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.div.forms', '--div--')
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tt_content', 'CType', $additionalCTypeItem);
}

// predefined forms
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    array(
        'tx_form_predefinedform' => array(
            'label' => 'LLL:EXT:form/Resources/Private/Language/Database.xlf:tx_form_predefinedform',
            'exclude' => true,
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array(
                        'LLL:EXT:form/Resources/Private/Language/Database.xlf:tx_form_predefinedform.selectPredefinedForm',
                        ''
                    ),
                ),
            ),
        ),
    )
);
$GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',tx_form_predefinedform';

// Hide bodytext if a predefined form is selected
$GLOBALS['TCA']['tt_content']['columns']['bodytext']['displayCond']['AND'] = array(
    'OR' => array(
        'FIELD:CType:!=:mailform',
        'AND' => array(
            'FIELD:CType:=:mailform',
            'FIELD:tx_form_predefinedform:REQ:false',
        ),
    ),
);

$GLOBALS['TCA']['tt_content']['columns']['bodytext']['config']['wizards']['forms'] = array(
    'notNewRecords' => true,
    'enableByTypeConfig' => 1,
    'type' => 'script',
    'title' => 'Form wizard',
    'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_forms.gif',
    'module' => array(
        'name' => 'wizard_form'
    ),
    'params' => array(
        'xmlOutput' => 0
    )
);

// Add palettes if they are not available
if (!isset($GLOBALS['TCA']['tt_content']['palettes']['visibility'])) {
    $GLOBALS['TCA']['tt_content']['palettes']['visibility'] = array(
        'showitem' => '
            hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden_formlabel,
            sectionIndex;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:sectionIndex_formlabel,
            linkToTop;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:linkToTop_formlabel
        ',
    );
}

if (!isset($GLOBALS['TCA']['tt_content']['palettes']['frames'])) {
    $GLOBALS['TCA']['tt_content']['palettes']['frames'] = array(
        'showitem' => '
            layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:layout_formlabel
        ',
    );
}

$GLOBALS['TCA']['tt_content']['types']['mailform']['showitem'] = '
	--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
	--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,rowDescription,
	--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.I.8,
		bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.ALT.mailform,
		tx_form_predefinedform;LLL:EXT:form/Resources/Private/Language/Database.xlf:tx_form_predefinedform,
	--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
		--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
	--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
		--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
		--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
';
if (!is_array($GLOBALS['TCA']['tt_content']['types']['mailform']['columnsOverrides'])) {
    $GLOBALS['TCA']['tt_content']['types']['mailform']['columnsOverrides'] = array();
}
if (!is_array($GLOBALS['TCA']['tt_content']['types']['mailform']['columnsOverrides']['bodytext'])) {
    $GLOBALS['TCA']['tt_content']['types']['mailform']['columnsOverrides']['bodytext'] = array();
}
$GLOBALS['TCA']['tt_content']['types']['mailform']['columnsOverrides']['bodytext']['config']['renderType'] = 'formwizard';
