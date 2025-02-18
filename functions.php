<?php

//-----------------------------------------------------
// Setup
//-----------------------------------------------------
if ( !function_exists( 'mediumish_setup' ) ) {
    function mediumish_setup()
    {
        if ( !isset( $content_width ) ) {
            $content_width = 730;
        }
        load_theme_textdomain( 'mediumish', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'woocommerce' );
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'mediumish' ),
        ) );
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'align-wide' );
        add_theme_support( "responsive-embeds" );
    }

}
add_action( 'after_setup_theme', 'mediumish_setup' );
// Freemius

if ( !function_exists( 'wow_med_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wow_med_fs()
    {
        global  $wow_med_fs ;
        
        if ( !isset( $wow_med_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $wow_med_fs = fs_dynamic_init( array(
                'id'               => '12216',
                'slug'             => 'mediumish',
                'premium_slug'     => 'mediumish',
                'type'             => 'theme',
                'public_key'       => 'pk_294633332ac6fdede3054f98d94d4',
                'is_premium'       => true,
                'is_premium_only'  => true,
                'has_addons'       => false,
                'has_paid_plans'   => true,
                'is_org_compliant' => false,
                'has_affiliation'  => 'selected',
                'menu'             => array(
                'slug'        => 'mediumish',
                'support'     => false,
                'affiliation' => false,
            ),
                'is_live'          => true,
            ) );
        }
        
        return $wow_med_fs;
    }
    
    // Init Freemius.
    wow_med_fs();
    // Signal that SDK was initiated.
    do_action( 'wow_med_fs_loaded' );
}

/******************************************************
 * Theme Admin Menu
 *****************************************************/
add_action( 'admin_menu', 'mediumish_top_lvl_menu' );
function mediumish_top_lvl_menu()
{
    add_menu_page(
        'Theme Setup',
        // page <title>Title</title>
        'Theme Setup',
        // link text
        'manage_options',
        // user capabilities
        'mediumish',
        // page slug
        'mediumish_admin_page_callback',
        // this function prints the page content
        'dashicons-admin-generic',
        // icon (from Dashicons for example)
        4
    );
}

function mediumish_admin_page_callback()
{
    global  $wow_med_fs ;
    if ( isset( $wow_med_fs ) ) {
        if ( !$wow_med_fs->is_whitelabeled() ) {
            echo  '<h1>Welcome to Mediumish setup!</h1><div  class="notice notice-info" style="padding:10px;">If this site belongs to your client, you can always hide this page and other account data (including contact form) from the "Account" submenu, using the white-label option.</div><h2>Get Started</h2><li>Install and activate the required plugins.</li><li>Optionally, import the demo content from "Appearance/Import Demo Data" (visible after plugins are installed and activated).</li><h2>24h Theme Installation & Demo Setup</h2><ul class="mb-4 list-unstyled"><p>In a hurry or not very technical? Let us do all the work for your with our <a target="_blank" href="https://buy.stripe.com/4gwcMQ99O2km3W89AE">24h theme demo setup service</a>.</p>
        <li>✓ Full setup of your theme.</li>
        <li>✓ Plugins, settings, options ready.</li>
        <li>✓ Full setup of demo content.</li>
        <li>✓ Your website will look just like the demo.</li>
        <p><a target="_blank" href="https://buy.stripe.com/4gwcMQ99O2km3W89AE" class="button-primary">Make my website look like the demo &rarr;</a></p>' ;
        }
    }
}

//-----------------------------------------------------
// WH-L STYLE
//-----------------------------------------------------
add_action( 'admin_head', 'wow_med_whitel_dash_info' );
// admin_head hook for admin styles
function wow_med_whitel_dash_info()
{
    global  $wow_med_fs ;
    if ( $wow_med_fs->is_whitelabeled() ) {
        echo  '<style> #toplevel_page_mediumish, #fs_account .inside, #fs_account .debug-license-trigger {display:none;} </style>' ;
    }
}

//-----------------------------------------------------
// Theme Version
//-----------------------------------------------------
$theme = wp_get_theme();
define( 'THEME_VERSION', $theme->Version );
//-----------------------------------------------------
// Scripts & Styles
//-----------------------------------------------------

if ( !function_exists( 'mediumish_enqueue_scripts' ) ) {
    function mediumish_enqueue_scripts()
    {
        wp_enqueue_script(
            'bootstrap4tether',
            get_template_directory_uri() . '/assets/js/tether.min.js',
            array( 'jquery' ),
            null,
            true
        );
        wp_enqueue_script(
            'bootstrap4',
            get_template_directory_uri() . '/assets/js/bootstrap.min.js',
            array( 'jquery' ),
            null,
            true
        );
        wp_enqueue_script(
            'mediumish-ieviewportbugworkaround',
            get_template_directory_uri() . '/assets/js/ie10-viewport-bug-workaround.js',
            array( 'jquery' ),
            null,
            true
        );
        wp_enqueue_script(
            'mediumish',
            get_template_directory_uri() . '/assets/js/mediumish.js',
            array( 'jquery' ),
            null,
            true
        );
        wp_enqueue_style(
            'bootstrap4',
            get_template_directory_uri() . '/assets/css/bootstrap.min.css',
            false,
            null,
            'all'
        );
        wp_enqueue_style(
            'font-awesome-6',
            'https://use.fontawesome.com/releases/v6.3.0/css/all.css',
            array(),
            '6.3.0'
        );
        wp_enqueue_style(
            'mediumish-style',
            get_stylesheet_uri(),
            [],
            THEME_VERSION,
            'all'
        );
        // 添加 Google Fonts 字体的代码无依赖冲突
        wp_enqueue_style(
            'custom-google-fonts',
            'https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@400;700&display=swap',
            false
        );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
    
    add_action( 'wp_enqueue_scripts', 'mediumish_enqueue_scripts' );
}

//----------------------------------------------------
// Register Widgets
//-----------------------------------------------------
if ( !function_exists( 'mediumish_sidebar_widgets_init' ) ) {
    function _widgets_init()
    {
        register_sidebar( array(
            'name'          => __( 'Sidebar WooCommerce Shop', 'mediumish' ),
            'id'            => 'sidebar-woocommerce',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );
    }

}
// _widgets_init
add_action( 'widgets_init', '_widgets_init' );
//-----------------------------------------------------
// Excerpt
//-----------------------------------------------------
function excerpt( $limit )
{
    $excerpt = explode( ' ', get_the_excerpt(), $limit );
    
    if ( count( $excerpt ) >= $limit ) {
        array_pop( $excerpt );
        $excerpt = implode( " ", $excerpt ) . '...';
    } else {
        $excerpt = implode( " ", $excerpt );
    }
    
    $excerpt = preg_replace( '`\\[[^\\]]*\\]`', '', $excerpt );
    return $excerpt;
}

function content( $limit )
{
    $content = explode( ' ', get_the_content(), $limit );
    
    if ( count( $content ) >= $limit ) {
        array_pop( $content );
        $content = implode( " ", $content ) . '...';
    } else {
        $content = implode( " ", $content );
    }
    
    $content = preg_replace( '/\\[.+\\]/', '', $content );
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    return $content;
}

//-----------------------------------------------------
// Reading Time
//-----------------------------------------------------
function mediumish_estimated_reading_time()
{
    $post = get_post();
    $content = strip_tags( $post->post_content );
    $words = str_word_count( $content );
    // Count the number of Chinese characters
    preg_match_all( "/[\\x{4e00}-\\x{9fa5}]/u", $content, $matches );
    $chinese_characters = count( $matches[0] );
    // If the content contains Chinese characters
    
    if ( $chinese_characters > 0 ) {
        $minutes = floor( $chinese_characters / 500 );
        $seconds = floor( $chinese_characters % 500 / (500 / 60) );
    } else {
        $minutes = floor( $words / 265 );
        $seconds = floor( $words % 265 / (265 / 60) );
    }
    
    
    if ( 1 <= $minutes ) {
        $estimated_time = $minutes . ' ' . esc_attr__( 'min read', 'mediumish' );
    } else {
        $estimated_time = $seconds . ' ' . esc_attr__( 'sec read', 'mediumish' );
    }
    
    return $estimated_time;
}

//-----------------------------------------------------
// Limit title characters
//-----------------------------------------------------
function limit_word_count( $title )
{
    $limitcharacterstitle = get_theme_mod( 'mediumish_limitcharacterstitle' );
    
    if ( $limitcharacterstitle ) {
        $len = $limitcharacterstitle;
    } else {
        $len = 9;
    }
    
    return wp_trim_words( $title, $len, '&hellip;' );
}

//-----------------------------------------------------
// Share
//-----------------------------------------------------
if ( !function_exists( 'mediumish_share_post' ) ) {
    function mediumish_share_post()
    {
        global  $post ;
        $shareURL = urlencode( get_permalink() );
        $shareTitle = str_replace( ' ', '%20', get_the_title() );
        $shareThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        $twitterURL = 'https://twitter.com/intent/tweet?text=' . $shareTitle . '&amp;url=' . $shareURL;
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $shareURL;
        $linkedinURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $shareURL . '&amp;title=' . $shareTitle;
        $disablesharetwitter = get_theme_mod( 'disable_share_twitter' );
        $disablesharefb = get_theme_mod( 'disable_share_fb' );
        $disablesharelinkedin = get_theme_mod( 'disable_share_linkedin' );
        echo  '
<ul class="shareitnow">' ;
        if ( $disablesharetwitter == 0 ) {
            echo  '<li>
        <a target="_blank" href="' . $twitterURL . '">
        <i class="fab fa-twitter"></i>
        </a>
    </li>' ;
        }
        if ( $disablesharefb == 0 ) {
            echo  '<li>
        <a target="_blank" href="' . $facebookURL . '">
        <i class="fab fa-facebook"></i>
        </a>
    </li>' ;
        }
        if ( $disablesharelinkedin == 0 ) {
            echo  '<li>
        <a target="_blank" href="' . $linkedinURL . '">
        <i class="fab fa-linkedin"></i>
        </a>
    </li>' ;
        }
        echo  '</ul>' ;
    }

}
//-----------------------------------------------------
// Hide applause button plugin, it's already in theme
//-----------------------------------------------------
add_filter( 'wpli/autoadd', function () {
    return false;
} );
//-----------------------------------------------------
// Meta Tag
//-----------------------------------------------------
function mediumish_custom_get_meta_excerpt()
{
    global  $post ;
    $temp = $post;
    $post = get_post();
    setup_postdata( $post );
    $excerpt = esc_attr( strip_tags( get_the_excerpt() ) );
    wp_reset_postdata();
    $post = $temp;
    return $excerpt;
}

function mediumish_custom_add_meta_description_tag()
{
    ?>
    <meta name="description" content="<?php 
    
    if ( is_single() || is_page() ) {
        $excerpt = mediumish_custom_get_meta_excerpt( get_the_ID() );
        echo  $excerpt ;
    } else {
        bloginfo( 'description' );
    }
    
    ?>" />
<?php 
}

if ( !class_exists( 'WPSEO_Options' ) ) {
    add_action( 'wp_head', 'mediumish_custom_add_meta_description_tag', 1 );
}
//-----------------------------------------------------
// Comment Form
//-----------------------------------------------------
function my_update_comment_fields( $fields )
{
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $label = ( $req ? '*' : ' ' . __( '(optional)', 'mediumish' ) );
    $aria_req = ( $req ? "aria-required='true'" : '' );
    $fields['author'] = '<div class="row"><p class="comment-form-author col-md-4">

			<input id="author" name="author" type="text" placeholder="' . esc_attr__( "Name", "mediumish" ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . ' />
		</p>';
    $fields['email'] = '<p class="comment-form-email col-md-4">

			<input id="email" name="email" type="email" placeholder="' . esc_attr__( "E-mail address", "mediumish" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . ' />
		</p>';
    $fields['url'] = '<p class="comment-form-url col-md-4">

			<input id="url" name="url" type="url"  placeholder="' . esc_attr__( "Website Link", "mediumish" ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
			</p></div>';
    return $fields;
}

add_filter( 'comment_form_default_fields', 'my_update_comment_fields' );
function my_update_comment_field( $comment_field )
{
    $comment_field = '<p class="comment-form-comment">
            <textarea required id="comment" name="comment" placeholder="' . esc_attr__( "Write a response...", "mediumish" ) . '" cols="45" rows="8" aria-required="true"></textarea>
        </p>';
    return $comment_field;
}

add_filter( 'comment_form_field_comment', 'my_update_comment_field' );
//-----------------------------------------------------
// Postbox
//-----------------------------------------------------
function mediumish_postbox()
{
    add_filter( 'the_title', 'limit_word_count' );
    global  $post ;
    $featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    echo  '<div class="card post postbox_default h-100">' ;
    
    if ( has_post_thumbnail() ) {
        echo  '<a class="postbox_default_thumbnail" href="' . get_permalink() . '" alt="' . get_the_title() . '">' ;
        the_post_thumbnail( 'medium_large' );
        echo  '</a>' ;
    }
    
    echo  '
        <div class="card-block">
            <h2 class="card-title"><a href="' . get_permalink() . '">' . substr( get_the_title(), 0, 200 ) . '</a></h2>
            <span class="card-text d-block">' . excerpt( 22 ) . '</span>
            <div class="metafooter">
                <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                        <a href="' . get_author_posts_url( $post->post_author ) . '">' . get_avatar(
        get_the_author_meta( 'user_email' ),
        '40',
        null,
        null,
        array(
        'class' => array( 'author-thumb' ),
    )
    ) . '</a>
                    </span>
                    <span class="author-meta">
                        <span class="post-name"><a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author_meta( 'display_name' ) . '</a></span><br> 
                        <span class="post-date">' . get_the_date( 'M j, Y' ) . '</span>
                        <span class="dot"></span>
                        <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                    </span>
                    <span class="post-read-more">
                        <a href="' . get_permalink() . '" title="Read Story">
                            <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                                <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>' ;
}

//-----------------------------------------------------
// Postbox Default
//-----------------------------------------------------
function mediumish_postbox_default()
{
    global  $post ;
    $featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    echo  '<div class="card post postbox_default h-100">' ;
    
    if ( has_post_thumbnail() ) {
        echo  '<a class="postbox_default_thumbnail" href="' . get_permalink() . '" alt="' . get_the_title() . '">' ;
        the_post_thumbnail( 'medium_large' );
        echo  '</a>' ;
    }
    
    echo  '
            <div class="card-block d-flex flex-column">
                <h2 class="card-title"><a href="' . get_permalink() . '">' . substr( get_the_title(), 0, 200 ) . '</a></h2>
                <span class="card-text">' . excerpt( 22 ) . '</span>
                <div class="metafooter mt-auto">
                    <div class="wrapfooter">
                        <span class="meta-footer-thumb">
                            <a href="' . get_author_posts_url( $post->post_author ) . '">' . get_avatar(
        get_the_author_meta( 'user_email' ),
        '40',
        null,
        null,
        array(
        'class' => array( 'author-thumb' ),
    )
    ) . '</a>
                        </span>
                        <span class="author-meta">
                            <span class="post-name"><a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author_meta( 'display_name' ) . '</a></span><br> 
                            <span class="post-date">' . get_the_date( 'M j, Y' ) . '</span>
                            <span class="dot"></span>
                            <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                        </span>
                        <span class="post-read-more">
                            <a href="' . get_permalink() . '" title="Read Story">
                                <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                                    <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>' ;
}

//-----------------------------------------------------
// Author Postbox (from list all authors)
//-----------------------------------------------------
function mediumish_authorpostbox()
{
    global  $post ;
    $featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    echo  '<div class="card post authorpost">' ;
    if ( $featured_img_url != '' ) {
        echo  '<a class="thumbimage" href="' . get_permalink() . '" style="background-image:url(' . $featured_img_url . ');"></a>' ;
    }
    echo  '
                <div class="card-block">
                    <h2 class="card-title"><a href="' . get_permalink() . '">' . substr( get_the_title(), 0, 200 ) . '</a></h2>
                    <span class="card-text d-block">' . excerpt( 25 ) . '</span>
                    <div class="metafooter">
                        <div class="wrapfooter">
                            <span class="author-meta">
                                <span class="post-date">' . get_the_date() . '</span>
                                <span class="dot"></span>' ;
    if ( comments_open() ) {
        echo  '
                    <span class="muted"><i class="fa fa-comments"></i> ' . get_comments_number() . '</span>
                    <span class="dot"></span>' ;
    }
    echo  '
                    <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                    </span>
                    <span class="post-read-more">
                        <a href="' . get_permalink() . '">
                            <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                                <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </span>
                    </div>
                </div>
            </div>
        </div>' ;
}

//-----------------------------------------------------
// Post Card Highlight First in Row
//-----------------------------------------------------
function mediumish_post_card_highlight_first()
{
    global  $post ;
    $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
    echo  '<div class="card post poststyle1big h-100">' ;
    if ( $featured_img_url != '' ) {
        echo  '<a href="' . get_permalink() . '"><img class="poststyle1big-img" src="' . $featured_img_url . '"></a>' ;
    }
    echo  '
        <div class="card-block d-flex flex-column">
            <h2 class="card-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
            <span class="card-text d-block">' . excerpt( 30 ) . '</span>
            <div class="metafooter mt-auto">
                <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                        <a href="' . get_author_posts_url( $post->post_author ) . '">' . get_avatar(
        get_the_author_meta( 'user_email' ),
        '40',
        null,
        null,
        array(
        'class' => array( 'author-thumb' ),
    )
    ) . '</a>
                    </span>
                    <span class="author-meta">
                        <span class="post-name"><a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author_meta( 'display_name' ) . '</a></span><br>
                        <span class="post-date">' . get_the_date( 'M j, Y' ) . '</span>
                        <span class="dot"></span>
                        <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                    </span>
                    <span class="post-read-more">
                        <a href="' . get_permalink() . '" title="Read Story">
                            <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                                <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>' ;
}

//-----------------------------------------------------
// Post Card After Highlight First in Row
//-----------------------------------------------------
function mediumish_post_card_after_highlight()
{
    global  $post ;
    $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
    echo  '<div class="card post h-100">' ;
    if ( $featured_img_url != '' ) {
        echo  '<a href="' . get_permalink() . '"><img class="poststyle1-img" src="' . $featured_img_url . '"></a>' ;
    }
    echo  '
        <div class="card-block d-flex flex-column">
            <h2 class="card-title"><a href="' . get_permalink() . '">' . substr( get_the_title(), 0, 200 ) . '</a></h2>' ;
    if ( $featured_img_url == '' ) {
        echo  '<span class="card-text d-block">' . excerpt( 25 ) . '</span>' ;
    }
    echo  '
            <div class="metafooter mt-auto pt-0">
                <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                        <a href="' . get_author_posts_url( $post->post_author ) . '">' . get_avatar(
        get_the_author_meta( 'user_email' ),
        '28',
        null,
        null,
        array(
        'class' => array( 'author-thumb' ),
    )
    ) . '</a>
                    </span>
                    <span class="author-meta">
                        <span class="post-name"><a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author_meta( 'display_name' ) . '</a></span><br>
                        <span class="post-date">' . get_the_date( 'M j, Y' ) . '</span>
                        <span class="dot"></span>
                        <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                    </span>
                    <span class="post-read-more">
                        <a href="' . get_permalink() . '" title="">
                            <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                                <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>' ;
}

