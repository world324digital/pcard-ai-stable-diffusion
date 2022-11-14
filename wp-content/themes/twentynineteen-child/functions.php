<?php

define("STABLE_DIFFUSION_VERSION", "8abccf52e7cba9f6e82317253f4a3549082e966db5584e92c808ece132037776");
// define("REPLICATE_API_TOKEN", "41c44fecf2994ab460b87c1a87fcc19332d7a224");
define("REPLICATE_API_TOKEN", "b6fe04eadc47f383dcb186f34c2d220493586c98");

add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles()
{
   wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array(), '1.0.2');
   wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
   wp_enqueue_style('bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css');
}

function my_load_jquery()
{
   wp_enqueue_script('jquery_min_script', get_stylesheet_directory_uri() . '/js/jquery.min.js');
   // wp_enqueue_script('jquery_slim_script', 'https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js');
   // wp_enqueue_script('popper_script', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js');
   // wp_enqueue_script('bootstrap_bundle_script', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js');
}

function add_custom_script_to_wp_head()
{
   wp_enqueue_script('header_script', get_stylesheet_directory_uri() . '/js/header.js', array(), '1.0.0', true);
   wp_add_inline_script('header_script', 'const CONFIG = ' . json_encode(array(
      'ajaxUrl' => admin_url('admin-ajax.php'),
      'siteUrl' => get_site_url()
   )), 'before');
}
add_action('wp_head', 'add_custom_script_to_wp_head');

add_action('wp_enqueue_scripts', 'my_load_jquery');

function load_custom_javascript()
{
   if (is_page('83')) {  // Create Image Page
      wp_enqueue_script('create_image_script', get_stylesheet_directory_uri() . '/js/create_image.js', array(), '1.0.0', true);
      wp_add_inline_script('create_image_script', 'const CONFIG = ' . json_encode(array(
         'ajaxUrl' => admin_url('admin-ajax.php'),
         'siteUrl' => get_site_url()
      )), 'before');
   }
   if (is_page('211')) {  // Home page
      wp_enqueue_script('home_page_script', get_stylesheet_directory_uri() . '/js/homepage.js', array(), '1.0.1', true);
      wp_add_inline_script('home_page_script', 'const CONFIG = ' . json_encode(array(
         'ajaxUrl' => admin_url('admin-ajax.php'),
         'siteUrl' => get_site_url()
      )), 'before');
   }
   if (is_page('547')) { // Evolve Page
      wp_enqueue_script('evolve_page_script', get_stylesheet_directory_uri() . '/js/evolve.js', array(), '1.0.2', true);
      wp_add_inline_script('evolve_page_script', 'const CONFIG = ' . json_encode(array(
         'ajaxUrl' => admin_url('admin-ajax.php'),
         'siteUrl' => get_site_url()
      )), 'before');
   }
   if (is_page('589')) { // Create Card Page
      wp_enqueue_script('card_page_script', get_stylesheet_directory_uri() . '/js/create_card.js', array(), '1.0.1', true);
      wp_add_inline_script('card_page_script', 'const CONFIG = ' . json_encode(array(
         'ajaxUrl' => admin_url('admin-ajax.php'),
         'siteUrl' => get_site_url()
      )), 'before');
   }
   if (is_page('691')) { // Finish Page
      wp_enqueue_script('finish_page_script', get_stylesheet_directory_uri() . '/js/finish.js', array(), '1.0.0', true);
      wp_add_inline_script('finish_page_script', 'const CONFIG = ' . json_encode(array(
         'ajaxUrl' => admin_url('admin-ajax.php'),
         'siteUrl' => get_site_url()
      )), 'before');
   }
   if (is_page('712')) { // Review Page
      wp_enqueue_script('review_page_script', get_stylesheet_directory_uri() . '/js/review.js', array(), '1.0.0', true);
      wp_add_inline_script('review_page_script', 'const CONFIG = ' . json_encode(array(
         'ajaxUrl' => admin_url('admin-ajax.php'),
         'siteUrl' => get_site_url()
      )), 'before');
   }

   if (is_page('1226')) { // Stripe Success Page
      wp_enqueue_script('payment_success_page_script', get_stylesheet_directory_uri() . '/js/stripe_success.js', array(), '1.0.0', true);
   }

   if (is_page('1302')) { // Stripe Fail Page
      wp_enqueue_script('payment_fail_page_script', get_stylesheet_directory_uri() . '/js/stripe_fail.js', array(), '1.0.0', true);
   }
}

