<?php

namespace Drupal\shrey_exercise\Controller;

// Namespace of this file.
// Use of controllerbase.
use Drupal\Core\Controller\ControllerBase;
use Drupal\shrey_exercise\CustomService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Use of our custom service.
 */
class CustomController extends ControllerBase {

  /**
   * CustomService of the task.
   *
   * @var \Drupal\shrey_exercise\CustomService
   */
  protected $customService;

  /**
   * Create function for the task.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('custom_service')
    );
  }

  /**
   * Construct function.
   */
  public function __construct(CustomService $customService) {
    $this->customService = $customService;
  }

  /**
   * This is the function hello.
   */
  public function hello() {
    // This defining a function.
    // This calling our service.
    $data = $this->customService->getName();
    return [
    // Setting theme for this file.
      '#theme' => 'new_template',
    // The rendered name from config form.
      '#markup' => $data,
    // For the color.
      '#hexcode' => '#FF0000',
    ];
  }

  public function modalLink() {
    $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $build = [
        '#markup' => '<a href="details" class="use-ajax" data-dialog-type="modal">Click here</a>',
    ];
    return $build;
}

}
