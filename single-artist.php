
<?php
/**
 * LA Junta Archive — Individual Artist Profile
 * Custom WordPress Template
 */

get_header();

while (have_posts()) :
    the_post();

    $artist_id = get_the_ID();

    // ACF FIELDS

    $country = get_field('country', $artist_id);
    $discipline = get_field('discipline', $artist_id);
    $portrait = get_field('artist_portrait', $artist_id);
    $biography = get_field('artist_biography', $artist_id);


    // ======================================
    // EXTERNAL ARTIST LINKS
    // ======================================

    $artist_links = [
        'tanya-aguiniga' =>
            'https://www.tanyaaguiniga.com/',

        'louis-carlos-bernal' =>
            'https://ccp.arizona.edu/louis-carlos-bernal/about-louis-carlos-bernal/',

        'firelei-baez' =>
            'https://www.hauserwirth.com/artists/firelei-baez/',
    ];

    $artist_slug = get_post_field('post_name', $artist_id);

    $artist_link = $artist_links[$artist_slug] ?? '';


    // ======================================
    // ARTIST PORTRAIT
    // ======================================

    // Support common ACF image return formats.

    $portrait_id = is_array($portrait)
        ? (int) ($portrait['ID'] ?? ($portrait['id'] ?? 0))
        : (is_numeric($portrait) ? (int) $portrait : 0);

?>

<main id="primary" class="artist-profile">

  <div class="artist-profile__container">


    <!-- ======================================
         ARTIST HEADER
    ====================================== -->

    <header class="artist-profile__header">

      <h1>
        <?php the_title(); ?>
      </h1>

      <p class="artist-profile__meta">

        <?php echo esc_html($country); ?>

        <?php if ($country && $discipline) : ?>
          <span aria-hidden="true"> · </span>
        <?php endif; ?>

        <?php echo esc_html($discipline); ?>

      </p>

    </header>


    <!-- ======================================
         MAIN CONTENT
    ====================================== -->

    <div class="artist-profile__content">


      <!-- ARTIST PORTRAIT -->

      <div class="artist-profile__portrait">

        <?php

        if ($portrait_id) {

            echo wp_get_attachment_image(
                $portrait_id,
                'large',
                false,
                [
                    'class' => 'artist-profile__image',
                    'loading' => 'eager',
                ]
            );

        } elseif (
            is_array($portrait) &&
            !empty($portrait['url'])
        ) {

            echo '<img
                class="artist-profile__image"
                src="' . esc_url($portrait['url']) . '"
                alt="' . esc_attr(get_the_title()) . '"
            >';

        } elseif (
            is_string($portrait) &&
            filter_var($portrait, FILTER_VALIDATE_URL)
        ) {

            echo '<img
                class="artist-profile__image"
                src="' . esc_url($portrait) . '"
                alt="' . esc_attr(get_the_title()) . '"
            >';

        }

        ?>

      </div><!-- .artist-profile__portrait -->


      <!-- ======================================
           ARTIST BIOGRAPHY
      ====================================== -->

      <div class="artist-profile__about">

        <h2>About the artist</h2>

        <div class="artist-profile__biography">

          <?php echo wp_kses_post($biography); ?>

        </div><!-- .artist-profile__biography -->


        <!-- ======================================
             CONTACT THE ARTIST
        ====================================== -->

        <?php if ($artist_link) : ?>

          <a
            href="<?php echo esc_url($artist_link); ?>"
            class="artist-profile__contact"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="<?php echo esc_attr(
                'Visit the website for ' . get_the_title()
            ); ?>"
          >
            Contact the artist
          </a>

        <?php endif; ?>


      </div><!-- .artist-profile__about -->


    </div><!-- .artist-profile__content -->


    <!-- ======================================
         SELECTED WORKS
    ====================================== -->

    <?php
    get_template_part(
        'template-parts/components/selected-works'
    );
    ?>


  </div><!-- .artist-profile__container -->

</main>

<?php
endwhile;

get_footer();
?>
