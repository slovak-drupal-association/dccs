<?php
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
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
//dsm($view);
//dsm($row);
//dsm($fields);

//if sponsor is Platinum
if($fields['field_sponsorship_level_value']->content == 'Platinum')
{
?>
    <!--<div style="width:230px;float:left;padding-right:30px;"><?php echo $fields['field_logo_fid']->content; ?></div>-->
<?php 
//if sponsor is Gold
}elseif($fields['field_sponsorship_level_value']->content == 'Gold'){ ?>
    <!--<div style="width:120px;float:left;"><?php echo $fields['field_gold_sponsor_fid']->content; ?></div>-->
<?php } ?>

<?php 
    foreach ($fields as $id => $field) { 
        //echo $field->field_logo_fid->content;
        print $field->content; 
    }
?>
