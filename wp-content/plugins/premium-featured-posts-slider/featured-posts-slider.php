<?php
/*
Plugin Name: Premium Featured Posts Slider
Plugin URI: http://featured-posts-slider.webfactoryltd.com/
Description: Displays selected, featured posts in a powerfull, highly configurable slider.
Author: Web factory Ltd
Version: 1.1
Author URI: http://www.webfactoryltd.com/
*/

class wf_fps {
  public static $do_footer = false;

  public function init() {
    if (is_admin() && current_user_can('switch_themes')) {
      // add FPS menu to admin apperance(theme) menu group
      add_action('admin_menu', array('wf_fps', 'admin_menu'));

      // settings registration
      add_action('admin_init', array('wf_fps', 'register_settings'));

      // if the plugin was installed/reinstalled/broken set settings to default
      self::default_settings(false);

      // aditional link in plugin description
      add_action('plugin_action_links_' . basename(dirname(__FILE__)) . '/' . basename(__FILE__), array('wf_fps', 'plugin_action_links'));

      // inject JS code in header for AJAX
      add_action('admin_head', array('wf_fps', 'admin_head'));

      // register AJAX endpoints
      add_action('wp_ajax_fps_post_featured', array('wf_fps', 'ajax_callback_post_featured'));
      add_action('wp_ajax_fps_copy_layout', array('wf_fps', 'ajax_callback_copy_layout'));

      // add custom column "featured"
      add_filter('manage_posts_columns', array('wf_fps', 'add_featured_column'));
      add_filter('manage_pages_columns', array('wf_fps', 'add_featured_column'));
      add_action('manage_posts_custom_column', array('wf_fps', 'manage_featured_column'), 10, 2);
      add_action('manage_pages_custom_column', array('wf_fps', 'manage_featured_column'), 10, 2);

      // enable users to mark a post featured while writing it
      add_action('add_meta_boxes', array('wf_fps', 'add_custom_box'));
      add_action('save_post', array('wf_fps', 'save_postdata'));
    } elseif (!is_admin()) {
      // use footer to inject FPS JS/CSS when needed
      add_action('wp_footer', array('wf_fps', 'wp_footer'));
    }

    // add shortcode support for sidebar text widget
    if (has_filter('widget_text', 'do_shortcode') === false) {
      add_filter('widget_text', 'do_shortcode');
    }

    $options = get_option('wf_fps');

    // add thumbnail support for theme
    add_theme_support('post-thumbnails');

    // add additional image size for slider
    if ($options['additional-height'] && $options['additional-width']) {
      add_image_size('FPS thumbnail', $options['additional-width'], $options['additional-height'], $options['additional-crop']);
    }
    if ($options['thumbnail-height'] && $options['thumbnail-width']) {
      add_image_size('FPS pagination thumbnail', $options['thumbnail-width'], $options['thumbnail-height'], true);
    }

    // add shortcode
    global $shortcode_tags;
    $shortcode = $options['shortcode'];
    if (isset($shortcode_tags[$shortcode])) {
      add_action('admin_footer', array('wf_fps', 'warning'));
    } else {
      add_shortcode($shortcode, array('wf_fps', 'shortcode'));
    }
  } // init

  // add settings link to plugins page
  function plugin_action_links($links) {
    $settings_link = '<a href="themes.php?page=wf-fps" title="Featured Posts Slider Settings">Settings</a>';
    array_unshift($links, $settings_link);

    return $links;
  } // plugin_action_links

  // create the admin menu item
  function admin_menu() {
    add_theme_page('Premium Featured Posts Slider', 'Premium Featured Posts Slider', 'manage_options', 'wf-fps', array('wf_fps', 'options_page'));
  } // admin_menu

  // all settings are saved in one option
  function register_settings() {
    register_setting('wf_fps', 'wf_fps', array('wf_fps', 'sanitize_settings'));
  } // register_settings

  // set default settings
  function default_settings($force = false) {
    $defaults['width'] = '600px';
    $defaults['source'] = 'post';
    $defaults['limit'] = 5;
    $defaults['thumbnail'] = 'medium';
    $defaults['layout'] = 'layout-2';
    $defaults['custom-layout'] = '';
    $defaults['prev-next'] = 1;
    $defaults['pagination'] = 1;
    $defaults['autoplay'] = 5000;
    $defaults['effect'] = 'slide';
    $defaults['effect-speed'] = 350;
    $defaults['hover-pause'] = 1;
    $defaults['randomize'] = 0;
    $defaults['include-css'] = 1;
    $defaults['include-jquery'] = 0;
    $defaults['include-slides'] = 1;
    $defaults['shortcode'] = 'fps';
    $defaults['additional-width'] = 330;
    $defaults['additional-height'] = 330;
    $defaults['additional-crop'] = 1;
    $defaults['conditional'] = '';
    $defaults['thumbnail-width'] = 50;
    $defaults['thumbnail-height'] = 50;

    $options = get_option('wf_fps');

    if ($force || !$options || !$options['source']) {
      update_option('wf_fps', $defaults);
    }
  } // default_settings