add_action('wp_enqueue_scripts', 'load_custom_javascript');

add_action('wp_ajax_predict_action', 'predict_stable_diffusion');
add_action('wp_ajax_nopriv_predict_action', 'predict_stable_diffusion');


function cptui_register_my_cpts_card()
{

   /**
    * Post Type: Cards.
    */

   $labels = [
      "name" => esc_html__("Cards", "custom-post-type-ui"),
      "singular_name" => esc_html__("Card", "custom-post-type-ui"),
      "menu_name" => esc_html__("User Cards", "custom-post-type-ui"),
      "all_items" => esc_html__("All Cards", "custom-post-type-ui"),
      "add_new" => esc_html__("Add New", "custom-post-type-ui"),
      "add_new_item" => esc_html__("Add New Card", "custom-post-type-ui"),
      "edit_item" => esc_html__("Edit Card", "custom-post-type-ui"),
      "new_item" => esc_html__("New Card", "custom-post-type-ui"),
      "view_item" => esc_html__("View Card", "custom-post-type-ui"),
      "view_items" => esc_html__("View Cards", "custom-post-type-ui"),
      "search_items" => esc_html__("Search Cards", "custom-post-type-ui"),
      "not_found" => esc_html__("No Cards found", "custom-post-type-ui"),
      "not_found_in_trash" => esc_html__("No Cards found in Trash", "custom-post-type-ui"),
      "parent" => esc_html__("Parent Card", "custom-post-type-ui"),
      "items_list" => esc_html__("Cards list", "custom-post-type-ui"),
      "name_admin_bar" => esc_html__("Card", "custom-post-type-ui"),
      "parent_item_colon" => esc_html__("Parent Card", "custom-post-type-ui"),
   ];

   $args = [
      "label" => esc_html__("Cards", "custom-post-type-ui"),
      "labels" => $labels,
      "description" => "",
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "show_in_rest" => true,
      "rest_base" => "",
      "rest_controller_class" => "WP_REST_Posts_Controller",
      "rest_namespace" => "wp/v2",
      "has_archive" => false,
      "show_in_menu" => true,
      "show_in_nav_menus" => true,
      "delete_with_user" => false,
      "exclude_from_search" => false,
      "capability_type" => "post",
      "map_meta_cap" => true,
      "hierarchical" => false,
      "can_export" => false,
      "rewrite" => ["slug" => "card", "with_front" => true],
      "query_var" => true,
      "supports" => ["title", "editor", "thumbnail", "custom-fields"],
      "show_in_graphql" => false,
   ];

   register_post_type("card", $args);
}

add_action('init', 'cptui_register_my_cpts_card');


