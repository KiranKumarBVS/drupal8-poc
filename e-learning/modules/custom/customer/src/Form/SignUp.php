<?php
/**
 * @file
 * Contains \Drupal\customer\Form\SignUp.
 */
namespace Drupal\customer\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SignUp extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'register_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['customer_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Registered Name:'),
      '#required' => TRUE,
    );

    $form['customer_mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
    );

    $form['pass'] = array(
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#size' => 12,
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    drupal_set_message($this->t('@customer_name, Your application is being submitted!', array('@customer_name' => $form_state->getValue('customer_name'))));

  }
}