  // add custom boxes to all post types
  function add_custom_box() {
    add_meta_box('featured', 'Featured Posts Slider <i>per-post</i> options', array('wf_fps', 'inner_custom_box'), 'post', 'normal', 'high');
    add_meta_box('featured', 'Featured Posts Slider <i>per-post</i> options', array('wf_fps', 'inner_custom_box'), 'page', 'normal', 'high');

    // add box to custom post types
    $post_types = get_post_types(array('public' => true, '_builtin' => false), 'object', 'and');
    if ($post_types) {
      foreach ($post_types  as $post_type ) {
        add_meta_box('featured', 'Featured Posts Slider <i>per-post</i> options', array('wf_fps', 'inner_custom_box'), $post_type->query_var, 'normal', 'high');
      }
    }
  } // add_custom_box

  // custom box for post/page edit
  function inner_custom_box() {
    global $post;

    $layouts[] = array('val' => '',         'label' => 'Default layout defined in global FPS options');
    $layouts[] = array('val' => 'layout-1', 'label' => 'Layout 1 - Large image with title on image bottom');
    $layouts[] = array('val' => 'layout-2', 'label' => 'Layout 2 - Thumbnail with content on right');
    $layouts[] = array('val' => 'layout-3', 'label' => 'Layout 3 - Medium image with content on right');
    $layouts[] = array('val' => 'layout-4', 'label' => 'Layout 4 - Large image with title above image ');
    $layouts[] = array('val' => 'layout-5', 'label' => 'Layout 5 - Thumbnail with content on left');
    $layouts[] = array('val' => 'layout-6', 'label' => 'Layout 6 - Medium image with content on left');
    $layouts[] = array('val' => 'custom',   'label' => 'Custom layout');

    $featured = get_post_meta($post->ID, '_fps_featured', true);
    $thumbnail = get_post_meta($post->ID, '_fps_thumbnail', true);
    $layout = get_post_meta($post->ID, '_fps_layout', true);
    wp_nonce_field(plugin_basename(__FILE__), 'featured_noncename');

    echo '<p><label class="fps-label" for="fps_featured">Featured:</label> <select name="fps_featured" id="fps_featured">';
    echo '<option' . ((!$featured)? ' selected="selected"':'') . ' value="0">No, this post is not featured&nbsp;</option>';
    echo '<option' . (($featured)? ' selected="selected"':'') . ' value="1">Yes, this post is featured</option>';
    echo '</select><br /><br />';

    echo '<label class="fps-label" for="fps_layout">Layout:</label> <select name="fps_layout" id="fps_layout">';
      self::create_select_options($layouts, $layout);
    echo '</select><br /><br />';

    global $_wp_additional_image_sizes;
    $sizes[] = array('val'=> '', 'label' => 'Default thumbnail size defined in global FPS options');
    $sizes[] = array('val'=> 'thumbnail', 'label' => 'Thumbnail, ' . get_option('thumbnail_size_w') . 'x' . get_option('thumbnail_size_h') . (get_option('thumbnail_crop')? ', cropped':''));
    $sizes[] = array('val'=> 'medium', 'label' => 'Medium, ' . get_option('medium_size_w') . 'x' . get_option('medium_size_h'));
    $sizes[] = array('val'=> 'large', 'label' => 'Large, ' . get_option('large_size_w') . 'x' . get_option('large_size_h'));
    if ($_wp_additional_image_sizes) {
      foreach ($_wp_additional_image_sizes as $tmp => $tmp2) {
        $sizes[] = array('val'=> $tmp, 'label' => $tmp . ', ' . $tmp2['width'] . 'x' . $tmp2['height'] . ($tmp2['crop']? ', cropped':''));
      }
    }
    echo '<label class="fps-label" for="fps_thumbnail">Thumbnail:</label> <select name="fps_thumbnail" id="fps_thumbnail">';
      self::create_select_options($sizes, $thumbnail);
    echo '</select></p>';

    echo '<p><br /><a href="themes.php?page=wf-fps" title="Configure global FPS options">Configure global FPS options</a></p>';
  } // inner_custom_box

  // save fetured box data
  function save_postdata($post_id) {
    if (!wp_verify_nonce($_POST['featured_noncename'], plugin_basename(__FILE__)) || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) {
      return $post_id;
    }

    update_post_meta($post_id, '_fps_featured', $_POST['fps_featured']);
    update_post_meta($post_id, '_fps_layout', $_POST['fps_layout']);
    update_post_meta($post_id, '_fps_thumbnail', $_POST['fps_thumbnail']);

    return $post_id;
  } // save_postdata

  // mark post as fetured/unfeatured
  function ajax_callback_post_featured() {
    $post_id = (int) $_POST['post_id'];
    $state = (isset($_POST['state']) && !empty($_POST['state']))? 1: 0;
    update_post_meta($post_id, '_fps_featured', $state);

    die('1');
  } // ajax_callback_post_featured

  // mark post as fetured/unfeatured
  function ajax_callback_copy_layout() {
    require('slider-layout-templates.php');

    if (isset($layouts[$_POST['layout']])) {
      $template = $layouts[$_POST['layout']];
    } else {
      $template = '';
    }

    echo json_encode($template);
    die();
  } // ajax_callback_post_featured

  // featured column for all posts/pages/custom post types
  function add_featured_column($cols) {
    $cols['fps_featured'] = 'Featured';

    return $cols;
  } // add_featured_column

