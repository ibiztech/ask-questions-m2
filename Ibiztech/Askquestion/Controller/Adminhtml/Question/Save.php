<?php
namespace Ibiztech\Askquestion\Controller\Adminhtml\Question;

class Save extends \Magento\Backend\App\Action
{	
	const ADMIN_RESOURCE = 'Index';

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
		$resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
		$data = $data["reply"];
        if($data)
        {
			$id = $data['id'];			
            try{
				$data = array_filter($data, function($value) {return $value !== ''; });
                
				$question = $this->_questionFactory->create()->load($id);
				$question->sendEmail();
                $question->setAnswer($data["answer"]);
                $question->save();
                $this->messageManager->addSuccess(__('Successfully saved the item.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                return $resultRedirect->setPath('*/*/');
            }
            catch(\Exception $e)
            {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/reply', ['id' => $id]);
            }
        }

         return $resultRedirect->setPath('*/*/listquestions');
	}
}