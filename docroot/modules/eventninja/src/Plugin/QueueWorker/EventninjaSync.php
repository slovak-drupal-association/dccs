<?php

/**
 * @file
 * Contains \Drupal\eventninja\Plugin\QueueWorker\EventninjaSync.
 */

namespace Drupal\eventninja\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\Core\Logger\RfcLogLevel;
use Drupal\user\Entity\User;

/**
 * Updates a feed's items.
 *
 * @QueueWorker(
 *   id = "eventninja",
 *   title = @Translation("Eventninja sync"),
 *   cron = {"time" = 60}
 * )
 */
class EventninjaSync extends QueueWorkerBase {

  /**
   * {@inheritdoc}
   */
  public function processItem($data) {
    if(is_array($data)) {
      $name = explode(' ',$data[0]);
      $email = $data[1];
      try {
        // build array of user data
        $user_data = [
          'mail' => $email,
          'name' => $email,
          'status' => 1,
          'field_first_name' => ['value' => $name[0]],
          'field_last_name' => ['value' => $name[1]],
        ];

        // create User entity
        $user = entity_create('user', $user_data);
        $user->save();

        // notify user about new account
        _user_mail_notify('register_admin_created',$user);

        // create user profile
        $this->createUserProfile($user);

      } catch (\Exception $e) {
        \Drupal::logger('eventninja queue')
          ->log(RfcLogLevel::ERROR, 'User {mail} hasn\'t been created.', ['mail' => $email]);
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
