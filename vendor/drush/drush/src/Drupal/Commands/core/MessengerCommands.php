<?php

namespace Drush\Drupal\Commands\core;

use Consolidation\AnnotatedCommand\CommandData;
use Drupal\Core\Messenger\MessengerInterface;
use Drush\Commands\DrushCommands;
use Drush\Drupal\DrupalUtil;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class MessengerCommands extends DrushCommands
{
    protected $messenger;

    /**
     * @inheritDoc
     */
    public function __construct(MessengerInterface $messenger)
    {
        $this->messenger = $messenger;
    }

    /**
     * @hook pre-command *
     */
    public function pre()
    {
        self::log();
    }

    /**
     * @hook post-command *
     */
    public function post()
    {
        self::log();
    }

    public function log()
    {
        $prefix = 'Message: ';
        foreach ($this->messenger->messagesByType(MessengerInterface::TYPE_ERROR) as $message) {
            $this->logger()->error($prefix . DrupalUtil::drushRender($message));
        }
        foreach ($this->messenger->messagesByType(MessengerInterface::TYPE_WARNING) as $message) {
            $this->logger()->warning($prefix . DrupalUtil::drushRender($message));
        }
        foreach ($this->messenger->messagesByType(MessengerInterface::TYPE_STATUS) as $message) {
            $this->logger()->notice($prefix . DrupalUtil::drushRender($message));
        }
        $this->messenger->deleteAll();
    }
}