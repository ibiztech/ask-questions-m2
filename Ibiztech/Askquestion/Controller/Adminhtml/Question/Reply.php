<?php
namespace Ibiztech\Askquestion\Controller\Adminhtml\Question;

class Reply extends \Magento\Backend\App\Action
{	
	protected $resultPageFactory = false;
	
	protected $questionFactory;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Ibiztech\Askquestion\Model\QuestionFactory $questionFactory
	)
	{
		$this->resultPageFactory = $resultPageFactory;
		$this->_questionFactory = $questionFactory;
		parent::__construct($context);		
	}
	
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();      		
		$resultPage->getConfig()->getTitle()->prepend((__('Reply to Question')));
		return $resultPage;
	}
}