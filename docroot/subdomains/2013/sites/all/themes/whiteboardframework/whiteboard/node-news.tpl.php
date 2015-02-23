<?php

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>


<?php

//split date into specific format : ex. APR 19 2012
$date_created_ts = $node->created;

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
            <!--<div id="news_comment_box">-->
                <?php //echo $node->comment_count;?>
            <!--</div>-->
        </div>
    </div>
    <div id="news_block_main" style="height:650px;">
        <div id="news_title"><?php echo $node->title;?></div>
        <div id="news_teaser"><?php echo $node->body;?></div>
        <div id="news_bottom_container">
            <!--<div id="news_comment_links">
                <?php //if(!$user->uid) {?>
                    <a href="../user/login?destination=<?php echo $path;?>"><strong>Log in</strong></a> or <a href="../user/register?destination=<?php echo $path;?>"><strong>create account</strong></a> to post comments
                <?php //} else {?>
                    <div id="news_comment_icon"><img src="/<?php echo path_to_theme()?>/images/icon_comment.png" border="0"></div>
                    <div id="news_comment_url"><a href="#comment-form"><strong>Add Comment</strong></a></div>                    
                <?php //} ?>
            </div>-->
            <div id="news_tags">
                <?php 
                    foreach($node->taxonomy as $term) {
                    $tid = $term->tid;
                    $path = drupal_lookup_path('alias', 'taxonomy/term/'.$tid);
                ?>
                    <div class="news_tags_link"><a href="/<?php echo $path?>"><img src="/<?php echo path_to_theme()?>/images/icon_tag.png" border="0"> <?php echo $term->name?></a></div>
                <?php } ?>
            </div>
        </div>
        <div id="news_back">
            <div id="back_icon"><img src="/<?php echo path_to_theme()?>/images/arrow_back.png" border="0"></div>
            <div id="back_link"><a href="javascript:history.back(1)">BACK</a></div>
        </div>
    </div>
</div>

