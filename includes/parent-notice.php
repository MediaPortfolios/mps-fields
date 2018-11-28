<?php
/**
 * Admin notice that this plugin needs its parent plugin.
 *
 * @package    Media_Portfolios_Fields
 * @subpackage Includes
 *
 * @since      5.7.7
 * @author     Media Portfolios <dev@mediaportfolios.com>
 */

namespace Media_Portfolios_Fields\Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} ?>
<div class="notice notice-error">
	<?php
	echo sprintf(
		'<p>%1s</p>',
		esc_html__( 'Media Portfolios Fields needs the Media Portfolios Base to be installed and activated.', 'mps-text' )
	); ?>
</div>