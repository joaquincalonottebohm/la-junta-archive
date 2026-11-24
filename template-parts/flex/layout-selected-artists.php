
<?php
/**
 * LA Junta Archive — Selected Artists
 * Custom ACF component
 */

// Collect artists from the ACF repeater.
$artists = [];

if (have_rows('artists')) {
    while (have_rows('artists')) {
        the_row();

        $artists[] = [
            'artist_name'     => get_sub_field('artist_name'),
            'artwork_title'   => get_sub_field('artwork_title'),
            'artwork_image'   => get_sub_field('artwork_image'),
            'artwork_caption' => get_sub_field('artwork_caption'),
            'artist_link'     => get_sub_field('artist_link'),
        ];
    }
}

// Count artists accurately.
$artist_count = count($artists);
?>

<?php if ($artist_count > 0) : ?>

<div class="selected-artists">

    <!-- ======================================
         ACCESSIBLE SECTION HEADING
    ====================================== -->

    <h2 class="visually-hidden">Selected artists</h2>

    <!-- ======================================
         SECTION HEADER
    ====================================== -->

    <div class="selected-artists__header">

        <div class="selected-artists__meta">

            <p>
                LA JUNTA_ARCHIVE ©
                <?php echo esc_html(wp_date('Y')); ?>
            </p>

            <p>
                SELECTED ARTISTS / 001—<?php
                echo esc_html(
                    sprintf('%03d', $artist_count)
                );
                ?>
            </p>

        </div>

        <!-- EDITORIAL LINKS -->

        <div class="selected-artists__links">

            <!-- VIEW ALL ARTISTS -->

            <a
                class="selected-artists__link selected-artists__link--view"
                href="<?php echo esc_url(home_url('/discover-artists/')); ?>"
            >
                <span class="selected-artists__link-label">
                    VIEW ALL ARTISTS
                </span>

                <span
                    class="selected-artists__link-arrow"
                    aria-hidden="true"
                >
                    <svg
                        viewBox="0 0 24 24"
                        width="20"
                        height="20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M7 17L17 7M7 7H17V17"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>
            </a>

            <!-- SCROLL TO EXPLORE -->

            <a
                href="#selected-artists-works"
                class="selected-artists__link selected-artists__link--scroll"
            >
                <span class="selected-artists__link-label">
                    SCROLL TO EXPLORE
                </span>

                <span
                    class="selected-artists__link-arrow"
                    aria-hidden="true"
                >
                    <svg
                        viewBox="0 0 24 24"
                        width="20"
                        height="20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M12 5V19M5 12L12 19L19 12"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>
            </a>

        </div><!-- .selected-artists__links -->

    </div><!-- .selected-artists__header -->

    <!-- ======================================
         SELECTED ARTISTS
    ====================================== -->

    <?php foreach ($artists as $index => $artist) : ?>

        <?php
        $number = $index + 1;

        $artist_name   = $artist['artist_name'];
        $artwork_title = $artist['artwork_title'];
        $image_id      = $artist['artwork_image'];
        $caption       = $artist['artwork_caption'];
        $link          = $artist['artist_link'];

        // Support ACF Link arrays and URL fields.
        $link_url = '';
        $link_target = '_self';

        if (is_array($link)) {
            $link_url = $link['url'] ?? '';

            $link_target = !empty($link['target'])
                ? $link['target']
                : '_self';

        } elseif (is_string($link)) {
            $link_url = $link;
        }

        // Support ACF Image IDs and arrays.
        if (is_array($image_id)) {
            $image_id = $image_id['ID']
                ?? $image_id['id']
                ?? 0;
        }

        $image_id = (int) $image_id;
        ?>

        <!-- ======================================
             ARTIST CARD

             First artist receives the scroll
             destination ID.
        ====================================== -->

        <article
            class="selected-artist"
            <?php if ($index === 0) : ?>
                id="selected-artists-works"
            <?php endif; ?>
        >

            <!-- ARTIST NAME -->

            <h2 class="selected-artist__name">

                <?php
                echo esc_html(
                    sprintf('%02d', $number)
                );
                ?>

                —

                <?php echo esc_html($artist_name); ?>

            </h2>

            <!-- ARTWORK IMAGE -->

            <?php if ($image_id) : ?>

                <?php if ($link_url) : ?>

                    <a
                        href="<?php echo esc_url($link_url); ?>"
                        target="<?php echo esc_attr($link_target); ?>"
                        <?php if ($link_target === '_blank') : ?>
                            rel="noopener noreferrer"
                        <?php endif; ?>
                    >

                <?php endif; ?>

                <?php
                echo wp_get_attachment_image(
                    $image_id,
                    'large',
                    false,
                    [
                        'class'   => 'selected-artist__image',
                        'loading' => 'lazy',
                    ]
                );
                ?>

                <?php if ($link_url) : ?>
                    </a>
                <?php endif; ?>

            <?php endif; ?>

            <!-- ARTWORK TITLE -->

            <?php if ($artwork_title) : ?>

                <p class="selected-artist__title">
                    <?php echo esc_html($artwork_title); ?>
                </p>

            <?php endif; ?>

            <!-- ARTWORK CAPTION -->

            <?php if ($caption) : ?>

                <p class="selected-artist__caption">
                    <?php echo esc_html($caption); ?>
                </p>

            <?php endif; ?>

        </article>

    <?php endforeach; ?>

</div><!-- .selected-artists -->

<?php endif; ?>
