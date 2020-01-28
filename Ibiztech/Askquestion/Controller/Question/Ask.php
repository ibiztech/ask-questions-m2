<?php
namespace Ibiztech\Askquestion\Controller\Question;

class Ask extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	
	protected $_questionFactory;
	
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Ibiztech\Askquestion\Model\QuestionFactory $questionFactory)
	{
		$this->_pageFactory = $pageFactory;
		$this->_questionFactory = $questionFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$question = $this->_questionFactory->create();		
		$data = $this->getRequest()->getPost();	
        try {			
			if(!empty($data["email"]) && !empty($data["product_sku"]) && !empty($data["question"])) {
				$question->setName($data["name"]);
				$question->setProductSku($data["product_sku"]);
				$question->setQuestion($data["question"]);
				$question->setEmail($data["email"]);        
				$question->setPhoneNumber($data["phone_number"]);
				$question->save(); 
				echo 'Question is sent to seller. You will get an answer shortly.';			
			} else {
				echo 'Please enter all the required fields';	
			}				
        } catch(\Exception  $e){
			echo "There is some issue. Please contact us through contact page";
			$this->logger->critical($e->getMessage());
		}
        //return $resultJson;		
	}
}