
<?php
/**
 * LA Junta Archive — Selected Works
 * Reusable ACF Component
 */

if (
    !function_exists('have_rows') ||
    !have_rows('selected_works')
) {
    return;
}

// Firelei's artworks should be fully visible.
$is_firelei = get_post_field('post_name', get_the_ID()) === 'firelei-baez';

$section_class = 'artist-works';

if ($is_firelei) {
    $section_class .= ' artist-works--contain';
}
?>

<section
  class="<?php echo esc_attr($section_class); ?>"
  aria-labelledby="selected-works-title"
>

  <h2
    id="selected-works-title"
    class="artist-works__heading"
  >
    Selected Works
  </h2>

  <div class="artist-works__grid">

    <?php while (have_rows('selected_works')) : the_row();

      // ARTWORK IMAGE
      $image = get_sub_field('work_image')
        ?: get_sub_field('artwork_image')
        ?: get_sub_field('image');

      // ARTWORK TITLE
      $title = get_sub_field('work_title')
        ?: get_sub_field('artwork_title')
        ?: get_sub_field('title');

      // YEAR
      $year = get_sub_field('work_year')
        ?: get_sub_field('artwork_year')
        ?: get_sub_field('year');

      // MEDIUM / TECHNIQUE
      $medium = get_sub_field('work_medium')
        ?: get_sub_field('artwork_medium')
        ?: get_sub_field('medium')
        ?: get_sub_field('work_technique')
        ?: get_sub_field('artwork_technique')
        ?: get_sub_field('technique');

      // IMAGE FORMAT
      $image_id = is_array($image)
        ? (int) ($image['ID'] ?? $image['id'] ?? 0)
        : (is_numeric($image) ? (int) $image : 0);

      $image_url = is_array($image)
        ? ($image['url'] ?? '')
        : (
            is_string($image) && !is_numeric($image)
              ? $image
              : ''
          );

      // YEAR + MEDIUM
      $details = implode(' · ', array_filter([
        $year,
        $medium
      ]));
    ?>

      <figure class="artist-work">

        <!-- ARTWORK IMAGE -->

        <div class="artist-work__media">

          <?php if ($image_id) : ?>

            <?php echo wp_get_attachment_image(
                $image_id,
                'large',
                false,
                [
                  'class' => 'artist-work__image',
                  'loading' => 'lazy'
                ]
            ); ?>

          <?php elseif ($image_url) : ?>

            <img
              class="artist-work__image"
              src="<?php echo esc_url($image_url); ?>"
              alt="<?php echo esc_attr($title ?: 'Artwork'); ?>"
              loading="lazy"
            >

          <?php endif; ?>

        </div>

        <!-- ARTWORK INFORMATION -->

        <figcaption class="artist-work__caption">

          <?php if ($title) : ?>

            <h3 class="artist-work__title">
              <?php echo esc_html($title); ?>
            </h3>

          <?php endif; ?>

          <?php if ($details) : ?>

            <p class="artist-work__details">
              <?php echo esc_html($details); ?>
            </p>

          <?php endif; ?>

        </figcaption>

      </figure>

    <?php endwhile; ?>

  </div>

</section>
