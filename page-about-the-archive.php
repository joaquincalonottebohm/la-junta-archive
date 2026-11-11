
<?php
/**
 * LA Junta Archive — About the Archive
 * Custom WordPress Page Template
 */

get_header();

// Artist suggestion email
$suggest_email = 'mailto:jcalonottebohm@gmail.com?subject='
    . rawurlencode('Artist Suggestion - LA Junta Archive');
?>

<main id="primary" class="about-archive">

  <div class="about-archive__container">


    <!-- ======================================
         PAGE INTRODUCTION
    ====================================== -->

    <header class="about-archive__intro">

      <h1>About the Archive</h1>

      <p>
        A new perspective on Latin American contemporary art.
      </p>

    </header>


    <!-- ======================================
         MISSION & CURATORIAL APPROACH
    ====================================== -->

    <div class="about-archive__information">


      <!-- 01 / OUR MISSION -->

      <section class="about-archive__section">

        <p class="about-archive__number">
          01 / OUR MISSION
        </p>

        <h2>
          Connecting artists and audiences.
        </h2>

        <p class="about-archive__description">
          LA Junta_Archive is an independent digital platform
          dedicated to showcasing emerging Latin American
          artists and their creative practices. It creates
          a space for discovery, dialogue, and cultural exchange.
        </p>

      </section>


      <!-- 02 / CURATORIAL APPROACH -->

      <section class="about-archive__section">

        <p class="about-archive__number">
          02 / CURATORIAL APPROACH
        </p>

        <h2>
          Beyond geographical boundaries.
        </h2>

        <p class="about-archive__description">
          Through a curated selection of artists, artworks,
          and stories, the archive explores diverse
          perspectives, materials, identities, and artistic
          expressions across Latin America.
        </p>

      </section>


    </div><!-- .about-archive__information -->


    <!-- ======================================
         03 / CONTRIBUTE
    ====================================== -->

    <section class="about-archive__contribute">

      <p class="about-archive__number">
        03 / CONTRIBUTE
      </p>

      <h2>
        Suggest an Artist
      </h2>

      <p class="about-archive__description">
        Know an emerging Latin American artist whose work
        deserves to be discovered? We'd love to hear from you.
      </p>


      <!-- SUGGEST AN ARTIST BUTTON -->

      <a
        href="<?php echo esc_url($suggest_email); ?>"
        class="about-archive__button"
        aria-label="Suggest an artist by email"
      >
        SUGGEST AN ARTIST ↗
      </a>

    </section>


  </div><!-- .about-archive__container -->

</main>

<?php get_footer(); ?>
