<?php

/**
 * Plugin Name: WpGraphql Image DataUrl
 * Plugin URI: https://dipankarmaikap.com
 * Description: Add DataUrl of images.
 * Version: 0.1.0
 * Author:      Dipankar Maikap
 * Author URI:  https://dipankarmaikap.com/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */



add_action('plugins_loaded', 'graphql_plugin_install_check');

function graphql_plugin_install_check()
{
    $dependencies = [
        'WPGraphQL' => class_exists('WPGraphQL'),
    ];
    $missing_dependencies = array_keys(array_diff($dependencies, array_filter($dependencies)));
    $display_admin_notice = function () use ($missing_dependencies) {
?>
        <div class="notice notice-error">
            <p>The Example Plugin core plugin can not be loaded because these dependencies are missing:</p>
            <ul>
                <?php foreach ($missing_dependencies as $missing_dependency) : ?>
                    <li><?php echo esc_html($missing_dependency); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
<?php
    };
    // If dependencies are missing, display admin notice and return early.
    if ($missing_dependencies) {
        add_action('admin_notices', $display_admin_notice);
        add_action('network_admin_notices', $display_admin_notice); // Needed for multisite only.
        return;
    }
}
add_action('graphql_register_types', 'add_dataurl_to_mediaitem');

function add_dataurl_to_mediaitem()
{

    register_graphql_field('MediaItem', 'dataUrl', [
        'description' => __('DataUrl or base64 url of this image', 'your-textdomain'),
        'type' => 'String',
        'resolve' => function ($root) {
            $image = wp_get_attachment_image_src($root->databaseId, 'thumbnail')[0];
            $type = pathinfo($image, PATHINFO_EXTENSION);
            $data = file_get_contents($image);
            $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // graphql_debug($data);
            if ($data) {
                return $dataUri;
            }
            return null;
        },
    ]);
}