function predict_stable_diffusion()
{
   if (is_user_logged_in()) {
      if (isset($_POST['prompt'])) {
         $prompt = $_POST['prompt'];

         $curl = curl_init();

         $input = array(
            'guidance_scale' => 7.5,
            'height' => '256',
            'num_inference_steps' => 50,
            'num_outputs' => '4',
            'prompt' => $prompt,
            'prompt_strength' => 0.8,
            'scheduler' => 'K-LMS',
            'width' => '384'
         );

         $params = array(
            'version' => STABLE_DIFFUSION_VERSION,
            'input' => $input
         );

         curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.replicate.com/v1/predictions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
               'Authorization: Token ' . REPLICATE_API_TOKEN,
               'Content-Type: application/json'
            ),
         ));

         $response = curl_exec($curl);
         $response = json_decode($response);
         curl_close($curl);

         $result = array(
            'klms' => '',
            'ddim' => ''
         );

         $result['klms'] = $response->id;

         // $input['scheduler'] = 'DDIM';

         // $params = array(
         //    'version' => STABLE_DIFFUSION_VERSION,
         //    'input' => $input
         // );

         // $curl = curl_init();
         // curl_setopt_array($curl, array(
         //    CURLOPT_URL => 'https://api.replicate.com/v1/predictions',
         //    CURLOPT_RETURNTRANSFER => true,
         //    CURLOPT_ENCODING => '',
         //    CURLOPT_MAXREDIRS => 10,
         //    CURLOPT_TIMEOUT => 0,
         //    CURLOPT_FOLLOWLOCATION => true,
         //    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         //    CURLOPT_CUSTOMREQUEST => 'POST',
         //    CURLOPT_POSTFIELDS => json_encode($params),
         //    CURLOPT_HTTPHEADER => array(
         //       'Authorization: Token ' . REPLICATE_API_TOKEN,
         //       'Content-Type: application/json'
         //    ),
         // ));

         // $response = curl_exec($curl);
         // curl_close($curl);
         // $response = json_decode($response);
         // $result['ddim'] = $response->id;

         echo json_encode($result);
      }

      wp_die();
   } else {
      $result = array(
         'status' => 'failed',
         'message' => 'You can create images after sign in!'
      );
      echo json_encode($result);
      wp_die();
   }
}

add_action('wp_ajax_klms_predict_result_action', 'get_klms_predict_results');
add_action('wp_ajax_nopriv_klms_predict_result_action', 'get_klms_predict_results');

function get_klms_predict_results()
{
   if (isset($_POST['id'])) {
      $id = $_POST['id'];

      $curl = curl_init();

      curl_setopt_array($curl, array(
         CURLOPT_URL => 'https://api.replicate.com/v1/predictions/' . $id,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => '',
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => 'GET',
         CURLOPT_HTTPHEADER => array(
            'Authorization: Token ' . REPLICATE_API_TOKEN,
            'Content-Type: application/json'
         ),
      ));

      $response = curl_exec($curl);
      $response = json_decode($response);
      curl_close($curl);

      echo json_encode($response);
   }

   wp_die();
}

add_action('wp_ajax_ddim_predict_result_action', 'get_ddim_predict_results');
add_action('wp_ajax_nopriv_ddim_predict_result_action', 'get_ddim_predict_results');

function get_ddim_predict_results()
{
   if (isset($_POST['id'])) {
      $id = $_POST['id'];

      $curl = curl_init();

      curl_setopt_array($curl, array(
         CURLOPT_URL => 'https://api.replicate.com/v1/predictions/' . $id,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => '',
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => 'GET',
         CURLOPT_HTTPHEADER => array(
            'Authorization: Token ' . REPLICATE_API_TOKEN,
            'Content-Type: application/json'
         ),
      ));

      $response = curl_exec($curl);
      $response = json_decode($response);
      curl_close($curl);

      echo json_encode($response);
   }

   wp_die();
}


add_action('wp_ajax_evolve_action', 'evolve_stable_diffusion');
add_action('wp_ajax_nopriv_evolve_action', 'evolve_stable_diffusion');

