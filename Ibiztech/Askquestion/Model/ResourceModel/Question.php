<?php
namespace Ibiztech\Askquestion\Model\ResourceModel;
class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('ibiztech_askquestions', 'id');
	}
}