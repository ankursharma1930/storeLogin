<?php


namespace Payless\Storelogin\Controller\Checklogin;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $jsonHelper;
    protected $_store;
    protected $_customerSession;
    protected $_messageManager;
    /**
     * @var \Magento\Framework\App\Response\Http
     */
    protected $response;
    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Store\Model\StoreManagerInterface $_store,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\Response\Http $response
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->jsonHelper = $jsonHelper;
        $this->store = $_store;
        $this->_customerSession = $customerSession;
        $this->_messageManager = $messageManager;
        $this->response = $response;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $data = $this->getRequest()->getPost();
            $storecode = $data['store_code'];
            $stores = $this->getStoreData();
            $store_id = null;
            foreach ($stores as $value ){
                if($storecode == $value['code']){
                    $store_id = $value['store_id'];
                }
            }
            $response = array();
            if($store_id){
                $message = "Redirecting to store, Welcome!";
                $this->store->setCurrentStore($storecode);
                $response[] = ['store_url' => $this->store->getStore()->getUrl(), 'store_code' => $storecode,'is_active'=>$this->store->getStore()->IsActive()];

                if(!$this->store->getStore()->IsActive()){
                    $message = "Store is not active";
                    $this->_messageManager->addError($message);//For Error Message
                    return false;
                }elseif($this->store->getStore()->IsActive()){
                    //$this->_customerSession->setStoreLogin($store_id);
                    $_SESSION['store_login'] = $store_id;
                    $this->_messageManager->addSuccess($message); //For Success Message
                    //$this->response->setRedirect($response[0]['store_url']);
                    return $this->jsonResponse($response);
                }
            }else{
                $message = "Invalid store code, please try again with correct sore code";
                $this->_messageManager->addError($message);//For Error Message
                return false;
            }

        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return $this->jsonResponse($e->getMessage());
        } catch (\Exception $e) {
            
            return $this->jsonResponse($e->getMessage());
        }
    }

    /**
     * Create json response
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($response)
        );
    }

    /*
     * @ return store array
     */
    private function getStoreData(){
        $storeManagerDataList = $this->store->getStores();
        $options = array();

        foreach ($storeManagerDataList as $key => $value) {
            $options[] = ['label' => $value['name'], 'value' => $key,'code'=>$value['code'],'store_id'=>$value['store_id'],'is_active'=>$value['is_active']];
        }
        return $options;
    }

    /**
     * get customer session
     */
    public function getCustomerSession()
    {
        return $this->_customerSession;
    }
}
