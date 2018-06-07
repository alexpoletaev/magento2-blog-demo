<?php
namespace AlexPoletaev\Blog\Model\ResourceModel;

use AlexPoletaev\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Post
 * @package AlexPoletaev\Blog\Model\ResourceModel
 */
class Post extends AbstractDb
{
    /**
     * @var string
     */
    const TABLE_NAME = 'alex_poletaev_blog_post';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct() //@codingStandardsIgnoreLine
    {
        $this->_init(self::TABLE_NAME, PostInterface::ID);
    }
}