//-----------------------------------------------------
// Post Card Tall
//-----------------------------------------------------
function mediumish_post_card_tall()
{
    global  $post ;
    $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
    echo  '<div class="card post_card_tall h-100" id="post-' . get_the_ID() . '">
        <div class="row h-100">' ;
    if ( $featured_img_url ) {
        echo  '<div class="col-lg-5 wrapthumbnail">
                <a class="d-block h-100" href="' . get_permalink() . '"><img src="' . $featured_img_url . '"></a>
            </div>' ;
    }
    echo  '<div class="' . (( $featured_img_url ? 'col-lg-7' : 'nothumbimage' )) . '">
            <div class="card-block d-flex flex-column h-100">
                <h2 class="card-title"><a href="' . get_permalink() . '">' . substr( get_the_title(), 0, 200 ) . '</a></h2>
                <span class="card-text d-block">' . excerpt( 20 ) . '</span>
                <div class="metafooter mt-auto">
                    <div class="wrapfooter">
                        <span class="meta-footer-thumb">
                            <a href="' . get_author_posts_url( $post->post_author ) . '">' . get_avatar(
        get_the_author_meta( 'user_email' ),
        '40',
        null,
        null,
        array(
        'class' => array( 'author-thumb' ),
    )
    ) . '</a>
                        </span>
                        <span class="author-meta">
                            <span class="post-name"><a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author_meta( 'display_name' ) . '</a></span><br>
                            <span class="post-date">' . get_the_date( 'M j, Y' ) . '</span>
                            <span class="dot"></span>
                            <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                        </span>
                        <span class="post-read-more">
                            <a href="' . get_permalink() . '" title="">
                                <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                                    <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>' ;
}

