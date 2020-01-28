<?php
namespace Ibiztech\Askquestion\Controller\Adminhtml\Question;
use Magento\Framework\Controller\ResultFactory;

class Addrow extends \Magento\Backend\App\Action
{
	 /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;
 
    /**
     * @var \Ibiztech\Askquestion\Model\QuestionFactory
     */
    private $questionFactory;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\Registry $coreRegistry,
		\Ibiztech\Askquestion\Model\QuestionFactory $questionFactory
	)
	{
		$this->coreRegistry = $coreRegistry;
		$this->_questionFactory = $questionFactory;
		parent::__construct($context);		
	}

	public function execute()
	{
		$rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->_questionFactory->create();
        
        if ($rowId) {
           $rowData = $rowData->load($rowId);
           $rowTitle = $rowData->getTitle();
           if (!$rowData->getEntityId()) {
               $this->messageManager->addError(__('Data no longer exist.'));
               $this->_redirect('askquestion/question/listquestions');
               return;
           }
       }
 
       $this->coreRegistry->register('row_data', $rowData);
       $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $title = $rowId ? __('Edit Row Data ').$rowTitle : __('Add Row Data');
       $resultPage->getConfig()->getTitle()->prepend($title);
       return $resultPage;
	}
}