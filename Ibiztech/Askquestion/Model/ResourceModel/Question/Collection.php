<?php
namespace Ibiztech\Askquestion\Model\ResourceModel\Question;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'ibiztech_askquestion_question_collection';
	protected $_eventObject = 'question_collection';
	
	protected function _construct()
	{
		$this->_init('Ibiztech\Askquestion\Model\Question', 'Ibiztech\Askquestion\Model\ResourceModel\Question');
	}
}