//-----------------------------------------------------
// Related Posts
//-----------------------------------------------------
function mediumish_related_posts( $args = array() )
{
    global  $post ;
    add_filter( 'the_title', 'limit_word_count' );
    // default args
    $args = wp_parse_args( $args, array(
        'post_id'   => ( !empty($post) ? $post->ID : '' ),
        'taxonomy'  => 'category',
        'limit'     => 3,
        'post_type' => ( !empty($post) ? $post->post_type : 'post' ),
        'orderby'   => 'date',
        'order'     => 'DESC',
    ) );
    // check taxonomy
    if ( !taxonomy_exists( $args['taxonomy'] ) ) {
        return;
    }
    // post taxonomies
    $taxonomies = wp_get_post_terms( $args['post_id'], $args['taxonomy'], array(
        'fields' => 'ids',
    ) );
    if ( empty($taxonomies) ) {
        return;
    }
    // query
    $related_posts = get_posts( array(
        'post__not_in'   => (array) $args['post_id'],
        'post_type'      => $args['post_type'],
        'limit'          => 3,
        'tax_query'      => array( array(
        'taxonomy' => $args['taxonomy'],
        'field'    => 'term_id',
        'terms'    => $taxonomies,
    ) ),
        'posts_per_page' => $args['limit'],
        'orderby'        => $args['orderby'],
        'order'          => $args['order'],
    ) );
    
    if ( !empty($related_posts) ) {
        echo  '<div class="row justify-content-center listrecent listrelated">' ;
        foreach ( $related_posts as $post ) {
            setup_postdata( $post );
            echo  '<div class="col-md-4 mb-30">' ;
            echo  mediumish_post_card_after_highlight() ;
            echo  '</div>' ;
        }
        echo  '</div>' ;
        echo  '<div class="clearfix"></div>' ;
    }
    
    wp_reset_postdata();
}

