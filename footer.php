
  </div><!-- #content -->

  <?php
  /**
   * LA Junta Archive — Custom Footer
   */

  $footer_logo_url = get_theme_file_uri(
    'assets/images/la-junta-footer-logo.svg'
  );
  ?>

  <footer id="colophon" class="la-footer">

    <div class="la-footer__container">

      <!-- BRAND -->

      <div class="la-footer__brand">

        <a
          class="la-footer__logo"
          href="<?php echo esc_url(home_url('/')); ?>"
          aria-label="LA Junta Archive — Home"
        >
          <img
            src="<?php echo esc_url($footer_logo_url); ?>"
            alt="LA Junta_Archive"
            width="185"
            height="auto"
          >
        </a>

        <!-- SOCIAL ICONS -->

        <div class="la-footer__socials">

          <!-- X -->

          <span title="X">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M18.9 2H22l-7.3 8.4L23.3 22h-6.7l-5.2-7.2L5.1 22H2l7.8-9L1.5 2h6.9l4.7 6.6L18.9 2Zm-1.1 18h1.7L7.4 3.9H5.6L17.8 20Z"/>
            </svg>
          </span>

          <!-- INSTAGRAM -->

          <span title="Instagram">
            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.8"
              aria-hidden="true"
            >
              <rect
                x="2.5"
                y="2.5"
                width="19"
                height="19"
                rx="5"
              />
              <circle cx="12" cy="12" r="4"/>
              <circle
                cx="17.7"
                cy="6.3"
                r="1"
                fill="currentColor"
                stroke="none"
              />
            </svg>
          </span>

          <!-- YOUTUBE -->

          <span title="YouTube">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect
                x="2"
                y="5"
                width="20"
                height="14"
                rx="4"
              />
              <path
                d="M10 8.5L16 12L10 15.5Z"
                fill="#FFFFFF"
              />
            </svg>
          </span>

        </div>

      </div>

      <!-- EXPLORE -->

      <nav
        class="la-footer__column"
        aria-label="Explore"
      >

        <h2>Explore</h2>

        <a href="<?php echo esc_url(home_url('/discover-artists/')); ?>">
          Discover Artists
        </a>

        <a href="<?php echo esc_url(home_url('/about-the-archive/')); ?>">
          About
        </a>

      </nav>

      <!-- CONNECT -->

      <nav
        class="la-footer__column"
        aria-label="Connect"
      >

        <h2>Connect</h2>

        <a href="<?php echo esc_url(home_url('/contact/')); ?>">
          Contact
        </a>

        <span>Suggest an Artist</span>

      </nav>

    </div>

  </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
