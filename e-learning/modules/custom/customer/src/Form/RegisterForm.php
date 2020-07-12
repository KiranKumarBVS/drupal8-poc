<?php
/**
 * @file
 * Contains \Drupal\customer\Form\RegisterForm.
 */
namespace Drupal\customer\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RegisterForm extends FormBase {
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
      '#title' => t('Customer Name:'),
      '#required' => TRUE,
    );

    $form['customer_number'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile no'),
    );

    $form['customer_dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB'),
      '#required' => TRUE,
    );

    $form['customer_gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'Female' => t('Female'),
        'male' => t('Male'),
      ),
    );

    $form['customer_aadhar'] = array(
      '#type' => 'number',
      '#title' => t('Aadhar Card No:'),
      '#required' => TRUE,
    );

    $form['customer_pan'] = array(
      '#type' => 'textfield',
      '#title' => t('PAN Card No:'),
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

    $form['pass'] = array(
      '#type' => 'password_confirm',
      '#title' => $this->t('Password'),
      '#size' => 12,
    );

    $form['customer_copy'] = array(
      '#type' => 'checkbox',
      '#title' => t('Send me a copy of the application.'),
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {

      if (strlen($form_state->getValue('customer_number')) < 10) {
        $form_state->setErrorByName('customer_number', $this->t('Mobile number is too short.'));
      }

      if (strlen($form_state->getValue('customer_aadhar')) < 16) {
        $form_state->setErrorByName('customer_aadhar', $this->t('Aadhar number is too short.'));
      }

      if (strlen($form_state->getValue('customer_pan')) < 10) {
        $form_state->setErrorByName('customer_pan', $this->t('PAN number is too short.'));
      }

    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

   // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));

    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

   }
}