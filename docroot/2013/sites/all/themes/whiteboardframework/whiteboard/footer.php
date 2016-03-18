<?php

/**
 * @file footer.php
 * A footer file converted from the WordPress Whiteboard theme framework.
 */
?>
	<div class="clear"></div>
	</div><!--.container-->
	<div id="footer"><footer>
                
		<div class="container">
                        <?php //if(drupal_is_front_page()) {?>
                        <!--<div class="sponsor">
                            <ul>
                                <li><img src="/<?php print path_to_theme(); ?>/images/sponsors/drupalcamp-sponsor-organisedby.gif" border="0"></li>
                                <li><a href="http://www.exove.com" target="_blank"><img src="/<?php print path_to_theme(); ?>/images/sponsors/drupalcamp-sponsor-exove.gif" border="0"></a></li>
                                <li><a href="http://www.mearra.com" target="_blank"><img src="/<?php print path_to_theme(); ?>/images/sponsors/drupalcamp-sponsor-mearra.gif" border="0"></a></li>
                                <li><a href="http://www.drupal.org" target="_blank"><img src="/<?php print path_to_theme(); ?>/images/sponsors/drupalcamp-sponsor-drupal.gif" border="0"></li>
                            </ul>
                        </div>-->
                        <?php //} ?>
			<div id="footer-content">
        <?php print $footer_message; ?>
        <?php if (!empty($footer)): print $footer; endif; ?>
				<div id="nav-footer" class="nav"><nav>
          <?php if (!empty($footer_menu)): print $footer_menu; endif; ?>
				</nav></div><!--#nav-footer-->
			</div><!--#footer-content-->
		</div><!--.container-->
	</footer></div><!--#footer-->
</div><!--#main-->
<?php print $closure ?>
</body>
</html>
