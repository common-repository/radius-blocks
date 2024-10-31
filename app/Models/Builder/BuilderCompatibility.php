<?php

namespace RadiusTheme\RB\Models\Builder;


abstract class BuilderCompatibility {

	protected $post_id = 0;

	public function __construct( $post_id ) {
		$this->post_id = $post_id;
	}

	/**
	 * post Render content.
	 */
	public function render_content() {
	}

	public function enqueue_scripts() {
	}

}