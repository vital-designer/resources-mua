<?php
/**
 * Search Form Template
 *
 * This template is used to show the search form.
 *
 * @package LifeCollage
 * @subpackage Template
 */

	global $search_num;
	++$search_num;
?>
			<div id="search<?php if ( $search_num ) echo '-' . $search_num; ?>" class="search">

				<form method="get" class="search-form" id="search-form<?php if ( $search_num ) echo '-' . $search_num; ?>" action="<?php bloginfo( 'home' ); ?>/">
				<div>
					<input class="search-text" type="text" name="s" id="search-text<?php if ( $search_num)  echo '-' . $search_num; ?>" tabindex="7" value="<?php if ( is_search() ) echo attribute_escape( get_search_query() ); else _e('Search this site...', 'collage'); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
					<input class="search-submit button" name="submit" type="submit" id="search-submit<?php if ( $search_num ) echo '-' . $search_num; ?>" tabindex="8" value="<?php _e('Go', 'collage'); ?>" />
				</div>
				</form>

			</div>