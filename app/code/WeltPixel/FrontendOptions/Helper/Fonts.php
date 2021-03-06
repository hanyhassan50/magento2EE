<?php

namespace WeltPixel\FrontendOptions\Helper;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Fonts extends \Magento\Framework\App\Helper\AbstractHelper
{
    
    /**
     * @var string
     */
    protected $_googlefontUrl = 'https://fonts.googleapis.com/css?family=';

     /**
     * @var array
     */
    protected $_frontendOptions;
    
    /**
     * @var array
     */
    protected $_fontFamilyOptions = [
        'h1__font____family',
        'h2__font____family',
        'h3__font____family',
        'h4__font____family',
        'h5__font____family',
        'h6__font____family',
        'font____family__base',
        'button__font____family',
        'form____element____input__font____family'
    ];
    
    /**
     * @var array
     */
    protected $avilableFontFamilys = [
        [
            'font' => 'h1/h1__font____family',
            'weight' => 'h1/h1__font____weight',
            'characterset' => 'h1/h1__font____family_characterset'
        ],
        [
            'font' => 'h2/h2__font____family',
            'weight' => 'h2/h2__font____weight',
            'characterset' => 'h2/h2__font____family_characterset'
        ],
        [
            'font' => 'h3/h3__font____family',
            'weight' => 'h3/h3__font____weight',
            'characterset' => 'h3/h3__font____family_characterset'
        ],
        [
            'font' => 'h4/h4__font____family',
            'weight' => 'h4/h4__font____weight',
            'characterset' => 'h4/h4__font____family_characterset'
        ],
        [
            'font' => 'h5/h5__font____family',
            'weight' => 'h5/h5__font____weight',
            'characterset' => 'h5/h5__font____family_characterset'
        ],
        [
            'font' => 'h6/h6__font____family',
            'weight' => 'h6/h6__font____weight',
            'characterset' => 'h6/h6__font____family_characterset'
        ],
        [
            'font' => 'default/font____family__base',
            'weight' => 'default/font____weight__regular',
            'characterset' => 'default/font____family__base_characterset',
        ],
        [
            'font' => 'default_buttons/button__font____family',
            'weight' => 'default_buttons/button__font____weight',
            'characterset' => 'default_buttons/button__font____family_characterset',
        ],
        [
            'font' => 'form_inputs/form____element____input__font____family',
            'weight' => 'form_inputs/form____element____input__font____weight',
            'characterset' => 'form_inputs/form____element____input__font____family_characterset'
        ]
    ];
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
        
        $this->_frontendOptions = $this->scopeConfig->getValue('weltpixel_frontend_options');
    }
    
    public function getFontFamilyOptions() {
        return $this->_fontFamilyOptions;
    }
    
    public function getGoogleFonts() {
        $baseUrl = $this->_googlefontUrl;
        
        $fontUrl = $this->_getFontFamilyMergedUrl();
        
        if (strlen(trim($fontUrl))) {
            return $baseUrl . $fontUrl;
        }
        
        return false;
    }
    
    /**
     *Gets all the font options from the backend and it will construct the final font url
     * @return boolean|string
     */
    private function _getFontFamilyMergedUrl() {
        $fontsArray = [];
        foreach ($this->avilableFontFamilys as $availableFamily) {
            $fontFamily = str_replace(' ', '+', $this->scopeConfig->getValue('weltpixel_frontend_options/' . $availableFamily['font']));
            if ($fontFamily) {
                $fontWeight = $this->scopeConfig->getValue('weltpixel_frontend_options/' . $availableFamily['weight']);
                $fontCharacterset = $this->scopeConfig->getValue('weltpixel_frontend_options/' . $availableFamily['characterset']);
                if ($fontWeight) {
                    $fontsArray[$fontFamily][] = array_map('trim', explode(',', $fontWeight));
                }
                if ($fontCharacterset) {
                    $fontsArray['_characterset'][] = explode(',', $fontCharacterset);
                }
                
            }
        }
        
        return $this->_buildUrl($fontsArray);
    }
    
    /**
     * Normalizes the admin options and constructs the final url into one merged font url
     * @param array $fontsArray
     * @return boolean|string
     */
    private function _buildUrl($fontsArray) {
        if (empty($fontsArray)) {
            return false;
        }
        
        $normalizedFontOptions = array();
        $subset = '';
        
        foreach ($fontsArray as $fontKey => $fontOptions) {
            $tmpArray = array();
            foreach ($fontOptions as $options) {
                $tmpArray = array_unique(array_merge($tmpArray, $options));
            }
            
            if ($fontKey == '_characterset') {
                $subset = implode(',', $tmpArray);
            } else {
                $normalizedFontOptions[] = $fontKey.":".implode(',', $tmpArray);
            }
        }
        
        $fontUrl = implode('|', $normalizedFontOptions);
        
        if ($subset) {
            $fontUrl .= '&subset=' . $subset;
        }
        
        return $fontUrl;
    }
    
}
