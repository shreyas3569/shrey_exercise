<?php

namespace Drupal\shrey_exercise;

// Name space of custom service file.
use Drupal\Core\Config\ConfigFactory;

// The base class.
/**
 * Class CustomService is called.
 *
 * @package Drupal\shrey_exercise\Services
 */
class CustomService {
  // Here we creating a class.

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * The constructor.
   */
  public function __construct(ConfigFactory $configFactory) {
    // Assigning variable $configfactory.
    $this->configFactory = $configFactory;
  }

  /**
   * This gets my setting.
   */
  public function getName() {
    // To collect NAME of the config form.
    $config = $this->configFactory->get('shrey_exercise.settings');
    // Return the name.
    return $config->get('NAME');
  }

}
