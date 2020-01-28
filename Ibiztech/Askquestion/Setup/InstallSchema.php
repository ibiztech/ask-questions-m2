<?php
namespace Ibiztech\Askquestion\Setup;

class InstallSchema implements InstallSchemaInterface
{
	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;

		$installer->startSetup();
			if (!$installer->tableExists('ibiztech_askquestions')) {
				$table = $installer->getConnection()->newTable(
					$installer->getTable('ibiztech_askquestions')
				)
					->addColumn(
						'id',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						null,
						[
							'identity' => true,
							'nullable' => false,
							'primary'  => true,
							'unsigned' => true,
						],
						'ID'
					)
					->addColumn(
						'name',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Customer Name'
					)					
					->addColumn(
						'email',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						'255',
						[],
						'Customer Email'
					)
					->addColumn(
						'phone_number',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						'255',
						[],
						'Phone Number'
					)
					->addColumn(
						'prodcut_sku',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						[],
						'Product SKU'
					)
					->addColumn(
						'question',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						[],
						'Question'
					)	
					->addColumn(
						'answer',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						[],
						'Answer'
					)		
					->addColumn(
						'status',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						'1',
						['default'=>0],
						'Status'
					)		
					->addColumn(
						'created_at',
						\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
						null,
						['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
						'Created At'
					)
					->setComment('Questions');
				$installer->getConnection()->createTable($table);				
			}		

		$installer->endSetup();
	}
}