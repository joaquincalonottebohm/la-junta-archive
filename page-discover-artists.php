<?php
/**
 * LA Junta Archive — Discover Artists
 * Artist directory with dynamic filters
 */

$artists_query = new WP_Query([
    'post_type'      => 'artist',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'ASC',
]);

// Collect available countries and disciplines from ACF
$countries = [];
$disciplines = [];

foreach ($artists_query->posts as $artist) {

    $country = get_field('country', $artist->ID);
    $discipline = get_field('discipline', $artist->ID);

    if (is_string($country) && trim($country) !== '') {
        $countries[] = trim($country);
    }

    if (is_string($discipline) && trim($discipline) !== '') {
        $disciplines[] = trim($discipline);
    }
}

$countries = array_values(array_unique($countries));
$disciplines = array_values(array_unique($disciplines));

natcasesort($countries);
natcasesort($disciplines);

get_header();
?>

<main id="primary" class="discover-artists-page">

  <div class="discover-artists-page__container">

    <!-- PAGE HEADER -->

    <div class="discover-artists-page__header">

      <div class="discover-artists-page__intro">

        <h1>Discover Artists</h1>

        <p>
          Explore emerging artistic voices from Latin America.
        </p>

      </div>

      <!-- SEARCH AND FILTERS -->

      <div class="discover-artists-page__controls">

        <!-- SEARCH -->

        <div class="artist-search">

          <label class="screen-reader-text" for="artist-search">
            Search artists
          </label>

          <input
            type="search"
            id="artist-search"
            placeholder="Search"
            autocomplete="off"
          >

          <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            aria-hidden="true"
          >
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m16 16 5 5"></path>
          </svg>

        </div>

        <!-- COUNTRY FILTER -->

        <label class="screen-reader-text" for="artist-country">
          Filter by country
        </label>

        <select
          id="artist-country"
          class="artist-filter artist-filter--country"
        >

          <option value="">Country</option>

          <?php foreach ($countries as $country) : ?>

            <option value="<?php echo esc_attr($country); ?>">
              <?php echo esc_html($country); ?>
            </option>

          <?php endforeach; ?>

        </select>

        <!-- DISCIPLINE FILTER -->

        <label class="screen-reader-text" for="artist-discipline">
          Filter by discipline
        </label>

        <select
          id="artist-discipline"
          class="artist-filter artist-filter--discipline"
        >

          <option value="">Discipline</option>

          <?php foreach ($disciplines as $discipline) : ?>

            <option value="<?php echo esc_attr($discipline); ?>">
              <?php echo esc_html($discipline); ?>
            </option>

          <?php endforeach; ?>

        </select>

        <button
          type="button"
          id="artist-clear-filters"
          class="artist-clear-filters"
          hidden
        >
          Clear filters
        </button>

      </div>

    </div>

    <!-- ARTISTS GRID -->

    <div class="discover-artists-page__grid">

      <?php if ($artists_query->have_posts()) : ?>

        <?php while ($artists_query->have_posts()) :
            $artists_query->the_post();

            $artist_id = get_the_ID();
            $country = get_field('country', $artist_id);
            $discipline = get_field('discipline', $artist_id);
        ?>

          <div
            class="discover-artists-page__grid-item"
            data-artist-name="<?php echo esc_attr(get_the_title()); ?>"
            data-country="<?php echo esc_attr((string) $country); ?>"
            data-discipline="<?php echo esc_attr((string) $discipline); ?>"
          >

            <?php
            get_template_part(
                'template-parts/components/artist-card'
            );
            ?>

          </div>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

      <?php else : ?>

        <p>No artists available yet.</p>

      <?php endif; ?>

    </div>

    <!-- FILTER FEEDBACK -->

    <p
      id="artist-filter-status"
      class="discover-artists-page__status"
      role="status"
      aria-live="polite"
    ></p>

    <p
      id="artist-no-results"
      class="discover-artists-page__empty"
      hidden
    >
      No artists match your search.
    </p>

  </div>

</main>

<?php get_footer(); ?>