<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

//dsm($fields);
?>


<?php

$path = drupal_lookup_path('alias',"node/". $row->nid);

$track = 'all';

if(isset($_GET['track']))
{
   switch($_GET['track'])
   {
       case 'main':
           $track = 'main';
           break;
       case 'sidetrack1':
           $track = 'sidetrack1';
           break;
       case 'sidetrack2':
           $track = 'sidetrack2';
           break;
       default:
           $track = 'all';
           break;
   }
}

//get session timeslot
$timeslot_arr = explode(" ", $fields['field_session_slot_nid']->content);
$timeslot = $timeslot_arr[2].' - '.$timeslot_arr[4];

$trackName = $trackId = $sessionBackground = '';

$sessionBackground = 'default';

if($fields['field_track_value']->raw == 'main')
{
    $trackName = 'MAIN';
    $trackId = 'main-track';
    $sessionBackground = 'default';
}
elseif($fields['field_track_value']->raw == 'sidetrack1')
{
    $trackName = 'TRACK 1';
    $trackId = 'track1';
    $sessionBackground = 'default';
}
elseif($fields['field_track_value']->raw == 'sidetrack2')
{
    $trackName = 'TRACK 2';
    $trackId = 'track2';
    $sessionBackground = 'default';
}
elseif($fields['field_track_value']->raw == 'break')
{
    $sessionBackground = 'break';
}

?>


<?php if(($track == 'all') || ($track == $fields['field_track_value']->raw) || ($fields['field_track_value']->raw == 'break')) { ?>
<div class="session_<?php echo $sessionBackground?>">
    <div class="session_time">
            <div id="session_timeslot_<?php echo $sessionBackground?>"><?php echo $timeslot;?></div>
            <?php if($track == 'all') { ?>
                <div class="track_button"><a href="?track=<?php echo $fields['field_track_value']->raw;?>" style="color:#ffffff;"><div id="<?php echo $trackId?>"><?php echo $trackName; ?></div></a></div>
            <?php } ?>
    </div>
    <div class="session_desc">
        <div><strong id="session_title_<?php echo $sessionBackground?>"><a href="<?php echo $path?>"><?php echo $fields['title']->content;?></a></strong> </div>
        <div id="speaker_link">
            <?php 
                if($fields['field_track_value']->raw != 'break')
                    echo $fields['field_session_speakers_nid']->content;
            ?>
            <?php echo $fields['ops']->content;?>
        </div>
    </div>
    <div class="session_level">
        <?php
            if($fields['field_track_value']->raw != 'break')
            {
                if($fields['field_experience_value']->raw == 'beginner')
                {
                    echo '<img src="/'.path_to_theme().'/images/level1.png" border="0">';
                }
                elseif($fields['field_experience_value']->raw == 'intermediate')
                {
                    echo '<img src="/'.path_to_theme().'/images/level2.png" border="0">';
                }
                elseif($fields['field_experience_value']->raw == 'advanced')
                {
                    echo '<img src="/'.path_to_theme().'/images/level3.png" border="0">';
                }
            }
        ?>
    </div>
    <div></div>
</div>
<?php } ?>



