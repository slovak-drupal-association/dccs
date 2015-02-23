<?php
  global $base_url;
  global $base_path;
  print '<div class="flexslider"><ul class="slides">';
  foreach ($view->result as $item) {
    $speaker_name = $item->node_title;
    $node = node_load($item->nid);
    print '<li>
            <div class="speaker_main_block" id="shadow">
                <div class="speaker_image"><a href="/speakers"><img src="'.$base_url.$base_path.$node->field_image[0]['filepath'].'" border="0"></a></div>
                <div class="speaker_body">
                    <div class="speaker_name">'.$node->title.'</div>
                    <div class="speaker_position">'.$node->field_position[0]['value'].', '.$node->field_company[0]['value'].'</div>
                    <div class="speaker_text">'.$node->teaser.'</div>
                    <div class="speaker_readmore"><a href="/speakers">read more ></a></div>
                </div>
            </div>
           </li>';
  }
  print '</ul></div>';
?>