  // featured column content
  function manage_featured_column($column_name, $post_id) {
    if ($column_name == 'fps_featured') {
      echo '<input onchange="javascript: fps_featured_change(this, ' . $post_id . ');" ';
      echo 'type="checkbox" class="fps_featured" id="fps_featured_' . $post_id . '" value="1" ';
      echo checked('1', get_post_meta($post_id, '_fps_featured', true), false)  . ' />';
     }

  return;
  } // manage_featured_column

  // admin JS/CSS
  function admin_head() {
    if (strpos($_SERVER['REQUEST_URI'], 'wf-fps') === false
        && strpos($_SERVER['REQUEST_URI'], 'edit.php') === false
        && strpos($_SERVER['REQUEST_URI'], 'post.php') === false
        ) {
      return;
    }
    ?>
    <script type="text/javascript">
    function fps_featured_change(checkbox, post_id) {
      var data = {action: 'fps_post_featured',
                  state: jQuery(checkbox).attr('checked'),
                  post_id: post_id};

      jQuery(checkbox).attr('disabled', 'disabled');
      jQuery.post(ajaxurl, data, function(response) { jQuery(checkbox).removeAttr('disabled'); });

      return false;
    }

    function fps_copy_layout() {
      var data = {action: 'fps_copy_layout',
                  layout: jQuery('#layouts-sel').val()};

      jQuery('#custom-layout').attr('disabled', 'disabled');
      jQuery.post(ajaxurl, data, function(response) { jQuery('#custom-layout').val(response).removeAttr('disabled'); }, 'json');

      return false;
    }
    </script>
     <style type="text/css">
      div.layout-thumb {
        width: 200px;
        margin: 0 50px 20px 0;
        float: left;
      }
      div.layout-thumb img {
        padding-bottom: 5px;
      }
      div.layout-thumb input {
        margin-right: 5px;
      }
      label.fps-label {
        min-width: 75px;
        float: left;
        line-height: 23px;
      }
    </style>
    <?php
  } // admin_head

  // helper function for creating select's options
  function create_select_options($options, $selected = null, $output = true) {
    $out = "\n";

    foreach ($options as $tmp) {
      if ($selected == $tmp['val']) {
        $out .= "<option selected=\"selected\" value=\"{$tmp['val']}\">{$tmp['label']}&nbsp;</option>\n";
      } else {
        $out .= "<option value=\"{$tmp['val']}\">{$tmp['label']}&nbsp;</option>\n";
      }
    }

    if($output) {
      echo $out;
    } else {
      return $out;
    }
  } // create_select_options

  // sanitize settings on save
  function sanitize_settings($values) {
    foreach ($values as $key => $value) {
      switch ($key) {
        case 'limit':
        case 'prev-next':
        case 'pagination':
        case 'autoplay':
        case 'effect-speed':
        case 'hover-pause':
        case 'randomize':
        case 'include-css':
        case 'include-jquery':
        case 'include-slides':
        case 'additional-width':
        case 'additional-height':
        case 'thumbnail-width':
        case 'thumbnail-height':
        case 'additional-crop':
          $values[$key] = (int) $value;
        break;
        case 'width':
        case 'source':
        case 'thumbnail':
        case 'layout':
        case 'effect':
        case 'conditional':
          $values[$key] = trim($value);
        break;
        case 'shortcode':
          $values[$key] = strtolower(trim($value));
          $values[$key] = str_replace(' ', '', $values[$key]);
        break;
        case 'custom-layout':
        break;
      } // switch
    } // foreach

    self::check_var_isset($values, array('prev-next' => 0,
                                         'pagination' => 0,
                                         'hover-pause' => 0,
                                         'randomize' => 0,
                                         'include-css' => 0,
                                         'include-jquery' => 0,
                                         'include-slides' => 0,
                                         'additional-crop' => 0));

    set_transient('wf-fps-updated', true, 10);

    return $values;
  } // sanitize_settings

  // helper function for $_POST checkbox handling
  function check_var_isset(&$values, $variables) {
    foreach ($variables as $key => $value) {
      if (!isset($values[$key])) {
        $values[$key] = $value;
      }
    }
  } // check_var_isset

