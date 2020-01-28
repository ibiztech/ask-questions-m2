<?php
namespace Ibiztech\Askquestion\Model\Question;

use Ibiztech\Askquestion\Model\ResourceModel\Question\CollectionFactory;
use Ibiztech\Askquestion\Model\Question;

class Dataprovider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
	/**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $questionCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $questionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        
        foreach ($items as $contact) {
            
            $this->loadedData[$contact->getId()]['reply'] = $contact->getData();
        }


        return $this->loadedData;

    }
}