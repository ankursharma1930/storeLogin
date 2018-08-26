<?php
namespace Payless\Storelogin\Plugin\Checkout\Model\Checkout;
 
class LayoutProcessor
{
    /**
    * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
    * @param array $jsLayout
    * @return array
    */

    public function __construct(
        
        \Payless\Storelogin\Helper\Data $helper
        
    ) {
        $this->helper = $helper;
        
    }

    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {


        $postcode = $this->helper->getConfig('start_end_date/origin/postcode');
        $street1 = $this->helper->getConfig('start_end_date/origin/street_line1');
        $street2 = $this->helper->getConfig('start_end_date/origin/street_line2');
        $city = $this->helper->getConfig('start_end_date/origin/city');
        $region_id = $this->helper->getConfig('start_end_date/origin/region_id');
        $country_id = $this->helper->getConfig('start_end_date/origin/country_id');

        if($postcode){

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['city']['value'] = $city;
 
 
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['postcode']['value'] = $postcode;
         
        // $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        // ['shippingAddress']['children']['shipping-address-fieldset']['children']['telephone']['value'] = '1234567890';
 
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['street']['children'][0]['value'] = $street1;
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['street']['children'][1]['value'] = $street2;


        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['region_id']['value'] = $region_id;

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['region_id']['readonly'] = true;


        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['country_id']['value'] = $country_id;
       
    }








        // $postcode = $this->helper->getConfig('start_end_date/origin/postcode');
        // $street1 = $this->helper->getConfig('start_end_date/origin/street_line1');
        // $street2 = $this->helper->getConfig('start_end_date/origin/street_line2');
        // $city = $this->helper->getConfig('start_end_date/origin/city');
        // $region_id = $this->helper->getConfig('start_end_date/origin/region_id');
        // $country_id = $this->helper->getConfig('start_end_date/origin/country_id');

        // $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        // ['shippingAddress']['children']['shipping-address-fieldset']['children']['city']['value'] = $city;
       
        // $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['street']['children'][0]['value'] = 'asdada';
        // $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['street']['children'][1]['value'] = 'dfdfd';

 
        // $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        // ['shippingAddress']['children']['shipping-address-fieldset']['children']['postcode']['value'] = $postcode;

        // $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        // ['shippingAddress']['children']['shipping-address-fieldset']['children']['region_id']['value'] = $region_id;


        // $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        // ['shippingAddress']['children']['shipping-address-fieldset']['children']['country_id']['value'] = $country_id;
       


 // $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
 //        ['shippingAddress']['children']['shipping-address-fieldset']['children']['street'] = [
 //            'component' => 'Magento_Ui/js/form/components/group',
 //            //'label' => __('Street Address'), I removed main label
 //            'required' => false, //turn false because I removed main label
 //            'dataScope' => 'shippingAddress.street',
 //            'provider' => 'checkoutProvider',
 //            'sortOrder' => 0,
 //            'type' => 'group',
 //            'additionalClasses' => 'street',
 //            'children' => [
 //                [
 //                    'value' => __('Label 1'),
 //                    'component' => 'Magento_Ui/js/form/element/abstract',
 //                    'config' => [
 //                        'customScope' => 'shippingAddress',
 //                        'template' => 'ui/form/field',
 //                        'elementTmpl' => 'ui/form/element/input',
 //                        'value'=>'dfdfd',
 //                    ],
 //                    'dataScope' => '0',
 //                    'provider' => 'checkoutProvider',
 //                    'validation' => ['required-entry' => true, "min_text_len‌​gth" => 1, "max_text_length" => 255],
                    
 //                ],
 //                [
 //                    'label' => __('Label 2'),
 //                    'component' => 'Magento_Ui/js/form/element/abstract',
 //                    'config' => [
 //                        'customScope' => 'shippingAddress',
 //                        'template' => 'ui/form/field',
 //                        'elementTmpl' => 'ui/form/element/input'
 //                    ],
 //                    'dataScope' => '1',
 //                    'provider' => 'checkoutProvider',
 //                    'validation' => ['required-entry' => true, "min_text_len‌​gth" => 1, "max_text_length" => 255],
                    
 //                ],
 //                [
 //                    'label' => __('Label 3'),
 //                    'component' => 'Magento_Ui/js/form/element/abstract',
 //                    'config' => [
 //                        'customScope' => 'shippingAddress',
 //                        'template' => 'ui/form/field',
 //                        'elementTmpl' => 'ui/form/element/input'
 //                    ],
 //                    'dataScope' => '2',
 //                    'provider' => 'checkoutProvider',
 //                    'validation' => ['required-entry' => true, "min_text_len‌​gth" => 1, "max_text_length" => 255],
 //                ],
 //                [
 //                    'label' => __('Label 4'),
 //                    'component' => 'Magento_Ui/js/form/element/abstract',
 //                    'config' => [
 //                        'customScope' => 'shippingAddress',
 //                        'template' => 'ui/form/field',
 //                        'elementTmpl' => 'ui/form/element/input'
 //                    ],
 //                    'dataScope' => '3',
 //                    'provider' => 'checkoutProvider',
 //                    'validation' => ['required-entry' => false, "min_text_len‌​gth" => 1, "max_text_length" => 255],
 //                ],
 //            ]
 //        ];




        return $jsLayout;
    }
}