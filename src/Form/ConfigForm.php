<?php

namespace Drupal\shrey_exercise\Form;

// Namespace.
// Using base classes.
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class creation.
 */
class ConfigForm extends ConfigFormBase {

  // It gives a form id.
  const RESULT = "shrey_exercise.settings";

  /**
   * This is to get form id.
   */
  public function getFormId() {
    return "shrey_exercise_settings";
  }

  /**
   * To get editable names.
   */
  protected function getEditableConfigNames() {
    // To get names.
    return [
    // Static result.
      static::RESULT,
    ];
  }

  /**
   * Building the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Variables for the form.
    // Result is static.
    $config = $this->config(static::RESULT);
    // Name field.
    $form['NAME'] = [
    // Type of field.
      '#type' => 'textfield',
    // Title.
      '#title' => '<span>NAME</span>',
    // Attaching a css lib.
      '#attached' => [
        'library' => [
          'shrey_exercise/shrey_exercise_styles',
        ],
      ],
      // Get name.
      '#default_value' => $config->get("NAME"),
    ];

    $form['Age'] = [
      '#type' => 'textfield',
      '#title' => 'Age',
      '#default_value' => $config->get("Age"),
    ];

    $form['Place'] = [
      '#type' => 'textfield',
      '#title' => 'Place',
      '#default_value' => $config->get("Place"),

    ];
    $form['Phone'] = [
      '#type' => 'textfield',
      '#title' => 'Phone',
      '#default_value' => $config->get("Phone"),
    ];
    $form['Gender'] = [
      '#type' => 'select',
      '#title' => 'Gender',
      '#options' => [
        'other' => 'other',
        'male' => 'Male',
        'female' => 'Female',
      ],
    ];

    // Will return the form.
    return parent::buildForm($form, $form_state);
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('phone')) < 3) {
      $form_state->setErrorByName('phone', $this->t('The phone number is too short. Please enter a full phone number.'));
    }
  }

  /**
   * Submit form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // For submit option.
    // Static result.
    $config = $this->config(static::RESULT);
    // To collect values entered.
    $config->set("NAME", $form_state->getValue('NAME'));
    $config->set("Age", $form_state->getValue('Age'));
    $config->set("Place", $form_state->getValue('Place'));
    $config->set("Phone", $form_state->getValue('Phone'));
    $config->set("Gender", $form_state->getValue('Gender'));
    // Saves all fields.
    $config->save();
  }

}
