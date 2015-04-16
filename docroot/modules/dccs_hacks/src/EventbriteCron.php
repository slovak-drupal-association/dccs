<?php
namespace Drupal\dccs_hacks;

use Drupal\Core\Logger\RfcLogLevel;
use Drupal\user\Entity\User;

class EventbriteCron {
  protected $eventId = 16613203539;

  protected $lastAccessTime;

  protected $appKey = 'URJUX4YJVL2GGJU6Z2';

  protected $userKey = '1427904506138983663880';

  protected $personalSponsorshipPrice = 0;

  public function run() {
    $eventbrite = new Eventbrite([
      'app_key' => $this->appKey,
      'user_key' => $this->userKey
    ]);

    $requestData = [
      'id' => $this->eventId,
      'status' => 'attending',
    ];

    if (!is_null($this->lastAccessTime)) {
      $requestData['changed_since'] = $this->lastAccessTime;
    }

    try {
      $attendees = $eventbrite->event_list_attendees($requestData);
    } catch (\Exception $e) {
      $attendees = [];
    }

    $this->setLastAccessTime();

    foreach ($attendees->attendees as $a) {
      try {
        $user_data = [
          'mail' => $a->attendee->email,
          'name' => $a->attendee->email,
          'status' => 1,
          'field_first_name' => ['value' => $a->attendee->first_name],
          'field_last_name' => ['value' => $a->attendee->last_name],
        ];

        $user = entity_create('user', $user_data);
        $user->save();

        _user_mail_notify('register_admin_created',$user);

        if ($a->attendee->amount_paid == $this->personalSponsorshipPrice) {
          $this->createUserProfile($user, TRUE);
        }
        else {
          $this->createUserProfile($user);
        }


      } catch (\Exception $e) {
        \Drupal::logger('eventbrite cron')
          ->log(RfcLogLevel::ERROR, 'User {mail} hasn\'t been created.', ['mail' => $a->attendee->email]);
      }
    }


  }

  private function getLastAccessTime() {
    $lastAccessTime = \Drupal::configFactory()->get('custom.dccsHacks')
      ->get('lastAccessTime');
    $this->lastAccessTime = $lastAccessTime;
  }

  private function setLastAccessTime() {
    \Drupal::configFactory()->getEditable('custom.dccsHacks')
      ->set('lastAccessTime', date('c'))
      ->save();
  }

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