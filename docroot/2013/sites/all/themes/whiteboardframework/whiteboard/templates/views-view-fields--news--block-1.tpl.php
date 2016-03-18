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
?>

<?php

//dsm($fields);

//get news path
$path = drupal_lookup_path('alias',"node/". $row->nid);

//split date into specific format : ex. APR 19 2012
$date_created_ts = $fields['created']->raw;

$date_created = explode("-", format_date($date_created_ts, "custom", "F-d-Y"));

$month_created = substr($date_created[0], 0, 3);
$day_created = $date_created[1];
$year_created = $date_created[2];


$tags = $fields['tid']->content;

$tagArray = explode(",",$tags);

?>

<div id="news_block">
    <div id="news_block_left">
        <div id="news_date">
        	<div class="news_date_container">
            		<div id="news_date_month"><?php echo $month_created;?></div>
            		<div id="news_date_day"><?php echo $day_created;?></div>
            		<div id="news_date_year"><?php echo $year_created;?></div>
           	</div>
        </div>        
	<!--<div id="news_comments">
            <div id="news_comment_box">
                <?php //echo $fields['comment_count']->raw;?>
            </div>
        </div>-->
    </div>
    <div id="news_block_main">
        <div id="news_title"><?php echo $fields['title']->content;?></div>
        <div id="news_teaser"><?php echo $fields['teaser']->content;?></div>
        <div id="news_read_more"><a href="<?php echo $path;?>">Read more &rsaquo;</a></div>
        <div id="news_bottom_container">
            <!--<div id="news_comment_links">
                <?php //if(!$user->uid) {?>
                    <a href="user/login?destination=<?php echo $path;?>"><strong>Log in</strong></a> or <a href="user/register?destination=<?php echo $path;?>"><strong>create account</strong></a> to post comments
                <?php //} else {?>
                    <div id="news_comment_icon"><a href="<?php echo $path;?>#comment-form"><img src="/<?php echo path_to_theme()?>/images/icon_comment.png" border="0"></a></div>
                    <div id="news_comment_url"><a href="<?php echo $path;?>#comment-form"><strong>Add Comment</strong></a></div>                    
                <?php //} ?>
            </div>-->
            <div id="news_tags">
                <?php 
                    foreach($tagArray as $tag) {
                     if($tag!=''){
                ?>
                <div class="news_tags_link"><img src="/<?php echo path_to_theme()?>/images/icon_tag.png" border="0"> <?php echo $tag?></div>
                <?php }}?>
            </div>
        </div>
    </div>
</div>