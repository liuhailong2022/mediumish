<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php
    global $post;
    global $post_ids;

    $mediumish_headertwitterlink = get_theme_mod('mediumish_headertwitterlink');
    $headersociallinks = get_theme_mod('mediumish_headersociallink');
    $mediumish_headersearchlink = get_theme_mod('mediumish_headersearch_active');
    $disableauthorbox = get_theme_mod('disable_authorbox_sectionarticles_card');
    $disablereadingtimecard = get_theme_mod('disable_readingtime_sectionarticles_card');
    $disablereadingtime = get_theme_mod('disable_readingtime_sectionarticles');
    $disabledate = get_theme_mod('disable_date_sectionarticles_card');
    $disabledot = get_theme_mod('disable_dot_sectionarticles_card');
    $disableprevnext = get_theme_mod('disable_prevnext_sectionarticles', true);
    ?>
    <style>
        <?php
        if ($disableprevnext == true) { ?>.prevnextlinks {
            display: none;
        }

        <?php }
        if ($disableauthorbox == true) { ?>.author-thumb,
        span.post-name {
            display: none;
        }

        <?php }
        if ($disablereadingtime == true || $disablereadingtimecard == 1) { ?>span.readingtime {
            display: none;
        }

        <?php }
        if ($disabledate == true) { ?>span.post-date {
            display: none;
        }

        <?php }
        if ($disabledot == true) { ?>span.author-meta span.dot {
            display: none;
        }

        <?php }
        ?>
    </style>


    <header class="navbar-light bg-white fixed-top mediumnavigation">

        <div class="container">

            <!-- Begin Logo -->
            <div class="row justify-content-center align-items-center brandrow">

                <div class="col-lg-4 col-md-4 col-xs-12 hidden-xs-down customarea">

                    <?php if ($mediumish_headertwitterlink) { ?>
                        <a class="btn follow" href="<?php echo esc_url($mediumish_headertwitterlink); ?>" target="blank"><i class="fab fa-twitter"></i> Follow</a>
                    <?php } ?>


                    <?php if (is_array($headersociallinks) || is_object($headersociallinks)) {
                        foreach ($headersociallinks as $headersociallink) : ?>
                            <a target="_blank" href="<?php echo $headersociallink['social_url']; ?>"> <i class="fab fa-<?php echo $headersociallink['social_icon']; ?> social"></i></a>
                    <?php endforeach;
                    } ?>

                </div>

                <div class="col-lg-4 col-md-4  col-xs-12 text-center logoarea">
                    <?php if (get_theme_mod('logo_sectionlogonav')) { ?>
                        <a class="blog-logo" href='<?php echo esc_url(home_url('/')); ?>' rel='home'><img src='<?php echo esc_url(get_theme_mod('logo_sectionlogonav')); ?>' alt='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>'></a>
                    <?php } else { ?>
                        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                    <?php } ?>
                </div>

                <div class="col-lg-4 col-md-4 mr-auto col-xs-12 text-right searcharea">
                    <?php if ($mediumish_headersearchlink == 0) { ?>
                        <?php get_search_form(); ?>
                    <?php } ?>
                </div>

            </div>
            <!-- End Logo -->

            <div class="navarea">

                <nav class="navbar navbar-toggleable-sm">
                    <button class="navbar-toggler collapsed navbar-toggler-right" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-close-icon">X</span>
                    </button>
                    <?php
                    wp_nav_menu([
                        'menu'            => 'primary',
                        'theme_location'  => 'primary',
                        'container'       => 'div',
                        'container_id'    => 'bs4navbar',
                        'container_class' => 'collapse navbar-collapse',
                        'menu_id'         => false,
                        'menu_class'      => 'navbar-nav col-md-12 justify-content-center',
                        'depth'           => 2,
                        'fallback_cb'     => 'bs4navwalker::fallback',
                        'walker'          => new bs4navwalker()
                    ]);
                    ?>
                    <?php
                    // 增加用户登录/注册按钮
                    if ( is_user_logged_in() ) { 
                        $current_user = wp_get_current_user();
                        ?>
                        <div class="user-menu">
                            <button class="user-dropdown-btn" aria-haspopup="true">
                                <img src="<?php echo esc_url( get_avatar_url( $current_user->ID ) ); ?>" alt="用户头像" class="user-avatar">
                            </button>
                            <div class="user-dropdown-content">
                                <a href="/account">个人中心</a>
                                <a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>">退出</a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <a href="/login" class="login-button">登录/注册</a>
                    <?php } ?>
                </nav>

            </div>

        </div>

    </header>


    <!-- Begin site-content
		================================================== -->
    <div class="site-content">