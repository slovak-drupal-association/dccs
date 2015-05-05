<?php

/**
 * @file
 * Contains \Drupal\eventninja\Form\AdminForm.
 */

namespace Drupal\eventninja\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Logger\RfcLogLevel;

class AdminForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'eventninja_adminform';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['file'] = array(
      '#type' => 'managed_file',
      '#title' => $this->t('Choose a file'),
      '#title_display' => 'invisible',
      '#upload_validators' => array(
        'file_validate_extensions' => array('csv'),
      ),
      '#upload_location' => 'public://',
      '#required' => TRUE,
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Upload and process'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $file = File::load($values['file'][0]); // Load File entity.

    $read_file = new \SplFileObject($file->url()); // Create file handler.
    $lines = 1;
    $in_queue = 0;

    $queue = \Drupal::queue('eventninja'); // Load queue

    while (!$read_file->eof()) {
      dsm($lines);
      $data = $read_file->fgetcsv(';');
      if($lines > 1) { // skip headers
        dsm($data);
        $user = user_load_by_mail($data[1]);
        if($user === false) { // Verify if user with specified email does not exist.
          $queue->createItem($data);
          $in_queue++;
        } else {
          $this->logger('eventninja')
            ->log(RfcLogLevel::NOTICE, 'User {mail} hasn\'t been created.', ['mail' => $data[1]]);
        }
      }
      $lines++;
    }

    if($lines>1) {
      drupal_set_message($this->t('@num records was scheduled for import', array('@num' => $in_queue)),'success');
    } else {
      drupal_set_message($this->t('File contains only headers'),'error');
    }
  }

}