//-----------------------------------------------------
// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
//-----------------------------------------------------
function mediumish_archive_title()
{
    
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( 'Y', 'yearly archives date format' );
    } elseif ( is_month() ) {
        $title = get_the_date( 'F Y', 'monthly archives date format' );
    } elseif ( is_day() ) {
        $title = get_the_date( 'F j, Y', 'daily archives date format' );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = _( 'Posts', 'mediumish' );
    }
    
    return $title;
}

add_filter( 'get_the_archive_title', 'mediumish_archive_title' );
//-----------------------------------------------------
// Add social fields to user profile
//-----------------------------------------------------

if ( !function_exists( 'mediumish_user_fields' ) ) {
    function mediumish_user_fields( $contactmethods )
    {
        $contactmethods['twitter'] = 'Twitter';
        $contactmethods['facebook'] = 'Facebook';
        $contactmethods['youtube'] = 'YouTube';
        $contactmethods['location'] = 'Location';
        return $contactmethods;
    }
    
    add_filter(
        'user_contactmethods',
        'mediumish_user_fields',
        10,
        1
    );
}

//-----------------------------------------------------
// Ad Blocks
//-----------------------------------------------------
if ( !function_exists( 'wtn_ad_block_top_article' ) ) {
    function wtn_ad_block_top_article()
    {
        $toparticle = get_theme_mod( 'toparticle_sectionad' );
        if ( !empty($toparticle) ) {
            echo  '<div class="wtntopadarticle"><p>' . get_theme_mod( 'toparticle_sectionad' ) . '</p></div>' ;
        }
    }

}
if ( !function_exists( 'wtn_ad_block_bottom_article' ) ) {
    function wtn_ad_block_bottom_article()
    {
        $bottomarticle = get_theme_mod( 'bottomarticle_sectionad' );
        if ( !empty($bottomarticle) ) {
            echo  '<div class="wtnbottomadarticle"><p>' . get_theme_mod( 'bottomarticle_sectionad' ) . '</p></div>' ;
        }
    }

}
//-----------------------------------------------------
// Hide Featured Image from post
//-----------------------------------------------------
function hide_featured_image_get_meta( $value )
{
    global  $post ;
    $field = get_post_meta( $post->ID, $value, true );
    
    if ( !empty($field) ) {
        return ( is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) ) );
    } else {
        return false;
    }

}

