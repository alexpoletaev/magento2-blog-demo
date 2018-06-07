<?php
namespace AlexPoletaev\Blog\Api;

use AlexPoletaev\Blog\Api\Data\PostInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface PostRepositoryInterface
 * @package AlexPoletaev\Api
 * @api
 */
interface PostRepositoryInterface
{
    /**
     * @param int $id
     * @return \AlexPoletaev\Blog\Api\Data\PostInterface
     */
    public function get(int $id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AlexPoletaev\Blog\Api\Data\PostSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param \AlexPoletaev\Blog\Api\Data\PostInterface $post
     * @return \AlexPoletaev\Blog\Api\Data\PostInterface
     */
    public function save(PostInterface $post);

    /**
     * @param \AlexPoletaev\Blog\Api\Data\PostInterface $post
     * @return bool
     */
    public function delete(PostInterface $post);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id);
}
