<?php
/**
 * Page
 */
get_header(); ?>

<div class="container"> 
    <div class="section-title"> 
            <h2>
                <span><?php woocommerce_page_title(); ?></span>
                <small class="pull-right"><?php woocommerce_breadcrumb(); ?></small>
                <div class="clearfix"></div>
            </h2> 
        </div>
    <div class="row justify-content-center">
        
        <div class="<?php if ( is_active_sidebar( 'sidebar-woocommerce' ) ) { ?> col-md-9 <?php } else { ?> col-md-12 <?php } ?>">
			<?php woocommerce_content(); ?>
		</div>
        
        <?php if ( is_active_sidebar( 'sidebar-woocommerce' ) ) : ?>
            <div class="col-md-3">
                <?php get_sidebar('woocommerce');?>
            </div>
        <?php endif; ?>
        
	</div>
</div>

<?php get_footer();