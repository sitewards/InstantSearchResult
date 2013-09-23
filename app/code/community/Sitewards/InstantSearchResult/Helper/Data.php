<?php
/**
 * Class Sitewards_InstantSearchResult_Helper_Data
 *
 * @category    Sitewards
 * @package     Sitewards_InstantSearchResult
 * @copyright   Copyright (c) 2013 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_InstantSearchResult_Helper_Data extends Mage_Captcha_Helper_Data {

	/**
	 * The root node of extension configuration
	 */
	const CONFIG_NODE = 'instantsearchresult';

	/**
	 * The general settings node of extension configuration
	 */
	const CONFIG_GENERAL_NODE = 'generalsettings';

	/**
	 * Flag for extension enable/disable
	 */
	const CONFIG_GENERAL_ACTIVE_FLAG = 'active';

	/**
	 * Check to see if the extension is active
	 * Returns the extension's general setting "active"
	 *
	 * @return bool
	 */
	public function isExtensionActive() {
		return Mage::getStoreConfigFlag(
			self::CONFIG_NODE . '/' .
			self::CONFIG_GENERAL_NODE . '/' .
			self::CONFIG_GENERAL_ACTIVE_FLAG
		);
	}
}