<?php
if (!defined('ABSPATH')) exit;
?>
<i class="fa-solid fa-location-dot"></i>
<?php
$tag_array = wp_get_object_terms($listingid, $listfoliopro_directory_url . '-locations');
$locations = ''; // Initialize an empty string to store locations

$i = 0;
foreach ($tag_array as $one_tag) {
	$locations .= '<a href="' . get_tag_link($one_tag->term_id) . '">' . esc_attr($one_tag->name) . '</a>';

	// Add a comma after each location, except for the last one
	if ($i < count($tag_array) - 1) {
		$locations .= ', ';
	}

	$i++;
}

echo $locations; // Output the locations with commas
?>
	