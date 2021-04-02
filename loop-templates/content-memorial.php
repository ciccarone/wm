<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<h1><?php echo do_shortcode('[memorial_name type="full"]') ?></h1>
		<p><?php echo do_shortcode('[memorial_time type="birthdate"]') ?> - <?php echo do_shortcode('[memorial_time type="deathdate"]') ?></p>
    <p><?php echo do_shortcode('[memorial_time type="age"]') ?> years old</p>
    <p>Born in <?php echo do_shortcode('[memorial_location type="birthplace"]') ?></p>
    <p>Lived in <?php echo do_shortcode('[memorial_location type="general"]') ?></p>
    <p>Died in <?php echo do_shortcode('[memorial_location type="deathplace"]') ?></p>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
