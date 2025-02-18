<?php

/**
 * Index
 */
get_header();
$mediumish_homeslider_active = get_theme_mod('mediumish_homeslider_active');
$mediumish_option_homeslider_recentposts = get_theme_mod('mediumish_option_homeslider_recentposts');
$slidertag = get_theme_mod('mediumish_option_homeslider');
if ($mediumish_option_homeslider_recentposts == 1) {
    $slidertag = '';
}
$slidernumber = get_theme_mod('mediumish_option_homeslider_numberposts');
$mediumish_postsbycategory_active = get_theme_mod('mediumish_postsbycategory_active');
$postcategories = get_theme_mod('mediumish_option_postsbycategory');
$mediumish_homecategorycloud_active = get_theme_mod('mediumish_homecategorycloud_active');
$mediumish_homecategorycloud_bg = get_theme_mod('mediumish_homecategorycloud_bg');
$mediumish_allstories = get_theme_mod('all_stories_text', 'All Stories');
global $do_not_duplicate;
$do_not_duplicate = array();
?>

<div class="container">


    <?php

    if (is_home()) :
        if (is_paged()) { ?><style>
                .listpostsbycats,
                #main-slider {
                    display: none;
                }
            </style><?php } ?>


        <!-- SLIDER -->

        <?php
        if ($mediumish_homeslider_active == 0) {
        ?>
            <div id="main-slider" class="carousel slide margb-2" data-ride="carousel">
                <?php
                $args = array(
                    'tag__in' => $slidertag,
                    'ignore_sticky_posts' => 1,
                    'posts_per_page' => $slidernumber
                );
                $slider = new WP_Query($args);
                $count = $slider->post_count;
                if ($slider->have_posts()) :
                    if ($slider->post_count > 1) {  // Check if there's more than one post in the query
                        echo '<ol class="carousel-indicators">';
                        for ($i = 0; $i < $slider->post_count; $i++) {
                            echo '<li data-target="#main-slider" data-slide-to="' . $i . '"' . (($i == 0) ? ' class="active"' : '') . '></li>';
                        }
                        echo '</ol>';
                    }
                ?>
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i = 0;
                        while ($slider->have_posts()) :  $slider->the_post();
                            $do_not_duplicate[] = $post->ID;
                        ?>
                            <div class="carousel-item <?php echo ($i == 0) ? 'active' : '' ?>">
                                <a href="<?php echo (the_permalink()); ?>">
                                    <?php if (get_the_post_thumbnail(get_the_ID())) {
                                        the_post_thumbnail(
                                            'large',
                                            array(
                                                'class' => 'd-block',
                                                'data-no-lazy' => '1',
                                                'alt' => get_the_title()
                                            )
                                        );
                                    } else { ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/default.jpg" data-no-lazy="1" alt="<?php the_title(); ?>" />
                                    <?php } ?>
                                    <div class="carousel-caption d-flex h-100 align-items-center">
                                        <h3 class="carousel-excerpt d-block">
                                            <span class="title d-block"><?php the_title(); ?></span>
                                            <span class="fontlight d-block hidden-md-down"><?php echo excerpt(35); ?></span>
                                            <span class="btn btn-simple"><?php _e('Read More', 'mediumish'); ?></span>
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        <?php
                            $i++;
                        endwhile;
                        ?>
                    </div>
                    <?php if ($count > 1) : ?>
                        <a href="#main-slider" class="carousel-control-prev" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a href="#main-slider" class="carousel-control-next" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    <?php endif; ?>
                <?php
                endif;
                wp_reset_postdata();
                ?>
            </div>
        <?php
        } ?>

        <!-- POSTS BY CATEGORIES -->
        <?php if ($mediumish_postsbycategory_active == 0) :
            if (!empty($postcategories)) :
                foreach ($postcategories as $postcategory) :
                    $category = $postcategory['categoryfield'];
                    $postsperpage = $postcategory['postsperpage'];
                    $styleoption = $postcategory['categorystyle'];
                    if ($styleoption == "style-1") {
                        $catstyle = "style-1";
                    } else  if ($styleoption == "style-2") {
                        $catstyle = "style-2";
                    } else if ($styleoption == "style-3") {
                        $catstyle = "style-3";
                    } else if ($styleoption == "style-4") {
                        $catstyle = "style-4";
                    } else if ($styleoption == "style-5") {
                        $catstyle = "style-5";
                    } else if ($styleoption == "style-6") {
                        $catstyle = "style-6";
                    } else {
                        $catstyle = "style-1";
                    }
                    $post_thumbnail_id = get_post_thumbnail_id($post);
                    if ($catstyle == 'style-1') {
                        $args = array(
                            'category__in' => $category,
                            'posts_per_page' => $postsperpage,
                            'post__not_in' => $do_not_duplicate
                        );
                        $the_query = new WP_Query($args);
                        $firstpost = true;
                        if ($the_query->have_posts()) :    ?>
                            <?php if (!is_paged()) { ?>
                                <div class="section-title listpostsbycats">
                                    <h2 class="d-flex justify-content-between align-items-center">
                                        <span><?php echo get_cat_name($category); ?> &nbsp;</span>
                                        <a class="d-block morefromcategory" href="<?php echo esc_url(get_category_link($category)); ?>">
                                            &nbsp; <i class="fa fa-angle-right"></i>
                                        </a>
                                    </h2>
                                </div>
                            <?php } ?>

                            <div class="row listrecent listpostsbycats  thiscatstyle1 post-style-1">
                                <?php
                                while ($the_query->have_posts()) :
                                    $the_query->the_post();
                                    $post = $the_query->post;
                                    $do_not_duplicate[] = $post->ID;
                                    if ($firstpost) : ?>
                                        <div class="col-md-12 col-lg-4 grid-item" id="post-<?php echo the_ID(); ?>">
                                            <?php echo mediumish_post_card_highlight_first(); ?>
                                        </div>
                                        <div class="col-md-12 col-lg-8">
                                            <div class="row h-100 skipfirst">
                                            <?php $firstpost = false;
                                        endif; ?>
                                            <?php if (!is_paged()) { ?>
                                                <div class="col-md-6 col-lg-6 grid-item" id="post-<?php echo the_ID(); ?>">
                                                    <?php echo mediumish_post_card_after_highlight(); ?>
                                                </div>
                                            <?php } ?>
                                        <?php endwhile; ?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                            </div>
                        <?php
                        endif;
                    } else if ($catstyle == 'style-2') {
                        global $post_ids;
                        $args = array(
                            'category__in' => $category,
                            'posts_per_page' => $postsperpage,
                            'post__not_in' => $do_not_duplicate
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) :
                        ?>
                            <?php if (!is_paged()) { ?>
                                <div class="section-title listpostsbycats">
                                    <h2 class="d-flex justify-content-between align-items-center">
                                        <span><?php echo get_cat_name($category); ?> &nbsp;</span>
                                        <a class="d-block morefromcategory" href="<?php echo esc_url(get_category_link($category)); ?>">
                                            &nbsp; <i class="fa fa-angle-right"></i>
                                        </a>
                                    </h2>
                                </div>
                            <?php } ?>
                            <section class="featured-posts listpostsbycats post-style-2">
                                <div class="row listfeaturedtag h-100">
                                    <?php
                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                        $post = $the_query->post;
                                        $do_not_duplicate[] = $post->ID;
                                    ?>
                                        <div class="col-md-6 mb-30">
                                            <?php echo mediumish_post_card_tall(); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </section>
                        <?php endif;
                        wp_reset_query();
                    } else if ($catstyle == 'style-3') {
                        global $post_ids;
                        $args = array(
                            'category__in' => $category,
                            'posts_per_page' => $postsperpage,
                            'post__not_in' => $do_not_duplicate
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) :
                        ?>
                            <?php if (!is_paged()) { ?>
                                <div class="section-title listpostsbycats">
                                    <h2 class="d-flex justify-content-between align-items-center">
                                        <span><?php echo get_cat_name($category); ?> &nbsp;</span>
                                        <a class="d-block morefromcategory" href="<?php echo esc_url(get_category_link($category)); ?>">
                                            &nbsp; <i class="fa fa-angle-right"></i>
                                        </a>
                                    </h2>
                                </div>
                            <?php } ?>
                            <section class="poststyle-3 post-style-3 listpostsbycats">
                                <div class="row h-100">
                                    <?php
                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                        $post = $the_query->post;
                                        $do_not_duplicate[] = $post->ID;
                                    ?>
                                        <div class="col-md-4 mb-30">
                                            <?php echo mediumish_postbox_default(); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </section>
                        <?php endif;
                        wp_reset_query();
                    } else if ($catstyle == 'style-4') {
                        global $post_ids;
                        $args = array(
                            'category__in' => $category,
                            'posts_per_page' => $postsperpage,
                            'post__not_in' => $do_not_duplicate
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) :
                        ?>
                            <?php if (!is_paged()) { ?>
                                <div class="section-title listpostsbycats">
                                    <h2 class="d-flex justify-content-between align-items-center">
                                        <span><?php echo get_cat_name($category); ?> &nbsp;</span>
                                        <a class="d-block morefromcategory" href="<?php echo esc_url(get_category_link($category)); ?>">
                                            &nbsp; <i class="fa fa-angle-right"></i>
                                        </a>
                                    </h2>
                                </div>
                            <?php } ?>
                            <section class="post-style-4 listpostsbycats">
                                <div class="row h-100">
                                    <?php
                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                        $post = $the_query->post;
                                        $do_not_duplicate[] = $post->ID;
                                    ?>
                                        <div class="col-md-3 mb-30">
                                            <?php echo mediumish_postbox_default(); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </section>
                        <?php endif;
                        wp_reset_query();
                    } else if ($catstyle == 'style-5') {
                        global $post_ids;
                        $args = array(
                            'category__in' => $category,
                            'posts_per_page' => $postsperpage,
                            'post__not_in' => $do_not_duplicate
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) :
                        ?>
                            <?php if (!is_paged()) { ?>
                                <div class="section-title listpostsbycats">
                                    <h2 class="d-flex justify-content-between align-items-center">
                                        <span><?php echo get_cat_name($category); ?> &nbsp;</span>
                                        <a class="d-block morefromcategory" href="<?php echo esc_url(get_category_link($category)); ?>">
                                            &nbsp; <i class="fa fa-angle-right"></i>
                                        </a>
                                    </h2>
                                </div>
                            <?php } ?>
                            <section class="post-style-5 listpostsbycats">
                                <div class="row h-100">
                                    <?php
                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                        $post = $the_query->post;
                                        $do_not_duplicate[] = $post->ID;
                                    ?>
                                        <div class="col-md-4 mb-30">
                                            <?php echo mediumish_post_card_tall(); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </section>
                        <?php endif;
                        wp_reset_query();
                    } else if ($catstyle == 'style-6') {
                        global $post_ids;
                        $args = array(
                            'category__in' => $category,
                            'posts_per_page' => $postsperpage,
                            'post__not_in' => $do_not_duplicate
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) :
                        ?>
                            <?php if (!is_paged()) { ?>
                                <div class="section-title listpostsbycats">
                                    <h2 class="d-flex justify-content-between align-items-center">
                                        <span><?php echo get_cat_name($category); ?> &nbsp;</span>
                                        <a class="d-block morefromcategory" href="<?php echo esc_url(get_category_link($category)); ?>">
                                            &nbsp; <i class="fa fa-angle-right"></i>
                                        </a>
                                    </h2>
                                </div>
                            <?php } ?>
                            <section class="post-style-6 listpostsbycats">
                                <div class="row h-100">
                                    <?php
                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                        $post = $the_query->post;
                                        $do_not_duplicate[] = $post->ID;
                                    ?>
                                        <div class="col-md-6 mb-30">
                                            <?php echo mediumish_postbox_default(); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </section>
    <?php endif;
                        wp_reset_query();
                    }
                endforeach;
            endif;
        endif;
    endif;
    ?>
    <div class="clearfix"></div>

    <!-- BLOG POSTS ALL STORIES -->
    <section class="recent-posts">
        <div class="section-title">

            <h2>
                <?php
                if (is_search()) {
                    echo 'Search results for: <span>' . get_query_var('s') . '</span>';
                } else if (is_archive()) {
                    echo '<span>' . mediumish_archive_title() . '</span>';
                } else { ?>
                    <span><?php echo $mediumish_allstories; ?></span>
                <?php } ?>
            </h2>
        </div>
        <?php
        if (have_posts()) : ?>
            <!-- begin loop -->
            <div class="row listrecent">
                <?php
                $mediumish_main_query = new WP_Query(array(
                    'post__not_in' => $do_not_duplicate,
                    'paged'        => $paged
                ));
                while ($mediumish_main_query->have_posts()) :
                    $mediumish_main_query->the_post(); ?>
                    <div class="col-md-6 col-lg-4 grid-item" id="post-<?php echo the_ID(); ?>">
                        <?php echo mediumish_postbox_default(); ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <!-- end loop -->
            <!-- pagination -->
            <div class="bottompagination">
                <?php wp_bootstrap_pagination(array(
                    'custom_query'    => TRUE,
                    'custom_query' => $mediumish_main_query,
                    'previous_string' => '<i class="fa fa-angle-double-left"></i>',
                    'next_string' => '<i class="fa fa-angle-double-right"></i>',
                    'before_output' => '<span class="navigation">',
                    'after_output' => '</span>'
                )); ?>
            </div>
        <?php else : ?>
            <p><?php _e('Sorry, no posts matched your criteria.', 'mediumish'); ?></p>
        <?php endif;
        wp_reset_query(); ?>
    </section>


    <!-- JUMBO CATEGORIES CLOUD -->
    <?php if ($mediumish_homecategorycloud_active == 0) : ?>
        <div class="jumbotron fortags mt-4" <?php if ($mediumish_homecategorycloud_bg) { ?> style="background-image:url(<?php echo $mediumish_homecategorycloud_bg; ?>);" <?php } ?>>
            <div class="row">
                <div class="col-md-4 align-self-center text-center">
                    <h2 class="hidden-sm-down text-white"><?php _e('Explore', 'mediumish'); ?> &rarr;</h2>
                </div>
                <div class="col-md-8 align-self-center text-center">
                    <?php wp_tag_cloud(array('taxonomy' => 'category')); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
<!-- /.container -->

<?php get_footer(); ?>