</div><!-- /.site-content -->
        
        <div class="container">
            <footer class="footer d-block d-md-flex text-center text-md-left justify-content-between align-items-center"> 
                <p> <?php echo wp_kses_data(get_theme_mod( 'footer_textleft', '&copy; Website Name. All rights reserved.')); ?> </p> 
                <p> <?php echo wp_kses_data(get_theme_mod( 'footer_textright', 'Mediumish Theme by WowThemesNet.')); ?> </p> 
               
                <a href="" class="back-to-top hidden-md-down"> 
                <i class="fa fa-angle-up"></i>
                </a>
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>     
</html>
