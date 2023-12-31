<?php

namespace Drupal\shrey_exercise\Plugin\Field\FieldWidget;

// Namespace for  the FieldWidget.
// Used as a baseclass.
use Drupal\Core\Field\WidgetBase;
// Interface for the field.
use Drupal\Core\Field\FieldItemListInterface;
// Interface for the form.
use Drupal\Core\Form\FormStateInterface;

/**
 * Define the "custom field type".
 *
 * @FieldWidget(
 *   id = "custom_field_widget",
 *   label = @Translation("Custom Field Widget"),
 *   description = @Translation("Desc for Custom Field Widget"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */
class FieldWidget extends WidgetBase {
  // Extending a baseclass here.

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = $items[$delta]->value ?? "";
    $element = $element + [
      '#type' => 'textfield',
    // Here we used as suffix that appears on node edit page.
      '#suffix' => "<span>" . $this->getFieldSetting("moreinfo") . "</span>",
      '#default_value' => $value,
      '#attributes' => [
    // Here we will return placeholder value.
        'placeholder' => $this->getSetting('placeholder'),
      ],
    ];
    return ['value' => $element];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'placeholder' => 'default',
    // Here will return default value of placeholder.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['placeholder'] = [
      '#type' => 'textfield',
      '#title' => 'Placeholder text',
    // Here we will give placeholder value.
      '#default_value' => $this->getSetting('placeholder'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t("placeholder text: @placeholder", ["@placeholder" => $this->getSetting("placeholder")]);
    return $summary;
  }

}
