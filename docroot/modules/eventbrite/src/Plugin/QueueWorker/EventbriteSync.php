<?php

/**
 * @file
 * Contains \Drupal\eventbrite\Plugin\QueueWorker\EventbriteSync.
 */

namespace Drupal\eventbrite\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\Core\Logger\RfcLogLevel;
use Drupal\user\Entity\User;

/**
 * Updates a feed's items.
 *
 * @QueueWorker(
 *   id = "eventbrite",
 *   title = @Translation("EventbriteSync sync"),
 *   cron = {"time" = 60}
 * )
 */
class EventbriteSync extends QueueWorkerBase {

  /**
   * {@inheritdoc}
   */
  public function processItem($data) {
    if (FALSE === user_load_by_mail($data->attendee->email)) {
      try {
        // build array of user data
        $user_data = [
          'mail' => $data->attendee->email,
          'name' => $data->attendee->email,
          'status' => 1,
          'field_first_name' => ['value' => $data->attendee->first_name],
          'field_last_name' => ['value' => $data->attendee->last_name],
        ];

        // create User entity
        $user = entity_create('user', $user_data);
        $user->save();

        // notify user about new account
        _user_mail_notify('register_admin_created', $user);

        // create user profile
        $this->createUserProfile($user);

      } catch (\Exception $e) {
        \Drupal::logger('eventbrite')
          ->log(RfcLogLevel::ERROR, 'User {mail} hasn\'t been created.', ['mail' => $data->attendee->email]);
      }
    }
  }

  /**
   * Helper function, which creates node of type person
   *
   * @param \Drupal\user\Entity\User $user
   * @param bool $isIndividualSponsor
   */
  public function createUserProfile(User $user, $isIndividualSponsor = FALSE) {
    $values = [
      'type' => 'person',
      'title' => $user->getUsername(),
      'uid' => 1,
      'field_referenced_user' => ['target_id' => $user->id()]
    ];

    if ($isIndividualSponsor) {
      $values['field_person_type'] = ['target_id' => 8];
    }

    $node = entity_create('node', $values);
    $node->save();
  }

}
