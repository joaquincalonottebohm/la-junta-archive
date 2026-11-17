
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

  <!-- ======================================
       LA JUNTA ARCHIVE — HEADER
  ====================================== -->

  <header id="masthead" class="site-header">

    <!-- LOGO -->

    <div class="site-branding">
      <?php
      get_template_part('template-parts/components/logo');
      ?>
    </div>

    <!-- NAVIGATION -->

    <div class="header-actions">

      <nav
        id="site-navigation"
        class="main-navigation"
        aria-label="Main navigation"
      >

        <!-- MOBILE MENU BUTTON -->

        <button
          class="menu-toggle"
          type="button"
          aria-controls="menu-main"
          aria-expanded="false"
          aria-label="Toggle navigation menu"
        >

          <span class="menu-toggle-label">
            Menu
          </span>

          <span class="menu-toggle-icon" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
          </span>

        </button>

        <!-- WORDPRESS NAVIGATION MENU -->

        <?php
        wp_nav_menu(
          array(
            'theme_location'  => 'menu-main',
            'menu_id'         => 'menu-main',
            'menu_class'      => 'main-menu',
            'container'       => 'div',
            'container_class' => 'main-menu-container',
            'fallback_cb'     => false,
          )
        );
        ?>

      </nav><!-- #site-navigation -->

    </div><!-- .header-actions -->

  </header><!-- #masthead -->


  <!-- ======================================
       MAIN SITE CONTENT
  ====================================== -->

  <div id="content" class="site-content">
