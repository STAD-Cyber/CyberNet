<?php
/*
  Plugin Name: CybernetCAT
  Plugin URI:
  Description: Set up post categories separated by commas using CybernetCAT, a cybernet plugin
  Version: 1.0.0
  Author: STAD,Inc
  Author URI: https://github.com/STAD/CybernetCAT
  License: GPLv2
 */

add_action('admin_menu', 'rfr_CategoryCreatorMenu');

function rfr_CategoryCreatorMenu()
{

    add_menu_page('Bulk Category Creator Plugin','一括カテ登録','administrator', __FILE__, 'rfr_CategorySettingsPage' , 'dashicons-admin-plugins');

    add_action('admin_init', 'rfr_RegisterPluginSettings');

}


function rfr_RegisterPluginSettings() {
    //register our settings

    register_setting( 'rfr-bulk-category-creator-group', 'options_textarea' );

    rfr_CreateCategories();

}

function rfr_CreateCategories()
{

        $returnedStr = esc_attr($_POST['options_textarea'] );

        $trimmed = trim($returnedStr);

        $categories_array = explode(',',$trimmed);

    foreach ($categories_array as $key => $value)
    {

        $catString = $value.'';

        $term = term_exists($value,'category');
        if($term==0 || $term==null)
        {
            create_category($value);

        }

    }

}

function create_category($value)
{
    $trimmedValue = trim($value);
    $hyphenatedValue = str_replace(" ", "-", $trimmedValue);

    wp_insert_term(
        $trimmedValue,
        'category',
        array(
            'description' => $trimmedValue,
            'slug'=> $hyphenatedValue
            )
        );

}

function rfr_CategorySettingsPage() {
?>
<div class="wrap">
<h1>カンマ区切り複数カテゴリー登録</h1>

<form method='post'><input type='hidden' name='form-name' value='form 1' />
    <?php settings_fields( 'rfr-bulk-category-creator-group' ); ?>
    <?php do_settings_sections( 'rfr-bulk-category-creator-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">右のボックスへ複数カテゴリーをカンマ区切りで入力し下の一括カテ登録ボタンを押すと複数カテゴリーが一括登録できます！</th>
        <td>
        <textarea cols="50" rows="8" name="options_textarea"></textarea>
        </td>
        </tr>
    </table>

    <?php submit_button('一括カテ登録'); ?>

</form>

<?php } ?>
