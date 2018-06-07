<?php
namespace AlexPoletaev\Blog\Model;

use AlexPoletaev\Blog\Api\Data\PostInterface;
use AlexPoletaev\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Post
 * @package AlexPoletaev\Blog\Model
 */
class Post extends AbstractModel implements PostInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = PostInterface::ID; //@codingStandardsIgnoreLine

    /**
     * @inheritdoc
     */
    protected function _construct() //@codingStandardsIgnoreLine
    {
        $this->_init(PostResource::class);
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->getData(PostInterface::AUTHOR_ID);
    }

    /**
     * @param int $authorId
     * @return $this
     */
    public function setAuthorId($authorId)
    {
        $this->setData(PostInterface::AUTHOR_ID, $authorId);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(PostInterface::TITLE);
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->setData(PostInterface::TITLE, $title);
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getData(PostInterface::CONTENT);
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->setData(PostInterface::CONTENT, $content);
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(PostInterface::CREATED_AT);
    }

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->setData(PostInterface::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(PostInterface::UPDATED_AT);
    }

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->setData(PostInterface::UPDATED_AT, $updatedAt);
        return $this;
    }
}
