<?php

$cleverpush_id = null;
$cleverpush_amp_cache_time = 60 * 60 * 12;

if (!empty($_GET['channel'])) {
    $cleverpush_id = sanitize_text_field($_GET['channel']);

} else {

    // No need for the template engine
    define('WP_USE_THEMES', false);

    // Assuming we're in a subdir: "~/wp-content/plugins/cleverpush"
    $wpConfigPath = '../../../wp-load.php';
    
    // maybe the user uses bedrock
    if (!file_exists($wpConfigPath)) {
        $wpConfigPath = '../../../wp/wp-load.php';
    }

    if (file_exists($wpConfigPath)) {
        include_once $wpConfigPath;
    
        $cleverpush_id = get_option('cleverpush_channel_id');
    }
}

header("Content-Type: application/javascript");
header("X-Robots-Tag: none");

if (!empty($cleverpush_id)) {
    $cached_script = get_transient('cleverpush_amp_script_' . $cleverpush_id);
    if (!empty($cached_script)) {
        echo esc_js($cached_script);
        die();
    }

    $response = wp_remote_get(
        'https://static.cleverpush.com/channel/amp/' . $cleverpush_id . '.js', [
        'timeout' => 10, // phpcs:ignore
        ]
    );
    if ($response['response']['code'] == 200 && isset($response['body'])) {
        echo esc_js($response['body']);

        set_transient('cleverpush_amp_script_' . $cleverpush_id, $response['body'], $cleverpush_amp_cache_time);
    }

} else {
    echo esc_js("// error: no cleverpush channel id found\n");
}
