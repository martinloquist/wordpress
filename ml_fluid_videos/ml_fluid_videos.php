<?php
/*
  _____.__        .__    .___       .__    .___
_/ ____\  |  __ __|__| __| _/ ___  _|__| __| _/____  ____  ______
\   __\|  | |  |  \  |/ __ |  \  \/ /  |/ __ |/ __ \/  _ \/  ___/
 |  |  |  |_|  |  /  / /_/ |   \   /|  / /_/ \  ___(  <_> )___ \
 |__|  |____/____/|__\____ |    \_/ |__\____ |\___  >____/____  >
                          \/                \/    \/          \/
 Plugin Name: ML Fluid Videos
 Plugin URI: http://martinloquist.se/wordpress
 Description: A small plugin that adds a wrapper around embedded objects (<object> and <iframe>) to make them fluid.
 Version: 0.2
 Author: Martin Loquist
 Author URI: http://martinloquist.se/
 */

function ml_add_video_wrapper($content) {
	
	$content = preg_replace( "/<object/Si", "<div class='mlvideowrapper'><object", $content );
	$content = preg_replace( "/<\/object>/Si", "</object></div>", $content );
	
	/** It's been a couple of years. There's iFrames now! */
	$content = preg_replace( "/<iframe.+?src=\"(.+?)\"/Si", "<div class='mlvideowrapper'><iframe src='1' frameborder='0' allowfullscreen>", $content );
	$content = preg_replace( "/<\/iframe>/Si", "</iframe></div>", $content );

	return $content;
}

add_filter( 'the_content', 'ml_add_video_wrapper' );

function ml_add_video_wrapper_init() {
  wp_register_style( 'ml_add_video_wrapper_style', plugins_url('/css/style.css', __FILE__), false, '1.0.0', 'all');
  wp_enqueue_style( 'ml_add_video_wrapper_style' );
}

add_action('init', 'ml_add_video_wrapper_init');
