<?php
namespace Drupal\eventbrite;

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