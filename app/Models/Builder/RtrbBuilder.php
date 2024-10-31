<?php

namespace RadiusTheme\RB\Models\Builder;

class RtrbBuilder extends BuilderCompatibility {
	public function render_content() {

		$cur_post = get_post( $this->post_id, OBJECT );
		echo apply_filters( 'the_content', wp_kses_post( $cur_post->post_content ) );
	}
}