<?php

global $wp_query;
$postid = $wp_query->post->ID;
$storyId = get_post_meta($postid, 'cleverpush_story_id', true);
wp_reset_query();

$content = get_transient('cleverpush_story_' . $storyId . '_content');

?>
<?php

echo esc_html($content);
