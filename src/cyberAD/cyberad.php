<?php
/*
  Plugin Name: CybernetAD
  Plugin URI:
  Description: Automatically fixed images and text at the bottom of the post pages using CybernetAD, a cybernet plugin
  Version: 1.0.0
  Author: STAD,Inc
  Author URI: https://github.com/STAD/CybernetAD
  License: GPLv2
 */
function stadnews_addad($contentData) {
    $str = $contentData."<h3><img src='http://stadnews.kinsta.cloud/wp-content/uploads/2021/02/STAD.png'width='50' height='50'>【Presented By STAD https://stad.group/】</h3>";
    return $str;
}
add_filter('the_content','stadnews_addad');
?>
