    <footer>
      <?php wp_footer(); ?>
      <div class="footer-nav-wrap">
        <?php if ( has_nav_menu( 'footer' ) ) : ?>
          <nav class="footer-nav" role="navigation">
            <?php
            wp_nav_menu( array(
              'theme_location' => 'footer',
              'menu_class'     => 'footer-links-menu'
              ) );
              ?>
            </nav><!-- .footer-nav -->
          <?php endif; ?>
        </div><!-- .footer-nav-wrap -->

        <div class="footer-copy">
          <p>&copy; <?php echo date("Y");?>
          <a href="<?php echo site_url(); ?>">
            <?php bloginfo( 'name' ); ?>.
          </a>
          <span>All Rights Reserved</span>
          </p>
        </div><!-- .footer-copy -->
      </footer>
    </div>
  </body>
  </html>