function hide_featured_image_add_meta_box()
{
    add_meta_box(
        'hide_featured_image-hide-featured-image',
        __( 'Hide Featured Image', 'mediumish' ),
        'hide_featured_image_html',
        'post',
        'side',
        'default'
    );
}

add_action( 'add_meta_boxes', 'hide_featured_image_add_meta_box' );
function hide_featured_image_html( $post )
{
    wp_nonce_field( '_hide_featured_image_nonce', 'hide_featured_image_nonce' );
    $checkbox_state = ( hide_featured_image_get_meta( 'hide_featured_image_hide_featured_image_on_post' ) === 'hide-featured-image-on-post' ? 'checked' : '' );
    echo  '<p>
        <input type="checkbox" name="hide_featured_image_hide_featured_image_on_post" id="hide_featured_image_hide_featured_image_on_post" value="hide-featured-image-on-post" ' . $checkbox_state . '>
        <label for="hide_featured_image_hide_featured_image_on_post">' . __( 'Hide featured image on post', 'mediumish' ) . '</label>
    </p>' ;
}

function hide_featured_image_save( $post_id )
{
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( !isset( $_POST['hide_featured_image_nonce'] ) || !wp_verify_nonce( $_POST['hide_featured_image_nonce'], '_hide_featured_image_nonce' ) ) {
        return;
    }
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    if ( isset( $_POST['hide_featured_image_hide_featured_image_on_post'] ) ) {
        update_post_meta( $post_id, 'hide_featured_image_hide_featured_image_on_post', esc_attr( $_POST['hide_featured_image_hide_featured_image_on_post'] ) );
    } else {
        update_post_meta( $post_id, 'hide_featured_image_hide_featured_image_on_post', null );
    }

}

