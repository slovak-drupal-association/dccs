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

//dsm($comment);
$date_created_ts = $comment->timestamp;

$date_created = explode("-", format_date($date_created_ts, "custom", "D, Y.m.d H:i"));

//dsm($node);

?>
<div style="color:white;">.</div>
<div>
      <div class="comment-text">
        <strong style="font-size: 15px;"><?php echo $comment->subject;?></strong>
        <?php print $content ?>
      </div><!--.commentText-->
      <div class="comment_text_bottom"><img src="/<?php print path_to_theme(); ?>/images/comment_triangle.png" border="0"></div>
      
      <div class="submitted">
        <?php //print $submitted ?>
          <div class="submitted_name"><?php echo $comment->name?> </div>
          <div class="submitted_date_time">&nbsp;on <?php echo $date_created[0]?></div>
          <div id="reply_button"><a href="../comment/reply/<?php echo $comment->nid?>/<?php echo $comment->cid?>" style="color:white;">Reply</a></div>
      </div>

      <div class="comment-meta">
        <?php print $signature ?>
        <?php print $picture ?>
      </div><!--.commentMeta-->

</div><!--#comment-->
