<?php


namespace Payless\Storelogin\Block;

class Checklogin extends \Magento\Framework\View\Element\Template
{

    protected $_customerSession;
    /**
     * @var \Magento\Framework\App\Response\Http
     */
    protected $response;
    protected $_scopeConfig;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Response\Http $response,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    )
    {
        $this->_customerSession = $customerSession;
        $this->response = $response;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }
   

    public function getCustomerSession()
    {
        return $this->_customerSession;
    }

    public function getLogout()
    {
        //Your block code
        return $this->getUrl("payless_storelogin/logout/index/");
    }

    /*
     * @return redirect
     */

    public function redirectToLogin(){
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITES;
        $check = $this->_scopeConfig->getValue("start_end_date/dates/check_login", $storeScope);
        
        if($check){
            $this->response->setRedirect('payless_storelogin/');
        }else{
            return false;
        }
    }

    /**
     * @param $config
     * @return mixed
     */
    public function getConfig($config)
    {
        if($config){
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITES;
            return $this->_scopeConfig->getValue($config, $storeScope);
        }
    }

}