<?php
namespace DmitryDulepov\Sample\Xclass;

class Typo3DbQueryParser extends \TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser {
	/**
	 * Fixes incorrect localisation handling in Extbase.
	 *
	 * @param string $tableName
	 * @param array $sql
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings
	 */
	protected function addSysLanguageStatement($tableName, array &$sql, $querySettings) {
		if (is_array($GLOBALS['TCA'][$tableName]['ctrl'])) {
			if (!empty($GLOBALS['TCA'][$tableName]['ctrl']['languageField'])) {
				$sql['additionalWhereClause'][] = $tableName . '.' . $GLOBALS['TCA'][$tableName]['ctrl']['languageField'] . '=0';
			}
		}
	}
}