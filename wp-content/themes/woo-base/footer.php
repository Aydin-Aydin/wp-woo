
<<<<<<< HEAD
        <div class="footer-copy">
          <p>
          <a href="<?php echo site_url(); ?>">
            <?php bloginfo( 'name' ); ?>
          </a>
          <span>&copy; <?php echo date("Y");?></span>
          <span> All Rights Reserved!</span>
          </p>
        </div><!-- .footer-copy -->
      </footer>
=======
  <div id="footer-sidebar" class="secondary">
    &copy; 2015 – <?php echo date('Y'); ?> Lace Up All rights reserved!
    <div id="footer-sidebar1">
      <?php
      if(is_active_sidebar('footer-sidebar-1')){
        dynamic_sidebar('footer-sidebar-1');
      }
      ?>
>>>>>>> 71511c4e17f3df54582e3799817cd4a391d3b427
    </div>
    <div id="footer-sidebar2">
      <?php
        if(is_active_sidebar('footer-sidebar-2')){
          dynamic_sidebar('footer-sidebar-2');
        }
      ?>
    </div>
    <div id="footer-sidebar3">
      <?php
        if(is_active_sidebar('footer-sidebar-3')){
          dynamic_sidebar('footer-sidebar-3');
        }
      ?>
    </div>
  </div>
    <?php wp_footer(); ?>
  </body>
</html>
