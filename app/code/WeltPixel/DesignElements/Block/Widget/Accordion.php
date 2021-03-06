<?php
namespace WeltPixel\DesignElements\Block\Widget;

class Accordion extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('widget/accordion_widget.phtml');
    }

    public function getContent()
    {
        $blockId = $this->getData('block_id');
        $html = $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId($blockId)->toHtml();

        return $html;
    }
}