function evolve_stable_diffusion()
{

   $result = array(
      'id' => '',
      'status' => 'fail',
      'message' => '',
      'credits' => '0'
   );


   if (is_user_logged_in()) {
      $user_id = get_current_user_id();
      $credits = (int)get_user_meta($user_id, 'credits')[0];
      if ($credits > 1) {
         if (isset($_POST['prompt']) && isset($_POST['init_image'])) {
            $prompt = $_POST['prompt'];
            $init_image = $_POST['init_image'];

            $curl = curl_init();

            $input = array(
               'guidance_scale' => 7.5,
               'height' => '256',
               'num_inference_steps' => 50,
               'num_outputs' => '4',
               'prompt' => $prompt,
               'init_image' => $init_image,
               'prompt_strength' => 0.8,
               'scheduler' => 'K-LMS',
               'width' => '384'
            );

            $params = array(
               'version' => STABLE_DIFFUSION_VERSION,
               'input' => $input
            );

            curl_setopt_array($curl, array(
               CURLOPT_URL => 'https://api.replicate.com/v1/predictions',
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => '',
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => 'POST',
               CURLOPT_POSTFIELDS => json_encode($params),
               CURLOPT_HTTPHEADER => array(
                  'Authorization: Token ' . REPLICATE_API_TOKEN,
                  'Content-Type: application/json'
               ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);
            curl_close($curl);

            $result['id'] = $response->id;
            $result['status'] = 'success';
            $result['credits'] = $credits - 1;
            update_user_meta($user_id, 'credits', $credits - 1);

            echo json_encode($result);
         }

         wp_die();
      } else {
         $result['message'] = 'Your credits are not enough to evovle image!';

         echo json_encode($result);
         wp_die();
      }
   } else {
      $result['message'] = 'Please login first';

      echo json_encode($result);
      wp_die();
   }
}

add_action('wp_ajax_save_postcard_action', 'save_postcard');
add_action('wp_ajax_nopriv_save_postcard_action', 'save_postcard');

function save_postcard()
{
   if (isset($_POST['to'])) {
      $to = $_POST['to'];
   }
   if (isset($_POST['from'])) {
      $from = $_POST['from'];
   }
   if (isset($_POST['to_email'])) {
      $to_email = $_POST['to_email'];
   }
   if (isset($_POST['from_email'])) {
      $from_email = $_POST['from_email'];
   }
   if (isset($_POST['msg'])) {
      $msg = $_POST['msg'];
   }
   if (isset($_POST['card_image'])) {
      $card_image = $_POST['card_image'];
   }

   $post_id = wp_insert_post(array(
      'post_type' => 'card',
      'post_title' => 'Card title',
      'post_status' => 'publish',
      'post_author' => get_current_user_id()
   ));

   $result = array(
      'status' => 'failed',
      'id' => ''
   );

   if ($post_id) {
      // insert post meta
      add_post_meta($post_id, 'card_image', $card_image);
      add_post_meta($post_id, 'to_name', $to);
      add_post_meta($post_id, 'to_email', $to_email);
      add_post_meta($post_id, 'from_name', $from);
      add_post_meta($post_id, 'from_email', $from_email);
      add_post_meta($post_id, 'message', $msg);

      $data = array(
         'ID' => $post_id,
         'post_title' => 'Card #' . $post_id
      );

      wp_update_post($data);
      $result['id'] = $post_id;
      $result['status'] = 'succeeded';
   }

   echo json_encode($result);

   wp_die();
}

add_action('wp_ajax_get_cardinfo_action', 'get_card_info');
add_action('wp_ajax_nopriv_get_cardinfo_action', 'get_card_info');

function get_card_info()
{
   $result = array(
      'status' => 'failed',
      'card_image' => '',
      'from_name' => '',
      'to_name' => '',
      'message' => '',
   );

   if (isset($_POST['id'])) {
      $post_id   = $_POST['id'];
      $card_image = get_post_meta($post_id, 'card_image');
      $from_name = get_post_meta($post_id, 'from_name');
      $to_name = get_post_meta($post_id, 'to_name');
      $message = get_post_meta($post_id, 'message');

      $result['status'] = 'succeeded';
      $result['card_image'] = $card_image;
      $result['from_name'] = $from_name;
      $result['to_name'] = $to_name;
      $result['message'] = $message;
   }

   echo json_encode($result);

   wp_die();
}

if (function_exists('acf_add_local_field_group')) :

   acf_add_local_field_group(array(
      'key' => 'group_6360cd36773e8',
      'title' => 'Card Field Group',
      'fields' => array(
         array(
            'key' => 'field_6360cd3df683a',
            'label' => 'Card Image',
            'name' => 'card_image',
            'aria-label' => '',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => '',
            ),
            'default_value' => '',
            'placeholder' => 'This is url of card front image generated by Stable Diffusion',
         ),
         array(
            'key' => 'field_6360cdaef683b',
            'label' => 'From Name',
            'name' => 'from_name',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
         ),
         array(
            'key' => 'field_6360cdbcf683c',
            'label' => 'From Email',
            'name' => 'from_email',
            'aria-label' => '',
            'type' => 'email',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
         ),
         array(
            'key' => 'field_6360cdcaf683d',
            'label' => 'To Name',
            'name' => 'to_name',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
         ),
         array(
            'key' => 'field_6360cdd0f683e',
            'label' => 'To email',
            'name' => 'to_email',
            'aria-label' => '',
            'type' => 'email',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
         ),
         array(
            'key' => 'field_6360cdd8f683f',
            'label' => 'Message',
            'name' => 'message',
            'aria-label' => '',
            'type' => 'textarea',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => '',
            'new_lines' => '',
         ),
      ),
      'location' => array(
         array(
            array(
               'param' => 'post_type',
               'operator' => '==',
               'value' => 'card',
            ),
         ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
      'show_in_rest' => false,
   ));

   acf_add_local_field_group(array(
      'key' => 'group_636ce2a7d920c',
      'title' => 'Product Credit Group',
      'fields' => array(
         array(
            'key' => 'field_636ce2a8516bc',
            'label' => 'Credit Amount',
            'name' => 'credit_amount',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => '',
            ),
            'default_value' => 0,
            'min' => '',
            'max' => '',
            'placeholder' => '',
            'step' => '',
            'prepend' => '',
            'append' => '',
         ),
      ),
      'location' => array(
         array(
            array(
               'param' => 'post_type',
               'operator' => '==',
               'value' => 'wpstripeco_product',
            ),
         ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
      'show_in_rest' => 0,
   ));

endif;

add_action('wp_ajax_get_user_credits_action', 'get_user_credits');
add_action('wp_ajax_nopriv_get_user_credits_action', 'get_user_credits');

function get_user_credits()
{
   $user_id = get_current_user_id();
   $credits = get_user_meta($user_id, 'credits');
   echo $credits[0];
   wp_die();
}

function get_user_credits_shorcode($atts)
{
   $user_id = get_current_user_id();
   $credits = get_user_meta($user_id, 'credits');
   echo "You currently have " . $credits[0] . " credits.";
}

add_shortcode('user_credits', 'get_user_credits_shorcode');

add_action('show_user_profile', 'extra_user_profile_fields');
add_action('edit_user_profile', 'extra_user_profile_fields');
function extra_user_profile_fields($user)
{
?>
   <h3><?php _e("Extra profile information", "blank"); ?></h3>

   <table class="form-table">
      <tr>
         <th><label for="credits"><?php _e("credits"); ?></label></th>
         <td>
            <input type="text" name="credits" id="credits" value="<?php echo esc_attr(get_the_author_meta('credits', $user->ID)); ?>" class="regular-text" /><br />
         </td>
      </tr>
   </table>
<?php
}

add_action('personal_options_update', 'save_extra_user_profile_fields');
add_action('edit_user_profile_update', 'save_extra_user_profile_fields');

function save_extra_user_profile_fields($user_id)
{
   if (!current_user_can('edit_user', $user_id)) {
      return false;
   }
   if ($_POST['credits'] == "")
      update_user_meta($user_id, 'credits', 0);
   else
      update_user_meta($user_id, 'credits', $_POST['credits']);
}

add_action('wp_ajax_add_credits_action', 'add_user_credits');
add_action('wp_ajax_nopriv_add_credits_action', 'add_user_credits');

function add_user_credits()
{
   $result = array(
      'status' => 'fail',
      'credits' => '0'
   );
   if ($_POST['credit_product_id']) {
      $product_id = $_POST['credit_product_id'];
      $credit_amounts = get_post_meta($product_id, 'credit_amount');
      $credit_amount = "0";
      if (count($credit_amounts) > 0) {
         $credit_amount = $credit_amounts[0];
      }
      $user_id = get_current_user_id();
      $current_credits = get_user_meta($user_id, 'credits')[0];
      $updated_amount = (int)$credit_amount + (int)$current_credits;
      update_user_meta($user_id, 'credits', $updated_amount);
      $result['status'] = 'success';
      $result['credits'] = $updated_amount;
   }
   echo json_encode($result);
   wp_die();
}
