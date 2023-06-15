<?php

namespace Drupal\shrey_exercise\Plugin\Field\FieldType;

// Namespace for the FieldType.
// Used as a baseclass.
use Drupal\Core\Field\FieldItemBase;
// Interface is used for storage.
use Drupal\Core\Field\FieldStorageDefinitionInterface;
// Interface is used for form.
use Drupal\Core\Form\FormStateInterface;
// Provides the defintion for primitive data types.
use Drupal\Core\TypedData\DataDefinition;

/**
 * Define the "custom field type".
 *
 * @FieldType(
 *   id = "custom_field_type",
 *   label = @Translation("Custom Field Type"),
 *   description = @Translation("Desc for Custom Field Type"),
 *   category = @Translation("Text"),
 *   default_widget = "custom_field_widget",
 *   default_formatter = "custom_field_formatter",
 * )
 */
class FieldType extends FieldItemBase {
  // Extending the base class.

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    // Creating a table in database.
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => $field_definition->getSetting("length"),
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'length' => 255,
    // Default value for length is s set to 255.
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    // This is a function for storagesetting that appears when we add a field.
    $element = [];

    // This is the length for the field.
    $element['length'] = [
      '#type' => 'number',
    // The title.
      '#title' => t("Length of your text"),
    // This is mandatory to be filled.
      '#required' => TRUE,
    // This will return the length value.
      '#default_value' => $this->getSetting("length"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    // This is the function to define a default field.
    return [
    // The default a value is set.
      'moreinfo' => "More info default value",
    // This return the default field setting.
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = [];
    $element['moreinfo'] = [
    // Moreinfo of type textfield.
      '#type' => 'textfield',
      '#title' => 'More information about this field',
      '#required' => TRUE,
    // Will retuen default value of moreinfo.
      '#default_value' => $this->getSetting("moreinfo"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Function to define field item properties.
    $properties['value'] = DataDefinition::create('string')->setLabel(t("Name"));

    return $properties;
  }

}
