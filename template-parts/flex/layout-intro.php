
<?php
/**
 * Partial: Intro (Hero)
 * ACF Fields: kicker, title, text,
 * background_image, cta
 */

$kicker = get_sub_field('kicker');
$title  = get_sub_field('title');
$body   = get_sub_field('text');
$img_id = get_sub_field('background_image');
$cta    = get_sub_field('cta');

// Heading tag
$heading_tag = apply_filters(
    'theme_intro_heading_tag',
    'h1'
);

// CTA settings
$cta_url = is_array($cta) && !empty($cta['url'])
    ? $cta['url']
    : '';

$cta_title = is_array($cta) && !empty($cta['title'])
    ? $cta['title']
    : '';

$cta_target = is_array($cta) && !empty($cta['target'])
    ? $cta['target']
    : '_self';

$cta_rel = $cta_target === '_blank'
    ? 'noopener noreferrer'
    : '';

// Remove the arrow from the homepage CTA only.
if (is_front_page() && $cta_title) {
    $cta_title = preg_replace(
        '/\s*[↗→]\s*$/u',
        '',
        $cta_title
    );
}

?>

<div class="row align-items-center g-5">

  <div class="col-12 <?php echo $img_id ? 'col-lg-7' : 'col-lg-10'; ?>">

    <!-- KICKER -->

    <?php if ($kicker) : ?>

      <p class="intro-kicker text-uppercase small mb-2">
        <?php echo esc_html($kicker); ?>
      </p>

    <?php endif; ?>


    <!-- TITLE -->

    <?php if ($title) : ?>

      <<?php echo tag_escape($heading_tag); ?>
        class="intro-title mb-3"
      >
        <?php echo esc_html($title); ?>
      </<?php echo tag_escape($heading_tag); ?>>

    <?php endif; ?>


    <!-- DESCRIPTION -->

    <?php if ($body) : ?>

      <div class="intro-text rte mb-3">
        <?php echo wp_kses_post($body); ?>
      </div>

    <?php endif; ?>


    <!-- CTA BUTTON -->

    <?php if ($cta_url) : ?>

      <a
        class="btn btn-primary intro-cta"
        href="<?php echo esc_url($cta_url); ?>"
        target="<?php echo esc_attr($cta_target); ?>"
        rel="<?php echo esc_attr($cta_rel); ?>"
      >
        <?php
        echo esc_html(
            $cta_title ?: __('Mehr', 'projecttheme')
        );
        ?>
      </a>

    <?php endif; ?>

  </div>


  <!-- BACKGROUND IMAGE -->

  <?php if ($img_id) : ?>

    <div class="col-12 col-lg-5">

      <?php

      if (function_exists('theme_img')) {

          echo theme_img(
              $img_id,
              'large',
              [
                  'class' => 'intro-image img-fluid rounded-3',
                  'loading' => 'lazy',
                  'decoding' => 'async',
              ]
          );

      } else {

          echo wp_get_attachment_image(
              $img_id,
              'large',
              false,
              [
                  'class' => 'intro-image img-fluid rounded-3',
                  'loading' => 'lazy',
                  'decoding' => 'async',
              ]
          );

      }

      ?>

    </div>

  <?php endif; ?>

</div>
