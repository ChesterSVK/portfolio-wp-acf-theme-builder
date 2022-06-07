<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package progresio
 */

?>

<div class="title">
	<div class="title_inner"><?php esc_html_e( 'Nothing Found', THEME_DOMAIN ); ?></div>
</div>
<div class="content-none">
	<?php
	if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'glitche' ); ?></p>
	<?php else : ?>
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'glitche' ); ?></p>
	<?php endif; ?>
</div>
<!-- END CONTENT NONE -->