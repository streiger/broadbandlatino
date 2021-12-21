<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php _e( 'Search results for:', 'brizy-starter-theme' ); ?>
				</h1>
				<div class="page-description"><?php echo get_search_query(); ?></div>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

                /**
                 * If you want to override this in a child theme, then include a file
                 * called excerpt.php and that will be used instead.
                 */
				get_template_part( 'template-parts/excerpt' );

				// End the loop.
			endwhile;

            // Previous/next page navigation.
            the_posts_pagination(
                array(
                    'mid_size'  => 2,
                    'prev_text' => sprintf(
                        '<span class="nav-prev-text">%s</span>',
                        __( 'Newer posts', 'brizy-starter-theme' )
                    ),
                    'next_text' => sprintf(
                        '<span class="nav-next-text">%s</span>',
                        __( 'Older posts', 'brizy-starter-theme' )
                    ),
                )
            );

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/none' );

		endif;
		?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