add_action( 'save_post', 'hide_featured_image_save' );
/*	Usage: hide_featured_image_get_meta( 'hide_featured_image_hide_featured_image_on_post' ) */
//-----------------------------------------------------
// Kirki Fonts All Variants
//-----------------------------------------------------
function mediumish_font_add_all_variants()
{
    if ( class_exists( 'Kirki_Fonts_Google' ) ) {
        Kirki_Fonts_Google::$force_load_all_variants = true;
    }
}

add_action( 'init', 'mediumish_font_add_all_variants' );
//-----------------------------------------------------
// Require
//-----------------------------------------------------
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/bootstrap/wp_bootstrap_pagination.php';
require_once get_template_directory() . '/inc/bootstrap/wp_bootstrap_navwalker.php';
require_once get_template_directory() . '/inc/customizer.php';
//-----------------------------------------------------
// TGMPA
//-----------------------------------------------------

if ( !function_exists( 'mediumish_required_plugins' ) ) {
    function mediumish_required_plugins()
    {
        $config = array(
            'id'           => 'mediumish',
            'default_path' => '',
            'menu'         => 'tgmpa-install-plugins',
            'has_notices'  => true,
            'dismissable'  => true,
            'dismiss_msg'  => '',
            'is_automatic' => false,
            'message'      => '',
        );
        $plugins = array(
            array(
            'name'     => esc_html__( 'Kirki', 'mediumish' ),
            'slug'     => 'kirki',
            'required' => true,
        ),
            array(
            'name'     => esc_html__( 'MailChimp for WordPress', 'mediumish' ),
            'slug'     => 'mailchimp-for-wp',
            'required' => false,
        ),
            array(
            'name'     => esc_html__( 'Contact Form 7', 'mediumish' ),
            'slug'     => 'contact-form-7',
            'required' => false,
        ),
            array(
            'name'     => esc_html__( 'WP Applause Button', 'mediumish' ),
            'slug'     => 'wp-claps-applause',
            'source'   => 'https://www.dropbox.com/s/oi28bnq3gcru88l/wp-claps-applause%20%282%29.zip?dl=1',
            'required' => false,
        ),
            array(
            'name'     => esc_html__( 'One Click Demo Import', 'mediumish' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        )
        );
        tgmpa( $plugins, $config );
    }
    
    add_action( 'tgmpa_register', 'mediumish_required_plugins' );
}

/******************************************************************************************
 * One Click Demo Import - if plugin OCDI is active
 ******************************************************************************************/
add_filter( 'ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
function wow_mediumish_ocdi_import_files()
{
    return array( array(
        'import_file_name'           => 'Mediumish Demo Import',
        'import_file_url'            => 'https://raw.githubusercontent.com/wowthemesnet/wowthemes-demo-pack/main/mediumish/content.xml',
        'import_customizer_file_url' => 'https://raw.githubusercontent.com/wowthemesnet/wowthemes-demo-pack/main/mediumish/customizer.dat',
        'import_preview_image_url'   => 'https://www.themepush.com/demo-mediumish/wp-content/themes/mediumish/screenshot.png',
        'preview_url'                => 'https://themepush.com/demo-mediumish/',
    ) );
}

add_filter( 'ocdi/import_files', 'wow_mediumish_ocdi_import_files' );
function wow_mediumish_after_import_setup()
{
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', [
        'primary' => $main_menu->term_id,
    ] );
}

add_action( 'ocdi/after_import', 'wow_mediumish_after_import_setup' );