  // output the whole options page
  function options_page() {
    if (!current_user_can('manage_options'))  {
      wp_die('You do not have sufficient permissions to access this page.');
    }

    $options = get_option('wf_fps');

    if (get_transient('wf-fps-updated')) {
      echo '<div id="message-fps" class="updated"><p><b>Changes saved.</b></p></div>';
      delete_transient('wf-fps-updated');
    }

    echo '<div class="wrap">
          <div class="icon32" id="icon-themes"><br /></div>
          <h2>Premium Featured Posts Slider</h2>';

    echo '<form action="options.php" method="post">';
    settings_fields('wf_fps');

    echo '<h3>Content &amp; Layout</h3>';

    echo '<table class="form-table"><tbody>';

    echo '<tr valign="top">
    <th scope="row"><label for="width">Width</label></th>
    <td><input type="text" id="width" style="width: 100px;" class="small-text" name="wf_fps[width]" value="' . $options['width'] . '" />';
    echo ' Slider container width. Set the value according to your theme layout. Any CSS parsable value is accepted. We don\'t recommend using "100%". Default: 600px.</td>
    </tr>';

    $sources[] = array('val' => '_featured', 'label' => 'Posts, pages and custom types selected as featured');
    $sources[] = array('val' => 'post', 'label' => 'Latest Posts');
    $sources[] = array('val' => 'page', 'label' => 'Latest Pages');
    $post_types = get_post_types(array('public' => true, '_builtin' => false), 'object', 'and');
    if ($post_types) {
      foreach ($post_types  as $post_type ) {
        $sources[] = array('val' => $post_type->query_var, 'label' => 'Latest ' . $post_type->labels->name);
      }
    }

    $excluded_items = array('nav_menu', 'link_category', 'post_format');
    $taxonomies = get_taxonomies(array('public' => true), 'objects');
    if ($taxonomies) {
      foreach ($taxonomies  as $taxonomy) {
        if (!in_array($taxonomy->name, $excluded_items)) {
          $terms = get_terms($taxonomy->name);
          if ($terms) {
            foreach ($terms as $term) {
              $sources[] = array('val' => '|' . $taxonomy->name . '|' . $term->term_id, 'label' => 'Latest content from ' . $term->name . ' (' . $taxonomy->labels->name . ')');
            } // foreach ($terms)
          } // if ($terms)
        } // if (!in_array)
      } // foreach ($taxonomies)
    } // if ($taxonomies)

    echo '<tr valign="top">
    <th scope="row"><label for="source">Slider Content</label></th>
    <td><select id="source" name="wf_fps[source]">';
      self::create_select_options($sources, $options['source']);
    echo '</select> It\'s expected from editors to manually choose what content is featured but you can automate the process by featuring chronologically latest content. Default: latest posts.</td>
    </tr>';

    $limit[] = array('val' => -1, 'label' => 'Unlimited');
    for ($i=1; $i <= 20; $i++) {
      $limit[] = array('val' => $i, 'label' => $i);
    }
    echo '<tr valign="top">
      <th scope="row"><label for="limit">Number of Slides</label></th>
    <td><select id="limit" name="wf_fps[limit]">';
    self::create_select_options($limit, $options['limit']);
    echo '</select> Number of posts shown in slider. If the number of "featured" posts is greater than "number of slides" the later will take precedence. Default: 5.
    </td></tr>';

    global $_wp_additional_image_sizes;
    $sizes[] = array('val'=> 'thumbnail', 'label' => 'Thumbnail, ' . get_option('thumbnail_size_w') . 'x' . get_option('thumbnail_size_h') . (get_option('thumbnail_crop')? ', cropped':''));
    $sizes[] = array('val'=> 'medium', 'label' => 'Medium, ' . get_option('medium_size_w') . 'x' . get_option('medium_size_h'));
    $sizes[] = array('val'=> 'large', 'label' => 'Large, ' . get_option('large_size_w') . 'x' . get_option('large_size_h'));
    if ($_wp_additional_image_sizes) {
      foreach ($_wp_additional_image_sizes as $tmp => $tmp2) {
        $sizes[] = array('val'=> $tmp, 'label' => $tmp . ', ' . $tmp2['width'] . 'x' . $tmp2['height'] . ($tmp2['crop']? ', cropped':''));
      }
    }

    echo '<tr valign="top">
      <th scope="row"><label for="thumbnail">Thumbnail Size</label></th>
    <td><select id="thumbnail" name="wf_fps[thumbnail]">';
    self::create_select_options($sizes, $options['thumbnail']);
    echo '</select> Select the size that best fits your site\'s layout and selected FPS layout. You can <a href="#additional-width">customize the FPS thumbnail</a> size. Thumbnail size can be chosen on a per-post basis while editing individual posts. Default: medium.
    </td></tr>';

    $img = plugins_url('/images/', __FILE__);
    $layouts[] = array('val' => 'layout-1', 'label' => 'Layout 1 - Large image with title on image bottom');
    $layouts[] = array('val' => 'layout-2', 'label' => 'Layout 2 - Thumbnail with content on right');
    $layouts[] = array('val' => 'layout-3', 'label' => 'Layout 3 - Medium image with content on right');
    $layouts[] = array('val' => 'layout-4', 'label' => 'Layout 4 - Large image with title above image ');
    $layouts[] = array('val' => 'layout-5', 'label' => 'Layout 5 - Thumbnail with content on left');
    $layouts[] = array('val' => 'layout-6', 'label' => 'Layout 6 - Medium image with content on left');

    echo '<tr valign="top">
    <th scope="row"><label>Layout</label></th>
    <td>
    <div class="layout-thumb"><label for="layout-1"><img src="' . $img . 'layout-image-full.png" alt="Layout 1" title="Layout 1" /></label><br /><input ' . checked('layout-1', $options['layout'], false) . ' type="radio" id="layout-1" name="wf_fps[layout]" value="layout-1" /> Large image with title on image bottom </div>
    <div class="layout-thumb"><label for="layout-2"><img src="' . $img . 'layout-image-left.png" alt="Layout 2" title="Layout 2" /></label><br /><input ' . checked('layout-2', $options['layout'], false) . ' type="radio" id="layout-2" name="wf_fps[layout]" value="layout-2" /> Thumbnail with content on right</div>
    <div class="layout-thumb"><label for="layout-3"><img src="' . $img . 'layout-image-left-short.png" alt="Layout 3" title="Layout 3" /></label><br /><input ' . checked('layout-3', $options['layout'], false) . ' type="radio" id="layout-3" name="wf_fps[layout]" value="layout-3" /> Medium image with content on right </div>
    <div class="layout-thumb"><label for="layout-4"><img src="' . $img . 'layout-image-full-top-title.png" alt="Layout 4" title="Layout 4" /></label><br /><input ' . checked('layout-4', $options['layout'], false) . ' type="radio" id="layout-4" name="wf_fps[layout]" value="layout-4" /> Large image with title above image </div>
    <div class="layout-thumb"><label for="layout-5"><img src="' . $img . 'layout-image-right.png" alt="Layout 5" title="Layout 5" /></label><br /><input ' . checked('layout-5', $options['layout'], false) . ' type="radio" id="layout-5" name="wf_fps[layout]" value="layout-5" /> Thumbnail with content on left</div>
    <div class="layout-thumb"><label for="layout-6"><img src="' . $img . 'layout-image-right-short.png" alt="Layout 6" title="Layout 6" /></label><br /><input ' . checked('layout-6', $options['layout'], false) . ' type="radio" id="layout-6" name="wf_fps[layout]" value="layout-6" /> Medium image with content on left</div><br style="clear: both;" />

    <input ' . checked('custom', $options['layout'], false) . ' type="radio" id="layout-custom" name="wf_fps[layout]" value="custom" /> <label for="layout-custom">Custom layout code</label>
    <textarea name="wf_fps[custom-layout]" id="custom-layout" style="width: 100%" rows="10" cols="20">' . $options['custom-layout'] . '</textarea><br />';
    echo '<p>Copy code from a predefined layout into the code editor:
    <select id="layouts-sel" name="layouts-sel">';
    self::create_select_options($layouts, '');
    echo '</select>
    <input type="button" value="Copy" class="button-secondary" name="copy" onclick="javascript:fps_copy_layout()" /></p>
    <p>The following 18 variables are available for use in custom layout code: (<a href="#" onclick="javascript:jQuery(\'#layout-variables\').toggle(); return false;">show variables</a>)</p>
    <ul id="layout-variables" style="list-style: circle inside; margin-left: 20px; display: none;">
     <li>{id} - post ID; ie: 34</li>
     <li>{permalink} - post permalink URL; ie: http://www.myweb.com/my-pos/</li>
     <li>{title} - post title; ie: My Nice Title</li>
     <li>{excerpt} - post excerpt with "the_excerpt" filter applied. If there\'s no excerpt an empty string is returned.</li>
     <li>{content-full} - complete post content with "the_content" filter applied.</li>
     <li>{content} - post content before the "&lt;!--more--&gt;" separator with "the_content" filter applied.</li>
     <li>{author} - post author "display name"; ie: John Doe</li>
     <li>{author-link} - URL to author\'s archive page; ie: http://www.myweb.com/author/john/</li>
     <li>{date} - post "published" date. Formatted using "date format" from <a href="options-general.php">Options - General</a>; ie: 2011/02/22</li>
     <li>{time} - post "published" time. Formatted using "time format" from <a href="options-general.php">Options - General</a>; ie: 8:22 am</li>
     <li>{comments-count} - total comments count; ie: 25</li>
     <li>{categories} - comma separated list of category links</li>
     <li>{tags} - comma separated list of tag links</li>
     <li>{thumbnail} - thumbnail &lt;IMG&gt; HTML element complete with src, width, height and default WP CSS classes.</li>
     <li>{thumbnail-src} - thumbnail file URL</li>
     <li>{thumbnail-width} - thumbnail width in pixels; ie: 330.</li>
     <li>{thumbnail-height} - thumbnail height in pixels; ie: 330.</li>
     <li>{slider-width} - slider width you entered in <a href="#width">FPS options above</a>; ie: 700px.</li>
    </ul>
    <p>Layouts can be chozen on a per-post basis while editing individual posts. Default: layout 2.</p>
    </td></tr>';

    echo '</tbody></table>';
    echo '<p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="Submit" /></p>';

    echo '<h3>Options</h3>';

    echo '<table class="form-table"><tbody>';

    echo '<tr valign="top">
    <th scope="row"><label for="prev-next">Auto Generate Previous and Next Buttons</label></th>
    <td><input name="wf_fps[prev-next]" id="prev-next" ' . checked('1', $options['prev-next'], false) . ' value="1" type="checkbox" /> If checked previous and next buttons will be placed on left and right edges of the slider. Default: checked.</td>
    </tr>';

    $pagination[] = array('val' => '0', 'label' => 'No');
    $pagination[] = array('val' => '1', 'label' => 'Yes, in form of circles');
    $pagination[] = array('val' => '2', 'label' => 'Yes, in form of post thumbnails');

    echo '<tr valign="top">
    <th scope="row"><label for="pagination">Auto Generate Pagination</label></th>
    <td><select id="pagination" name="wf_fps[pagination]">';
    self::create_select_options($pagination, $options['pagination']);
    echo '</select> If checked pagination circles or thumbnails will be placed below the slider. Default: circles.</td>
    </tr>';

    $autoplay[] = array('val' => '0', 'label' => 'Disable autoplay');
    $autoplay[] = array('val' => '500', 'label' => 'Every 0.5 seconds');
    $autoplay[] = array('val' => '1000', 'label' => 'Every second');
    $autoplay[] = array('val' => '1500', 'label' => 'Every 1.5 seconds');
    for($i=2000; $i<=20000; $i+=500) {
      $autoplay[] = array('val' => $i, 'label' => 'Every ' . number_format($i/1000, 1) . ' seconds');
    }
    echo '<tr valign="top">
    <th scope="row"><label for="autoplay">Autoplay</label></th>
    <td><select id="autoplay" name="wf_fps[autoplay]">';
    self::create_select_options($autoplay, $options['autoplay']);
    echo '</select> Time between each automatic slide switch. Default: 5 seconds.</td>
    </tr>';

    $effects[] = array('val' => 'slide', 'label' => 'Slide');
    $effects[] = array('val' => 'fade', 'label' => 'Fade');
    echo '<tr valign="top">
    <th scope="row"><label for="effect">Transition Effect</label></th>
    <td><select id="effect" name="wf_fps[effect]">';
    self::create_select_options($effects, $options['effect']);
    echo '</select> Effect used for transitioning between slides. Default: slide.</td>
    </tr>';

    for($i=50; $i<=2000; $i+=50) {
      $speed[] = array('val' => $i, 'label' => $i . ' miliseconds');
    }
    echo '<tr valign="top">
    <th scope="row"><label for="effect-speed">Transition Effect Speed</label></th>
    <td><select id="effect-speed" name="wf_fps[effect-speed]">';
    self::create_select_options($speed, $options['effect-speed']);
    echo '</select> Duration of transition effect/animation in milliseconds. Default: 350 milliseconds.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="hover-pause">Stop on Hover</label></th>
    <td><input name="wf_fps[hover-pause]" id="hover-pause" ' . checked('1', $options['hover-pause'], false) . ' value="1" type="checkbox" /> If checked autoplay will be stopped once user hovers over the slider. Default: checked.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="randomize">Randomize</label></th>
    <td><input name="wf_fps[randomize]" id="randomize" ' . checked('1', $options['randomize'], false) . ' value="1" type="checkbox" /> Randomize slides order. By default they are orderd by publishing date, descending. Default: unchecked.</td>
    </tr>';

    echo '</tbody></table>';
    echo '<p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="Submit" /></p>';

    echo '<h3>Advanced Options</h3>';

    echo '<table class="form-table"><tbody>';

    echo '<tr valign="top">
    <th scope="row"><label for="include-css">Include CSS</label></th>
    <td><input name="wf_fps[include-css]" id="include-css" ' . checked('1', $options['include-css'], false) . ' value="1" type="checkbox" /> If you wrote your own CSS for slides or copy/pasted our CSS code into some other file then disable this option. Default: checked.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="include-jquery">Include jQuery</label></th>
    <td><input name="wf_fps[include-jquery]" id="include-jquery" ' . checked('1', $options['include-jquery'], false) . ' value="1" type="checkbox" /> If your theme doesn\'t already have jQuery included enable this option. Default: unchecked.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="include-slides">Include Slides JS</label></th>
    <td><input name="wf_fps[include-slides]" id="include-slides" ' . checked('1', $options['include-slides'], false) . ' value="1" type="checkbox" /> If your theme already has <a href="http://slidesjs.com/">Slides JS</a> included uncheck this option. Default: checked.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="shortcode">Shortcode Name</label></th>
    <td><input type="text" id="shortcode" style="width: 80px;" class="small-text" name="wf_fps[shortcode]" value="' . $options['shortcode'] . '" />';
    echo ' Write only the shortcode name, without brackets. If the shortcode name you want is already taken you\'ll be notified after saving. Default: fps.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="additional-width">Additional Image Size</label></th>
    <td><input type="text" id="additional-width" style="width: 60px;" class="small-text" name="wf_fps[additional-width]" value="' . $options['additional-width'] . '" /> x <input type="text" id="additional-height" style="width: 60px;" class="small-text" name="wf_fps[additional-height]" value="' . $options['additional-height'] . '" /> px &nbsp;&nbsp;&nbsp; <label for="additional-crop">Crop to size</label>&nbsp; <input name="wf_fps[additional-crop]" id="additional-crop" ' . checked('1', $options['additional-crop'], false) . ' value="1" type="checkbox" /> ';
    echo '<br />If you need an additional image (thumbnail) size besides the <a href="options-media.php">default WordPress sizes</a> (thumbnail, medium, large) you can define it here. Please note: changes to image sizes are not "retroactive" meaning they will only affect newly uploaded images. Once the size is changed you have to re-build or re-upload the images. We suggest using <a href="http://codecanyon.net/item/image-sizes-manager/309402">Image Sizes Manager</a>. Default: 330x330px, cropped.</td>
    </tr>';

if (!$options['thumbnail-width'] || !$options['thumbnail-height']) {
  $options['thumbnail-width'] = 50;
  $options['thumbnail-height'] = 50;
}

    echo '<tr valign="top">
    <th scope="row"><label for="thumbnail-width">Pagination Thumbnail Image Size</label></th>
    <td><input type="text" id="thumbnail-width" style="width: 60px;" class="small-text" name="wf_fps[thumbnail-width]" value="' . $options['thumbnail-width'] . '" /> x <input type="text" id="thumbnail-height" style="width: 60px;" class="small-text" name="wf_fps[thumbnail-height]" value="' . $options['thumbnail-height'] . '" /> px';
    echo '<br />If you\'re using thumbnails for pagination please set the size that fits your theme and needs. Please note: changes to image sizes are not "retroactive" meaning they will only affect newly uploaded images. Once the size is changed you have to re-build or re-upload the images. We suggest using <a href="http://codecanyon.net/item/image-sizes-manager/309402">Image Sizes Manager</a>. Default: 50x50px, cropped.</td>
    </tr>';

    $conditionals[] = array('val' => '', 'label' => 'On all pages');
    $conditionals[] = array('val' => 'is_front_page', 'label' => 'Only if is_front_page()');
    $conditionals[] = array('val' => 'is_home', 'label' => 'Only if is_home()');
    $conditionals[] = array('val' => 'is_category', 'label' => 'Only if is_category()');
    $conditionals[] = array('val' => 'is_singular', 'label' => 'Only if is_singular()');
    $conditionals[] = array('val' => 'is_not_singular', 'label' => 'Only if is_not_singular()');

    echo '<tr valign="top">
    <th scope="row"><label for="conditional">Show Slider</label></th>
    <td><select id="conditional" name="wf_fps[conditional]">';
    self::create_select_options($conditionals, $options['conditional']);
    echo '</select> If you want FPS shown only on certain pages but you placed FPS code in ie <i>header.php</i> set this option to enable conditional display. Default: always display FPS.</td>
    </tr>';

    echo '</tbody></table>';
    echo '<p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="Submit" /></p>';

    echo '</form></div>';
  } // options_page

