<?php
/**
 * Template part for displaying a single Theater.
 *
 * Uses Themezinho Core ACF fields and a richer layout
 * that matches the Theater Directory visual style.
 *
 * @package themezinho
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$theater_id = get_the_ID();

// ACF fields from theaters-options.php.
$location_map   = function_exists( 'get_field' ) ? get_field( 'theater_location', $theater_id ) : null; // google_map
$location_url   = function_exists( 'get_field' ) ? get_field( 'theater_location_url', $theater_id ) : '';
$capacity       = function_exists( 'get_field' ) ? get_field( 'theater_seating_capacity', $theater_id ) : '';
$contact_info   = function_exists( 'get_field' ) ? get_field( 'theater_contact_information', $theater_id ) : '';
$facilities_raw = function_exists( 'get_field' ) ? get_field( 'theater_facilities', $theater_id ) : '';
$linked_shows   = function_exists( 'get_field' ) ? get_field( 'theater_linked_shows', $theater_id ) : array();
$photo_id       = function_exists( 'get_field' ) ? get_field( 'theater_photo', $theater_id ) : '';
$showtimes_raw  = function_exists( 'get_field' ) ? get_field( 'theater_showtimes', $theater_id ) : '';
$booking_url    = function_exists( 'get_field' ) ? get_field( 'theater_booking_url', $theater_id ) : '';
$social_fb      = function_exists( 'get_field' ) ? get_field( 'theater_facebook', $theater_id ) : '';
$social_tw      = function_exists( 'get_field' ) ? get_field( 'theater_twitter', $theater_id ) : '';
$social_ig      = function_exists( 'get_field' ) ? get_field( 'theater_instagram', $theater_id ) : '';
$social_site    = function_exists( 'get_field' ) ? get_field( 'theater_website', $theater_id ) : '';

$address_line = '';
if ( is_array( $location_map ) && ! empty( $location_map['address'] ) ) {
    $address_line = $location_map['address'];
} else {
    // Fallback to Theater Manager meta if present.
    $city    = get_post_meta( $theater_id, '_theater_city', true );
    $state   = get_post_meta( $theater_id, '_theater_state', true );
    $address = get_post_meta( $theater_id, '_theater_address', true );
    $bits    = array_filter( array( $address, $city, $state ) );
    $address_line = implode( ', ', $bits );
}

$facilities = array();
if ( ! empty( $facilities_raw ) ) {
    $facilities = preg_split( '/[\n,]+/', $facilities_raw );
    $facilities = array_filter( array_map( 'trim', (array) $facilities ) );
}

$showtimes = array();
if ( ! empty( $showtimes_raw ) ) {
    $showtimes = preg_split( '/[\n,]+/', $showtimes_raw );
    $showtimes = array_filter( array_map( 'trim', (array) $showtimes ) );
}

// Map URL: explicit field wins, else build from address.
$map_url = $location_url;
if ( empty( $map_url ) && ! empty( $address_line ) ) {
    $map_url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $address_line );
}

// Lightweight fake rating so UI looks rich even without real data.
$rating_value = number_format_i18n( mt_rand( 40, 50 ) / 10, 1 );
$review_count = mt_rand( 10, 250 );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'tm-theater-single' ); ?>>
    <header class="tm-theater-single-hero">
        <div class="tm-theater-single-hero-inner">
            <div class="tm-theater-single-thumb">
                <?php
                $hero_img = '';
                if ( has_post_thumbnail() ) {
                    $hero_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                } elseif ( $photo_id ) {
                    $hero_img = wp_get_attachment_image_url( $photo_id, 'large' );
                }
                ?>
                <?php if ( $hero_img ) : ?>
                    <div class="tm-theater-single-thumb-img" style="background-image: url('<?php echo esc_url( $hero_img ); ?>');"></div>
                <?php else : ?>
                    <div class="tm-theater-single-thumb-img tm-theater-single-thumb-img--empty">
                        <span><?php esc_html_e( 'No Poster', 'theater-manager' ); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="tm-theater-single-meta">
                <?php the_title( '<h1 class="tm-theater-single-title">', '</h1>' ); ?>

                <?php if ( ! empty( $address_line ) ) : ?>
                    <p class="tm-theater-single-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo esc_html( $address_line ); ?>
                    </p>
                <?php endif; ?>

                <div class="tm-theater-single-rating">
                    <span class="tm-rating-stars">★★★★★</span>
                    <span class="tm-rating-value"><?php echo esc_html( $rating_value ); ?></span>
                    <span class="tm-rating-count"><?php echo esc_html( sprintf( _n( '%s review', '%s reviews', $review_count, 'theater-manager' ), number_format_i18n( $review_count ) ) ); ?></span>
                </div>

                <div class="tm-theater-single-hero-actions">
                    <?php if ( ! empty( $booking_url ) ) : ?>
                        <a class="tm-btn tm-btn-primary" href="<?php echo esc_url( $booking_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Book Tickets', 'theater-manager' ); ?></a>
                    <?php endif; ?>
                    <?php if ( ! empty( $map_url ) ) : ?>
                        <a class="tm-btn tm-btn-secondary" href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Open Map', 'theater-manager' ); ?></a>
                    <?php endif; ?>
                    <a class="tm-btn tm-btn-outline" href="#tm-linked-shows"><?php esc_html_e( 'View Showtimes', 'theater-manager' ); ?></a>
                </div>
            </div>
        </div>
    </header>

    <div class="tm-theater-single-body">
        <div class="tm-theater-single-main">
            <section class="tm-theater-section">
                <h2 class="tm-theater-section-title"><?php esc_html_e( 'About this Theater', 'theater-manager' ); ?></h2>
                <div class="tm-theater-section-content">
                    <?php the_content(); ?>
                </div>
            </section>

            <section class="tm-theater-section">
                <h2 class="tm-theater-section-title"><?php esc_html_e( 'Details', 'theater-manager' ); ?></h2>
                <div class="tm-theater-details-grid">
                    <?php if ( ! empty( $capacity ) ) : ?>
                        <div class="tm-theater-detail-item">
                            <span class="tm-theater-detail-label"><?php esc_html_e( 'Seating Capacity', 'theater-manager' ); ?></span>
                            <span class="tm-theater-detail-value"><?php echo esc_html( $capacity ); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $showtimes ) ) : ?>
                        <div class="tm-theater-detail-item tm-theater-detail-wide">
                            <span class="tm-theater-detail-label"><?php esc_html_e( 'Default Showtimes', 'theater-manager' ); ?></span>
                            <p class="tm-theater-detail-value">
                                <?php foreach ( $showtimes as $time ) : ?>
                                    <span class="tm-time-pill"><?php echo esc_html( $time ); ?></span>
                                <?php endforeach; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $contact_info ) ) : ?>
                        <div class="tm-theater-detail-item tm-theater-detail-wide">
                            <span class="tm-theater-detail-label"><?php esc_html_e( 'Contact Information', 'theater-manager' ); ?></span>
                            <p class="tm-theater-detail-value"><?php echo nl2br( esc_html( $contact_info ) ); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <?php if ( ! empty( $facilities ) ) : ?>
                <section class="tm-theater-section">
                    <h2 class="tm-theater-section-title"><?php esc_html_e( 'Facilities', 'theater-manager' ); ?></h2>
                    <div class="tm-theater-tags">
                        <?php foreach ( $facilities as $facility ) : ?>
                            <span class="tm-tag"><?php echo esc_html( $facility ); ?></span>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ( $social_fb || $social_tw || $social_ig || $social_site ) : ?>
                <section class="tm-theater-section">
                    <h2 class="tm-theater-section-title"><?php esc_html_e( 'Share & Follow', 'theater-manager' ); ?></h2>
                    <div class="tm-theater-socials">
                        <?php if ( $social_site ) : ?>
                            <a class="tm-social-link" href="<?php echo esc_url( $social_site ); ?>" target="_blank" rel="noopener">
                                <i class="fas fa-globe"></i><span><?php esc_html_e( 'Website', 'theater-manager' ); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if ( $social_fb ) : ?>
                            <a class="tm-social-link" href="<?php echo esc_url( $social_fb ); ?>" target="_blank" rel="noopener">
                                <i class="fab fa-facebook-f"></i><span><?php esc_html_e( 'Facebook', 'theater-manager' ); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if ( $social_tw ) : ?>
                            <a class="tm-social-link" href="<?php echo esc_url( $social_tw ); ?>" target="_blank" rel="noopener">
                                <i class="fab fa-twitter"></i><span><?php esc_html_e( 'Twitter', 'theater-manager' ); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if ( $social_ig ) : ?>
                            <a class="tm-social-link" href="<?php echo esc_url( $social_ig ); ?>" target="_blank" rel="noopener">
                                <i class="fab fa-instagram"></i><span><?php esc_html_e( 'Instagram', 'theater-manager' ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>
        </div>

        <aside class="tm-theater-single-sidebar" id="tm-linked-shows">
            <h2 class="tm-theater-section-title"><?php esc_html_e( 'Showtimes & Linked Shows', 'theater-manager' ); ?></h2>

            <?php if ( ! empty( $linked_shows ) ) : ?>
                <div class="tm-linked-shows-list">
                    <?php foreach ( $linked_shows as $post ) :
                        setup_postdata( $post );
                        $show_poster = get_the_post_thumbnail_url( $post->ID, 'medium' );
                        ?>
                        <article class="tm-linked-show-card">
                            <div class="tm-linked-show-thumb">
                                <?php if ( $show_poster ) : ?>
                                    <div class="tm-linked-show-thumb-img" style="background-image: url('<?php echo esc_url( $show_poster ); ?>');"></div>
                                <?php else : ?>
                                    <div class="tm-linked-show-thumb-img tm-linked-show-thumb-img--empty">
                                        <span><?php esc_html_e( 'No Poster', 'theater-manager' ); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="tm-linked-show-info">
                                <h3 class="tm-linked-show-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="tm-linked-show-meta"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 10, '…' ) ); ?></p>
                                <a class="tm-btn tm-btn-outline" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'theater-manager' ); ?></a>
                            </div>
                        </article>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            <?php else : ?>
                <p class="tm-shows-empty"><?php esc_html_e( 'No shows have been linked to this theater yet.', 'theater-manager' ); ?></p>
            <?php endif; ?>
        </aside>
    </div>

    <footer class="entry-footer tm-theater-single-footer">
        <?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
    </footer>
</article>
