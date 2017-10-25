<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform"  method="get">
 	<div class="wrap-search">
  		<input type="text" class="form-search" name="s" value="" placeholder="<?php esc_html_e('Search...','book-junky'); ?>">
 		<button type="submit" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
 		<input type="hidden" name="post_type" value="post" />
 	</div>
</form>