  // generate HTML code for slider
  public function generate_html() {
    $out = '';
    $options = get_option('wf_fps');

    // show slider only in certain circumstances
    if ($options['conditional']) {
      if ($options['conditional']       == 'is_home' && !is_home()) {
        return;
      } elseif ($options['conditional'] == 'is_front_page' && !is_front_page()) {
        return;
      } elseif ($options['conditional'] == 'is_category' && !is_category()) {
        return;
      } elseif ($options['conditional'] == 'is_singular' && !is_singular()) {
        return;
      } elseif ($options['conditional'] == 'is_not_singular' && is_singular()) {
        return;
      }
    }

    $types = array('post', 'page');
    $post_types = get_post_types(array('public' => true, '_builtin' => false), 'object', 'and');
    if ($post_types) {
      foreach ($post_types  as $post_type ) {
        $types[] = $post_type->query_var;
      }
    } else {
      $post_types = array();
    }
    if ($options['source'] == '_featured') {
      $filter = array('numberposts' => $options['limit'],
                       'meta_key'   => '_fps_featured',
                       'meta_value' => 1,
                       'orderby'    => 'post_date',
                       'order'      => 'DESC',
                       'post_type'  => $types);
    } elseif (substr($options['source'], 0, 1) != '|') {
      $filter = array('numberposts' => $options['limit'],
                      'post_type'   => $options['source'],
                      'orderby'     => 'post_date',
                      'order'       => 'DESC',);
    } else {
      $source = explode('|', $options['source']);
      if ($source[1] == 'category') {
        $category = 'category';
      } else {
        $category = $source[1] . '_category';
      }
      $filter = array('numberposts' => $options['limit'],
                      'post_type'   => $types,
                      $category     => $source[2],
                      'orderby'     => 'post_date',
                      'order'       => 'DESC',);

    }
    $featured_posts = get_posts($filter);

    require('slider-layout-templates.php');

    $out .= '<div id="fps-container">';
    $out .= '<div class="fps-slides-container">';
    $slide_nb = 1;
    $pagination = '';

    foreach($featured_posts as $featured) {
      $pagination .= '<li><a href="">' . get_the_post_thumbnail($featured->ID, 'FPS pagination thumbnail', array('class' => 'fps-thumbnail-mini')) . '</a></li>';

      // $featured "is" $post
      // get per-post or global layout
      if (get_post_meta($featured->ID, '_fps_layout', true)) {
        $layout = get_post_meta($featured->ID, '_fps_layout', true);
      } else {
        $layout = $options['layout'];
      }
      if ($layout == 'custom') {
        $template = $options['custom-layout'];
      } else {
        $template = $layouts[$layout];
      }

      // get per-post or global thumbnail size
      if (get_post_meta($featured->ID, '_fps_thumbnail', true)) {
        $thumbnail_size = get_post_meta($featured->ID, '_fps_thumbnail', true);
      } else {
        $thumbnail_size = $options['thumbnail'];
      }

      $tags = get_the_tags($featured->ID);
      $tags2 = '';
      if ($tags)
        foreach($tags as $tag) {
          $tags2 .= '<a href="/tag/' . $tag->slug . '">' . $tag->name . '</a>, ';
        }
      $tags2 = trim($tags2, ', ');

      $content = $featured->post_content;
      if (strpos($content, '<!--more-->')) {
        $content = substr($content, 0, strpos($content, '<!--more-->')) . '  <a href="' . get_permalink($featured->ID) . '">(more...)</a>';
      }
      $content = apply_filters('the_content', $content);

      $thumbnail = get_post_thumbnail_id($featured->ID);
      $thumbnail = wp_get_attachment_image_src($thumbnail, $thumbnail_size);

      global $post;
      $post = $featured;
      $tmp = str_replace(array('{id}',
                               '{permalink}',
                               '{title}',
                               '{excerpt}',
                               '{content-full}',
                               '{content}',
                               '{author}',
                               '{author-link}',
                               '{date}',
                               '{time}',
                               '{comments-count}',
                               '{categories}',
                               '{tags}',
                               '{thumbnail}',
                               '{thumbnail-src}',
                               '{thumbnail-width}',
                               '{thumbnail-height}',
                               '{slider-width}'),
                        array($featured->ID,
                               get_permalink($featured->ID),
                               $featured->post_title,
                               apply_filters('the_excerpt', $featured->post_excerpt),
                               apply_filters('the_content', $featured->post_content),
                               $content,
                               get_the_author_meta('display_name', $featured->post_author),
                               get_author_posts_url($featured->post_author),
                               get_the_date(''),
                               get_the_time(''),
                               (int) $featured->comments_count,
                               get_the_category_list(', ', '', $featured->ID),
                               $tags2,
                               get_the_post_thumbnail($featured->ID, $thumbnail_size, array('class' => 'fps-thumbnail')),
                               $thumbnail[0],
                               $thumbnail[1],
                               $thumbnail[2],
                               $options['width']), $template);

     if ($slide_nb != 1) {
      $tmp_display = 'display: none; ';
     } else {
      $tmp_display = '';
     }
     $out .= '<div class="post fps-slide" style="' . $tmp_display . 'width: ' . $options['width'] . ';">' . $tmp . '</div>';
     $slide_nb++;
    } // foreach post
    $out .= '</div>';

    if ($options['pagination'] == 2) {
      $out .= '<ul class="fps-pagination thumb-pagination">' . $pagination . '</ul>';
    }
    $out .= "</div>\n";

    // include JS/CSS only if needed
    if ($featured_posts) {
      self::$do_footer = true;
    }

    return $out;
  } // generate_html

