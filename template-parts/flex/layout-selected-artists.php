
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
            'artist_name'    => get_sub_field('artist_name'),
            'artwork_title'  => get_sub_field('artwork_title'),
            'artwork_image'  => get_sub_field('artwork_image'),
            'artwork_caption'=> get_sub_field('artwork_caption'),
            'artist_link'    => get_sub_field('artist_link'),
        ];
    }
}

// Count artists accurately.
$artist_count = count($artists);
?>

<?php if ($artist_count > 0) : ?>

<div class="selected-artists">

    <!-- SECTION HEADER -->

    <div class="selected-artists__header">

        <div class="selected-artists__meta">

            <p>
                LA JUNTA_ARCHIVE ©
                <?php echo esc_html(wp_date('Y')); ?>
            </p>

            <p>
                SELECTED ARTISTS / 001—<?php
                echo esc_html(sprintf('%03d', $artist_count));
                ?>
            </p>

        </div>

        <div class="selected-artists__links">

            <a href="<?php echo esc_url(home_url('/discover-artists/')); ?>">
                VIEW ALL ARTISTS ↗
            </a>

            <span>SCROLL TO EXPLORE ↓</span>

        </div>

    </div>

    <!-- ARTISTS -->

    <?php foreach ($artists as $index => $artist) : ?>

        <?php
        $number = $index + 1;

        $artist_name = $artist['artist_name'];
        $artwork_title = $artist['artwork_title'];
        $image_id = $artist['artwork_image'];
        $caption = $artist['artwork_caption'];
        $link = $artist['artist_link'];

        // Support ACF Link arrays and URL text fields.
        $link_url = '';
        $link_target = '_self';

        if (is_array($link)) {
            $link_url = $link['url'] ?? '';
            $link_target = $link['target'] ?: '_self';
        } elseif (is_string($link)) {
            $link_url = $link;
        }

        // Support ACF Image ID and Image Array.
        if (is_array($image_id)) {
            $image_id = $image_id['ID'] ?? $image_id['id'] ?? 0;
        }
        ?>

        <article class="selected-artist">

            <!-- ARTIST NAME -->

            <p class="selected-artist__name">

                <?php echo esc_html(sprintf('%02d', $number)); ?>
                —
                <?php echo esc_html($artist_name); ?>

            </p>

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
                        'class' => 'selected-artist__image',
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

</div>

<?php endif; ?>
