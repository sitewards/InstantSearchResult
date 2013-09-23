<?php
/**
 * Class Sitewards_InstantSearchResult_Model_Observer
 *  - redirect to product details
 *  - function return search result item url
 *
 * @category    Sitewards
 * @package     Sitewards_InstantSearchResult
 * @copyright   Copyright (c) 2013 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_InstantSearchResult_Model_Observer {
	/**
	 * If there is only 1 product returned from the search redirect to detailpage of product
	 *
	 * @param Varien_Event_Observer $oObserver
	 */
	public function onCoreBlockAbstractToHtmlBefore(Varien_Event_Observer $oObserver) {
		if (!Mage::helper('instantsearchresult')->isExtensionActive()) {
			return;
		}
		$oBlock = $oObserver->getBlock();
		// only on block catalogsearch result
		/* @var $oBlock Mage_CatalogSearch_Block_Result */
		if ($oBlock instanceof Mage_CatalogSearch_Block_Result) {
			$oRequest = Mage::app()->getRequest();
			if (!$oRequest->isAjax()) {
				if ($oBlock->getResultCount() == 1) {
					$sUrl = $this->getProductUrl($oBlock);
					Mage::app()->getFrontController()->getResponse()->setRedirect($sUrl);
				}
			}
		}
	}

	/**
	 * Return product url of first item
	 *
	 * @param Mage_CatalogSearch_Block_Result $oBlock
	 * @throws Mage_Exception if the fetched item of the collection of not of type Mage_Catalog_Model_Product
	 * @return String
	 */
	private function getProductUrl(Mage_CatalogSearch_Block_Result $oBlock) {
		/* @var $oListBlock Mage_Catalog_Block_Product_List */
		$oListBlock = $oBlock->getListBlock();
		// we have to execute toHtml so all events get fired which filter the product collection
		$oListBlock->toHtml();
		/* @var $oProductCollection Mage_Catalog_Model_Resource_Product_Collection */
		$oProductCollection = $oListBlock->getLoadedProductCollection();
		/* @var $oProduct Mage_Catalog_Model_Product */
		$oProduct = $oProductCollection->fetchItem();
		if (!($oProduct instanceof Mage_Catalog_Model_Product)) {
			throw new Mage_Exception('fetched item is not a product');
		}
		return $oProduct->getProductUrl() . $oProduct->getUrlPath();
	}
}