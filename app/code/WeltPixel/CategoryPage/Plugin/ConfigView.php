<?php
namespace WeltPixel\CategoryPage\Plugin;

class ConfigView {

    const XML_PATH_WELTPIXEL_CATEGORYPAGE_IMAGE_GRID_WIDTH = 'weltpixel_category_page/image/grid_width';
    const XML_PATH_WELTPIXEL_CATEGORYPAGE_IMAGE_GRID_HEIGHT = 'weltpixel_category_page/image/grid_height';
    const XML_PATH_WELTPIXEL_CATEGORYPAGE_IMAGE_LIST_WIDTH = 'weltpixel_category_page/image/list_width';
    const XML_PATH_WELTPIXEL_CATEGORYPAGE_IMAGE_LIST_HEIGHT = 'weltpixel_category_page/image/list_height';

    /**
    * @var \Magento\Store\Model\StoreManagerInterface
    */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param \Magento\Framework\Config\View $subject
     * @param \Closure $proceed
     * @param string $module
     * @param string $mediaType
     * @param string $mediaId
     * @return array
     */
    public function aroundGetMediaAttributes(
        \Magento\Framework\Config\View $subject,
        \Closure $proceed,
        $module,
        $mediaType,
        $mediaId)
    {
        $result = $proceed($module, $mediaType, $mediaId);

        switch ($mediaId) {
            case "category_page_grid" :
                $gridImageWidth = trim($this->scopeConfig->getValue(self::XML_PATH_WELTPIXEL_CATEGORYPAGE_IMAGE_GRID_WIDTH,  \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
                $gridImageHeight = trim($this->scopeConfig->getValue(self::XML_PATH_WELTPIXEL_CATEGORYPAGE_IMAGE_GRID_HEIGHT,  \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
                if (strlen($gridImageWidth)) {
                    $result['width'] = $gridImageWidth;
                }
                if (strlen($gridImageHeight)) {
                    $result['height'] = $gridImageHeight;
                }
                break;
            case "category_page_list" :
                $listImageWidth = trim($this->scopeConfig->getValue(self::XML_PATH_WELTPIXEL_CATEGORYPAGE_IMAGE_LIST_WIDTH,  \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
                $listImageHeight = trim($this->scopeConfig->getValue(self::XML_PATH_WELTPIXEL_CATEGORYPAGE_IMAGE_LIST_HEIGHT,  \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
                if (strlen($listImageWidth)) {
                    $result['width'] = $listImageWidth;
                }
                if (strlen($listImageHeight)) {
                    $result['height'] = $listImageHeight;
                }
                break;
        }

        return $result;

    }
}