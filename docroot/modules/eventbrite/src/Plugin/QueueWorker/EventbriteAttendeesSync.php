<?php

namespace Drupal\eventbrite\Plugin\QueueWorker;

use Drupal\Core\Logger\RfcLogLevel;
use Drupal\Core\Queue\QueueWorkerBase;

/**
 * Create attendee.
 *
 * @QueueWorker(
 *   id = "eventbrite_attendees_sync",
 *   title = @Translation("Eventbrite attendees sync"),
 *   cron = {"time" = 60}
 * )
 */
class EventbriteAttendeesSync extends QueueWorkerBase {
  /**
   * {@inheritdoc}
   */
  public function processItem($data) {
    try {
      $user_data = [
        'mail' => $data->attendee->email,
        'name' => $data->attendee->email,
        'status' => 1,
        'field_first_name' => ['value' => $data->attendee->first_name],
        'field_last_name' => ['value' => $data->attendee->last_name],
      ];

      $user = entity_create('user', $user_data);
      $user->save();

      _user_mail_notify('register_admin_created',$user);

      if ($data->attendee->amount_paid == $this->personalSponsorshipPrice) {
        $this->createUserProfile($user, TRUE);
      }
      else {
        $this->createUserProfile($user);
      }


    } catch (\Exception $e) {
      \Drupal::logger('eventbrite cron')
        ->log(RfcLogLevel::ERROR, 'User {mail} hasn\'t been created.', ['mail' => $data->attendee->email]);
    }
  }
}