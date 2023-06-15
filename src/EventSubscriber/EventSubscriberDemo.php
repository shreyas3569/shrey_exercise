<?php

namespace Drupal\shrey_exercise\EventSubscriber;

// Used as baseclass for EventSubcriberDemo.
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// Defines event for the configuration system.
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Description for the  class.
 */
class EventSubscriberDemo implements EventSubscriberInterface {
  /**
   * Extending the baseclass.
   *
   * @var Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Function of the event.
   */
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   *
   * @return array
   *   Descrition of the task.
   */
  public static function getSubscribedEvents() {
    // This is a function which is mandatory for eventsubcriber.
    // This returns the configuration when it saved.
    $events[ConfigEvents::SAVE][] = ['configSave', -100];
    // This returns the configuration when it is deleted.
    $events[ConfigEvents::DELETE][] = ['configDelete', 100];
    return $events;
  }

  /**
   * Descrition of the task.
   */
  public function configSave(ConfigCrudEvent $event) {
    // Funtion for configSave.
    // Return the Config Object.
    $config = $event->getConfig();
    // Messenger service is called.
    $this->messenger->addMessage('Saved config: ' . $config->getName());
  }

  /**
   * Function name.
   */
  public function configDelete(ConfigCrudEvent $event) {
    // Function for configDelete.
    // Return the Config Object.
    $config = $event->getConfig();
    // Messenger service is called.
    $this->messenger->addMessage('Deleted config: ' . $config->getName());
  }

}
