<?php

namespace Drupal\shrey_exercise\Plugin\Block;

// Namespace.
// Using blockbase for customblock.
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

// forminterface
// customform.

/**
 * Provides a 'Custom' block.
 *
 * @Block(
 *   id = "shrey_exercise",
 *   admin_label = "Custom block",
 * )
 */
class CustomBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * This is the form builder.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */

  protected $formbuilder;

  /**
   * Constructs as an object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   This is the plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   This is the  plugin implementation definition.
   * @param \Drupal\Core\Form\FormBuilderInterface $form_builder
   *   The form builder.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition,
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    // Here calling form as a block.
    $form = $this->formBuilder->getForm('Drupal\shrey_exercise\Form\ConfigForm');
    // To display form.
    return $form;
  }

}
