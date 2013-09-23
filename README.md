Sitewards InstantSearchResult
==========================

The Sitewards InstantSearchResult Extension provides functionality of redirecting to detailpage if search result has only 1 product.

Features
------------------
* If there is only 1 product returned from the search redirect to detailpage of product

File list
------------------
* app\etc\modules\Sitewards_InstantSearchResult.xml
	* Activate module
	* Specify community code pool
	* Set-up dependencies
		* Mage_CatalogSearch
* app\code\community\Sitewards\InstantSearchResult\etc\config.xml
	* Set-up model declaration
	* Set-up helper declaration
	* Set-up event observers for module
		* core_block_abstract_to_html_before
	* Set-up translations
		* Adminhtml
* app\code\community\Sitewards\InstantSearchResult\etc\adminhtml.xml
	* Create magento access control list for this module
* app\code\community\Sitewards\InstantSearchResult\etc\system.xml
	* Create admin config in catalog tab
	* Assign admin config fields to sections
		* General settings
* app\code\community\Sitewards\InstantSearchResult\Model\Observer.php
	* Redirect to product details
	* Function return search result item url