<?php
namespace AlexPoletaev\Blog\Console\Command;

use AlexPoletaev\Blog\Api\PostRepositoryInterface;
use AlexPoletaev\Blog\Model\Post;
use AlexPoletaev\Blog\Model\PostFactory;
use Magento\Framework\Console\Cli;
use Magento\User\Model\User;
use Magento\User\Model\UserFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeploySampleDataCommand
 * @package AlexPoletaev\Blog\Console\Command
 */
class DeploySampleDataCommand extends Command
{
    /**#@+
     * @var string
     */
    const ARGUMENT_USERNAME = 'username';
    const ARGUMENT_NUMBER_OF_RECORDS = 'number_of_records';
    /**#@-*/

    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * @param PostFactory $postFactory
     * @param PostRepositoryInterface\Proxy $postRepository
     * @param UserFactory $userFactory
     */
    public function __construct(
        PostFactory $postFactory,
        PostRepositoryInterface\Proxy $postRepository,
        UserFactory $userFactory
    ) {
        parent::__construct();
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('alex_poletaev:blog:deploy_sample_data')
            ->setDescription('Blog: deploy sample data')
            ->setDefinition([
                new InputArgument(
                    self::ARGUMENT_USERNAME,
                    InputArgument::REQUIRED,
                    'Username'
                ),
                new InputArgument(
                    self::ARGUMENT_NUMBER_OF_RECORDS,
                    InputArgument::OPTIONAL,
                    'Number of test records'
                ),
            ])
        ;
        parent::configure();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument(self::ARGUMENT_USERNAME);
        /** @var User $user */
        $user = $this->userFactory->create();
        $user->loadByUsername($username);
        if (!$user->getId() && $output->getVerbosity() > 1) {
            $output->writeln('<error>User is not found</error>');
            return Cli::RETURN_FAILURE;
        }
        $records = $input->getArgument(self::ARGUMENT_NUMBER_OF_RECORDS) ?: 3;
        for ($i = 1; $i <= (int)$records; $i++) {
            /** @var Post $post */
            $post = $this->postFactory->create();
            $post->setAuthorId($user->getId());
            $post->setTitle('test title ' . $i);
            $post->setContent('test content ' . $i);
            $this->postRepository->save($post);
            if ($output->getVerbosity() > 1) {
                $output->writeln('<info>Post with the ID #' . $post->getId() . ' has been created.</info>');
            }
        }

        return Cli::RETURN_SUCCESS;
    }
}
