<?php
namespace AlexPoletaev\Blog\Console\Command;

use AlexPoletaev\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Console\Cli;
use Magento\Framework\Console\QuestionPerformer\YesNo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RemoveSampleDataCommand
 * @package AlexPoletaev\Blog\Console\Command
 */
class RemoveSampleDataCommand extends Command
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @var YesNo
     */
    private $questionPerformer;

    /**
     * @param ResourceConnection\Proxy $resourceConnection
     * @param YesNo\Proxy $questionPerformer
     */
    public function __construct(
        ResourceConnection\Proxy $resourceConnection,
        YesNo\Proxy $questionPerformer
    ) {
        parent::__construct();
        $this->resourceConnection = $resourceConnection;
        $this->questionPerformer = $questionPerformer;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('alex_poletaev:blog:remove_sample_data')
            ->setDescription('Blog: remove sample data')
        ;
        parent::configure();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $messages = ['Are you sure? This operation will completely remove all data.'];
        if (!$this->questionPerformer->execute($messages, $input, $output)) {
            return Cli::RETURN_FAILURE;
        }
        $connection = $this->resourceConnection->getConnection();
        $connection->truncateTable($connection->getTableName(PostResource::TABLE_NAME));
        if ($output->getVerbosity() > 1) {
            $output->writeln('<info>Sample data has been successfully removed.</info>');
        }

        return Cli::RETURN_SUCCESS;
    }
}
