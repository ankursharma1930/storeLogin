<?php


namespace Payless\Storelogin\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{
	protected $_customerSession;
    protected $_storeManager;
    /**
     * @var \Magento\Framework\App\Response\Http
     */
    protected $response;

	public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Response\Http $response,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    )
    {
        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
        $this->response = $response;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

     /**
     * @return string
     */
    public function getFormAction()
    {
        //Your block code
        return 'payless_storelogin/checklogin/index';
    }

    /**
     * Get current url for store
     *
     * @param bool|string $fromStore Include/Exclude from_store parameter from URL
     * @return string
     */
    public function getStoreUrl($fromStore = true)
    {
        return $this->_storeManager->getStore()->getUrl();
    }


    public function getStartDate(){
        return $this->scopeConfig->getValue('start_end_date/dates/start_date', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getEndDate(){
        return $this->scopeConfig->getValue('start_end_date/dates/end_date', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }


    public function getCustomerSession()
    {
        return $this->_customerSession;
    }

    public function redirectToStore($url){
        $this->response->setRedirect($url);
    }

}
