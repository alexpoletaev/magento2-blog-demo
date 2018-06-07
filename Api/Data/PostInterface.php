<?php
namespace AlexPoletaev\Blog\Api\Data;

/**
 * Interface PostInterface
 * @package AlexPoletaev\Api\Data
 * @api
 */
interface PostInterface
{
    /**#@+
     * Constants
     * @var string
     */
    const ID = 'id';
    const AUTHOR_ID = 'author_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**#@-*/

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getAuthorId();

    /**
     * @param int $authorId
     * @return $this
     */
    public function setAuthorId($authorId);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt);

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt);
}
