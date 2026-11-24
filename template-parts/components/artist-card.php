
<?php
/**
 * LA Junta Archive — Artist Card
 * Reusable component for Discover Artists
 */

$artist_id = get_the_ID();

if (!$artist_id || get_post_type($artist_id) !== 'artist') {
    return;
}

// Get artist information from ACF
$artist_name = get_the_title($artist_id);
$country = get_field('country', $artist_id);
$portrait = get_field('artist_portrait', $artist_id);
$artist_link = get_permalink($artist_id);

// Image ID from ACF
$portrait_id = is_array($portrait)
    ? ($portrait['ID'] ?? 0)
    : (int) $portrait;
?>

<article class="artist-card">

  <a
    href="<?php echo esc_url($artist_link); ?>"
    class="artist-card__link"
  >

    <!-- ARTIST PORTRAIT -->

    <div class="artist-card__image-wrapper">

      <?php
      if ($portrait_id) {
          echo wp_get_attachment_image(
              $portrait_id,
              'large',
              false,
              [
                  'class' => 'artist-card__image',
                  'loading' => 'lazy',
              ]
          );
      }
      ?>

    </div>

    <!-- ARTIST INFORMATION -->

    <div class="artist-card__caption">

      <h2
        class="artist-card__name"
        style="display: inline; margin: 0; padding: 0; font: inherit;"
      >
        <?php echo esc_html($artist_name); ?>
      </h2>

      <?php if ($country) : ?>

        <span class="artist-card__separator">
          |
        </span>

        <span class="artist-card__country">
          <?php echo esc_html($country); ?>
        </span>

      <?php endif; ?>

    </div>

  </a>

</article>
