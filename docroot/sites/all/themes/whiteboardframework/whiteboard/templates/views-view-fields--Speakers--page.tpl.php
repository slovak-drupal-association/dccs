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
//echo $fields['field_order_value']->content;
    if($fields['field_order_value']->content == 1)
    {
?>
<div id="first_speaker">
    <h1><?php echo $fields['title']->content?></h1>
    <div id="first_speaker_text">
        <?php echo $fields['field_position_value']->content?><br><?php echo $fields['field_company_value']->content?><br><br>
        <?php echo $fields['field_desc_value']->content?>
    </div>
    <div id="first_speaker_image"><?php echo $fields['field_speaker_main_fid']->content?></div>
</div>
<h1 style="text-transform:uppercase;padding-top:30px;padding-bottom:20px;">Featured Speakers</h1>
<?php }else{ ?>
<div id="featured_speaker">
    <div id="featured_speaker_image"><?php echo $fields['field_speaker_featured_fid']->content?></div>
    <div id="featured_speaker_text">
        <strong><?php echo $fields['title']->content?></strong> <?php //echo $fields['field_company_value']->content?><br><br>
        <?php echo $fields['field_desc_value']->content?>
    </div>
</div>
<?php } ?>

