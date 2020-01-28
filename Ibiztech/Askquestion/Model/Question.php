<?php
namespace Ibiztech\Askquestion\Model;
class Question extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'ibiztech_askquestion_question';

	protected $_cacheTag = 'ibiztech_askquestion_question';	
	
	protected function _construct()
	{
		$this->_init('Ibiztech\Askquestion\Model\ResourceModel\Question');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];
		return $values;
	}
	
	public function sendEmail()
	{		
		$to = $this->getEmail();
		$nameTo = $this->getName();
		$email = new \Zend_Mail();
		$email->setSubject("Reply to your query");
		$email->setBodyText($this->getAnswer());		
		$email->addTo($to, $nameTo);
		$email->send();
		return $this;
	}	
}