  // shortcode for FPS, just a wrapper
  function shortcode($options, $content) {
    return self::generate_html();
  } // shortcode

  // slides JS code for footer
  function wp_footer() {
    if (!self::$do_footer) {
      return;
    }

    $options = get_option('wf_fps');
    $preload_img = plugins_url('/images/preload.gif', __FILE__);

    if($options['include-css']) {
      $slides_css = plugins_url('/css/featured-posts-slider.css?v4', __FILE__);
      echo '<style type="text/css">@import url(' . $slides_css . ");</style>\n";
    }

    if($options['include-jquery']) {
      $jquery_js = plugins_url('/js/jquery-1.6.2.min.js', __FILE__);
      echo '<script type="text/javascript" src="' . $jquery_js . '"></script>' . "\n";
    }

    if($options['include-slides']) {
      $slides_js = plugins_url('/js/slides.min.jquery.js', __FILE__);
      echo '<script type="text/javascript" src="' . $slides_js . '"></script>' . "\n";
    }

    echo '<script type="text/javascript">' . "\n";
    echo 'jQuery(document).ready(function() {';
    echo "jQuery('#fps-container').slides({
              preload: true,
              preloadImage: '{$preload_img}',
              container: 'fps-slides-container',
              generateNextPrev: {$options['prev-next']},
              next: 'fps-next',
              prev: 'fps-prev',
              pagination: true,
              generatePagination: " . ($options['pagination'] == '1'? '1': '0') . ",
              paginationClass: 'fps-pagination',
              fadeSpeed: {$options['effect-speed']},
              slideSpeed: {$options['effect-speed']},
              start: 1,
              effect: '{$options['effect']}',
              randomize: {$options['randomize']},
              play: {$options['autoplay']},
              pause: 0,
              hoverPause: {$options['hover-pause']},
              autoHeight: 1});";
    echo "\n});";
    echo "\n</script>\n";
  } // wp_footer

  // warning if [fps] shortcode is already taken
  public function warning() {
    $shortcode = get_option('wf_fps');
    $shortcode = $shortcode['shortcode'];
    echo '<div id="message-shortcode" class="error"><p><strong>Featured Posts Slider shortcode is not active!</strong> The shortcode [' . $shortcode . '] is already in use by another plugin. Please <a href="themes.php?page=wf-fps#shortcode">update the settings</a> and select a different shortcode.</p></div>';
  } // warning
} // class wf_fps

// template function, echoes slider code
function the_featured_posts_slider() {
  echo wf_fps::generate_html();
} // the_featured_posts_slider

// template function, returns slider code
function get_the_featured_posts_slider() {
  return wf_fps::generate_html();
} // get_the_featured_posts_slider

// hook Featured Posts Plugin
add_action('init', array('wf_fps', 'init'));
?>