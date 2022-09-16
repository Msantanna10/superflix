<?php
################### OPTIONS PAGE TO MAP PAGE IDS
add_action('admin_menu', 'super_options_page_menu');
function super_options_page_menu() {
    add_menu_page('Options', 'Options', 'administrator', 'super_options', 'super_options_page_cb', 'dashicons-admin-site-alt3', 4);
}

add_action( 'admin_init', 'super_options_page_settings' );
function super_options_page_settings() {
  register_setting( 'super_options_page_settings_group', 'options_page_movies' );
  register_setting( 'super_options_page_settings_group', 'options_page_people' );
  register_setting( 'super_options_page_settings_group', 'options_page_login' );
  register_setting( 'super_options_page_settings_group', 'options_page_register' );
  register_setting( 'super_options_page_settings_group', 'options_page_favorites' );
}

function super_options_page_cb(){ 
  
$loopPages = get_pages();

?>
    <div class="wrap">
        <h2>Custom options</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'super_options_page_settings_group' ); ?>
            <?php do_settings_sections( 'super_options_page_settings_group' ); ?>
            <table class="form-table">
                <tr valign="top">
                  <th scope="row">Movies page</th>
                  <td>
                    <?php
                    $loginId = esc_attr( get_option('options_page_movies') );
                    ?>
                    <select name="options_page_movies" style="width: 100%;max-width: 250px;">
                      <?php foreach($loopPages as $page) { ?>
                        <option value="<?php echo $page->ID; ?>" <?php if($loginId == $page->ID) { echo 'selected'; } ?>><?php echo $page->post_title; ?></option>
                      <?php } ?>
                    </select>
                    <br>                    
                    <span class="description" style="font-style: italic;margin-top: 5px;display: block;">Select one option from the list</span>
                  </td>                
                </tr>
                <tr valign="top">
                  <th scope="row">People page</th>
                  <td>
                    <?php
                    $loginId = esc_attr( get_option('options_page_people') );
                    ?>
                    <select name="options_page_people" style="width: 100%;max-width: 250px;">
                      <?php foreach($loopPages as $page) { ?>
                        <option value="<?php echo $page->ID; ?>" <?php if($loginId == $page->ID) { echo 'selected'; } ?>><?php echo $page->post_title; ?></option>
                      <?php } ?>
                    </select>
                    <br>                    
                    <span class="description" style="font-style: italic;margin-top: 5px;display: block;">Select one option from the list</span>
                  </td>                
                </tr>
                <tr valign="top">
                  <th scope="row">Login page</th>
                  <td>
                    <?php
                    $loginId = esc_attr( get_option('options_page_login') );
                    ?>
                    <select name="options_page_login" style="width: 100%;max-width: 250px;">
                      <?php foreach($loopPages as $page) { ?>
                        <option value="<?php echo $page->ID; ?>" <?php if($loginId == $page->ID) { echo 'selected'; } ?>><?php echo $page->post_title; ?></option>
                      <?php } ?>
                    </select>
                    <br>                    
                    <span class="description" style="font-style: italic;margin-top: 5px;display: block;">Select one option from the list</span>
                  </td>                
                </tr>
                <tr valign="top">
                  <th scope="row">Register page</th>
                  <td>
                    <?php
                    $loginId = esc_attr( get_option('options_page_register') );
                    ?>
                    <select name="options_page_register" style="width: 100%;max-width: 250px;">
                      <?php foreach($loopPages as $page) { ?>
                        <option value="<?php echo $page->ID; ?>" <?php if($loginId == $page->ID) { echo 'selected'; } ?>><?php echo $page->post_title; ?></option>
                      <?php } ?>
                    </select>
                    <br>                    
                    <span class="description" style="font-style: italic;margin-top: 5px;display: block;">Select one option from the list</span>
                  </td>                
                </tr>
                <tr valign="top">
                  <th scope="row">Favorites page</th>
                  <td>
                    <?php
                    $loginId = esc_attr( get_option('options_page_favorites') );
                    ?>
                    <select name="options_page_favorites" style="width: 100%;max-width: 250px;">
                      <?php foreach($loopPages as $page) { ?>
                        <option value="<?php echo $page->ID; ?>" <?php if($loginId == $page->ID) { echo 'selected'; } ?>><?php echo $page->post_title; ?></option>
                      <?php } ?>
                    </select>
                    <br>                    
                    <span class="description" style="font-style: italic;margin-top: 5px;display: block;">Select one option from the list</span>
                  </td>                
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php } ?>