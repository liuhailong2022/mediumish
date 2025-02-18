<?php
/**
 * Page
 */
get_header(); ?>

<div class="container"> 
    <div class="section-title"> 
            <h2>
                <span><?php the_title(); ?></span>
            </h2> 
        </div>
    <div class="row justify-content-center">
        
        <div class="col-md-12">
			<?php
			while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                    
                    <div class="entry-content page-content">
                        <?php
                            the_content();
                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . __( 'Pages:', 'mediumish' ),
                                'after'  => '</div>',
                            ) );
                        ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-## -->
            
				<?php // If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; // End of the loop.
			?>
		</div>

	</div>
</div>

<?php get_footer();