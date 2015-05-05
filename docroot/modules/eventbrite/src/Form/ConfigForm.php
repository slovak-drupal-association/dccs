<?php

namespace Drupal\eventbrite\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Logger\RfcLogLevel;

class ConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'eventbrite_configform';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::configFactory()->get('custom.Eventbrite');
    $eventId = $config->get('eventId');
    $userKey = $config->get('userKey');
    $appKey = $config->get('appKey');

    $form['eventid'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Event ID'),
      '#default_value' => (is_null($eventId) ? 0 : $eventId),
      '#required' => TRUE,
    );

    $form['appkey'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('App Key'),
      '#default_value' => (is_null($appKey) ? 0 : $appKey),
      '#required' => TRUE,
    );

    $form['userkey'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('User Key'),
      '#default_value' => (is_null($userKey) ? 0 : $userKey),
      '#required' => TRUE,
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $config = \Drupal::configFactory()->getEditable('custom.Eventbrite');
    $config->set('eventId', $values['eventid'])->save();
    $config->set('appKey', $values['appkey'])->save();
    $config->set('userKey', $values['userkey'])->save();
  }
}