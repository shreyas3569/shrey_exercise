<?php

namespace Drupal\shrey_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;

/**
 * Form Interactions.
 */
class JsTask extends FormBase {

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * The database service.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * CustomForm constructor.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\Core\Database\Connection $database
   *   The database service.
   */
  public function __construct(MessengerInterface $messenger, Connection $database) {
    $this->messenger = $messenger;
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger'),
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form_user_details';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = "shrey_exercise/jss_lib";
    $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => 'First Name',
      '#required' => TRUE,
      '#placeholder' => 'First Name',
      // '#ajax' => [
      //   'callback' => '::setAjaxSubmit',
      // ],
    ];
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => 'Email',
    ];
    $form['gender'] = [
      '#type' => 'select',
      '#title' => 'Gender',
      '#options' => [
        'male' => 'Male',
        'female' => 'Female',
      ],
    ];
    $form['temporary_address'] = [
      '#type' => 'textfield',
      '#title' => 'temporary Address',
      '#required' => TRUE,
    ];
    $form['same_address'] = [
      '#type' => 'checkbox',
      '#title' => 'Permanent address is same',
      '#ajax' => [
           'callback' => '::setAjaxSubmit',
         ],
    ];
    $form['permanent_address'] = [
      '#type' => 'textfield',
      '#title' => 'Permanent Address',
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
      '#ajax' => [
        'callback' => '::setAjaxSubmit',
      ],
    ];
    return $form;
  }

  public function setAjaxSubmit() {
    $response = new AjaxResponse();
    $response->addCommand(new InvokeCommand("html", 'datacheck'));
    return $response;
}


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger->addMessage("User Details Submitted Successfully");
    $this->database->insert("user_details")->fields([
      'firstname' => $form_state->getValue("firstname"),
      'email' => $form_state->getValue("email"),
      'gender' => $form_state->getValue("gender"),
      'temporary Address' => $form_state->getValue("temporary_address"),
      'Permanent address is same' => $form_state->getValue("same_address"),
      'permanent address' => $form_state->getValue("permanent_address"),

    ])->execute();
  }

}