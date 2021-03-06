<?php

namespace WeltPixel\QuickCart\Helper;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	/**
	 * @var array
	 */
	protected $_quickcartOptions;
	
	
	/**
	 * Constructor
	 *
	 * @param \Magento\Framework\App\Helper\Context $context
	 */
	public function __construct(
			\Magento\Framework\App\Helper\Context $context
	) {
		parent::__construct($context);
		
		$this->_quickcartOptions = $this->scopeConfig->getValue('weltpixel_quick_cart', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}
	
	/**
	 * @param int $storeId
	 * @return mixed
	 */
	public function getHeaderHeight($storeId = 0) {
		if ($storeId) {
			return $this->scopeConfig->getValue('weltpixel_quick_cart/header/header_height', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
		} else {
			return $this->_quickcartOptions['header']['header_height'];
		}
	}
	
	/**
	 * @param int $storeId
	 * @return mixed
	 */
	public function getHeaderBackground($storeId = 0) {
		if ($storeId) {
			return $this->scopeConfig->getValue('weltpixel_quick_cart/header/header_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
		} else {
			return $this->_quickcartOptions['header']['header_background'];
		}
	}
	
	/**
	 * @param int $storeId
	 * @return mixed
	 */
	public function getHeaderTextColor($storeId = 0) {
		if ($storeId) {
			return $this->scopeConfig->getValue('weltpixel_quick_cart/header/header_text_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
		} else {
			return $this->_quickcartOptions['header']['header_text_color'];
		}
	}
	
	/**
	 * @param int $storeId
	 * @return mixed
	 */
	public function getSubtotalBackground($storeId = 0) {
		if ($storeId) {
			return $this->scopeConfig->getValue('weltpixel_quick_cart/footer/subtotal_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
		} else {
			return $this->_quickcartOptions['footer']['subtotal_background'];
		}
	}
	
	/**
	 * @param int $storeId
	 * @return mixed
	 */
	public function getSubtotalTextColor($storeId = 0) {
		if ($storeId) {
			return $this->scopeConfig->getValue('weltpixel_quick_cart/footer/subtotal_text_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
		} else {
			return $this->_quickcartOptions['footer']['subtotal_text_color'];
		}
	}
}
