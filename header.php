
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

  <header id="masthead" class="site-header">

    <!-- LOGO -->
    <div class="site-branding">
      <?php
      get_template_part('template-parts/components/logo');
      ?>
    </div>

    <!-- NAVIGATION + LANGUAGE -->
    <div class="header-actions">

      <nav
        id="site-navigation"
        class="main-navigation"
        aria-label="Main navigation"
      >

        <button
          class="menu-toggle"
          type="button"
          aria-controls="menu-main"
          aria-expanded="false"
        >
          <span class="menu-toggle-label">Menu</span>

          <span class="menu-toggle-icon" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </button>

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

      </nav>

      <!-- LANGUAGE DISPLAY -->
      <div
        class="header-language"
        aria-label="Language: English. Spanish version coming soon."
      >
        <span class="header-language__active">EN</span>
        <span class="header-language__separator" aria-hidden="true">/</span>
        <span class="header-language__inactive">ES</span>
      </div>

    </div>

  </header>

  <div id="content" class="site-content">
