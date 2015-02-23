

<?php

$path = drupal_lookup_path('alias',"node/". $row->nid);

//split date into specific format : ex. APR 19 2012
$date_created_ts = $fields['created']->raw;

$date_created = explode("-", format_date($date_created_ts, "custom", "F-d-Y"));

$month_created = substr($date_created[0], 0, 3);
$day_created = $date_created[1];
$year_created = $date_created[2];
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
        <div id="news_comments">
            <!--<div id="news_comment_box">
                <?php //echo $fields['comment_count']->raw;?>
            </div>-->
        </div>
    </div>
    <div id="news_block_main">
        <div id="news_title"><?php echo $fields['title']->content;?></div>
        <div id="news_teaser"><?php echo $fields['teaser']->content;?></div>
        <div id="news_read_more"><a href="<?php echo $path;?>">Read more &rsaquo;</a></div>
        <!--<div id="news_bottom_container">-->
            <!--<div id="news_comment_links">
                <?php //if(!$user->uid) {?>
                    <a href="../user/login?destination=<?php echo $path;?>"><strong>Log in</strong></a> or <a href="../user/register?destination=<?php echo $path;?>"><strong>create account</strong></a> to post comments
                <?php //} else {?>
                    <div id="news_comment_icon"><img src="/<?php echo path_to_theme()?>/images/icon_comment.png" border="0"></div>
                    <div id="news_comment_url"><a href="<?php echo $path;?>#comment-form"><strong>Add Comment</strong></a></div>                    
                <?php //} ?>
            </div>-->
            <!--<div id="news_tags">-->
                <?php 
                    /*foreach($node->tid as $term) {
                    $tid = $term->tid;
                    $path = drupal_lookup_path('alias', 'taxonomy/term/'.$tid);*/
                ?>
                   <!-- <div class="news_tags_link"><a href="/<?php echo $path?>"><img src="/<?php echo path_to_theme()?>/images/icon_tag.png" border="0"> <?php echo $term->name?></a></div>-->
                <?php //} ?>
            <!--</div>-->
        <!--</div>-->
        <!--<div id="news_back">
            <div id="back_icon"><img src="/<?php echo path_to_theme()?>/images/arrow_back.png" border="0"></div>
            <div id="back_link"><a href="javascript:history.back(1)">BACK</a></div>
        </div>-->
    </div>
</div>
