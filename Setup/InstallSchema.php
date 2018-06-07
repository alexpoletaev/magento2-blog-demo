<?php
namespace AlexPoletaev\Blog\Setup;

use AlexPoletaev\Blog\Api\Data\PostInterface;
use AlexPoletaev\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Security\Setup\InstallSchema as SecurityInstallSchema;

/**
 * Class InstallSchema
 * @package AlexPoletaev\Blog\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()
            ->newTable(
                $setup->getTable(PostResource::TABLE_NAME)
            )
            ->addColumn(
                PostInterface::ID,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Post ID'
            )
            ->addColumn(
                PostInterface::AUTHOR_ID,
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true,],
                'Author ID'
            )
            ->addColumn(
                PostInterface::TITLE,
                Table::TYPE_TEXT,
                255,
                [],
                'Title'
            )
            ->addColumn(
                PostInterface::CONTENT,
                Table::TYPE_TEXT,
                null,
                [],
                'Content'
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Creation Time'
            )
            ->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                'Update Time'
            )
            ->addForeignKey(
                $setup->getFkName(
                    PostResource::TABLE_NAME,
                    PostInterface::AUTHOR_ID,
                    SecurityInstallSchema::ADMIN_USER_DB_TABLE_NAME,
                    'user_id'
                ),
                PostInterface::AUTHOR_ID,
                $setup->getTable(SecurityInstallSchema::ADMIN_USER_DB_TABLE_NAME),
                'user_id',
                Table::ACTION_SET_NULL
            )
            ->addIndex(
                $setup->getIdxName(
                    PostResource::TABLE_NAME,
                    [PostInterface::AUTHOR_ID],
                    AdapterInterface::INDEX_TYPE_INDEX
                ),
                [PostInterface::AUTHOR_ID],
                ['type' => AdapterInterface::INDEX_TYPE_INDEX]
            )
            ->setComment('Posts')
        ;

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
