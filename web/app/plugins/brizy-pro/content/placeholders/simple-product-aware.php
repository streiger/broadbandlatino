<?php

use BrizyPlaceholders\ContentPlaceholder;
use BrizyPlaceholders\ContextInterface;

class BrizyPro_Content_Placeholders_SimpleProductAware extends Brizy_Content_Placeholders_Simple {

    /**
     * @param ContextInterface $context
     * @param ContentPlaceholder $contentPlaceholder
     * @return false|mixed|string
     */
    public function getValue( ContextInterface $context, ContentPlaceholder $contentPlaceholder )  {

		global $product;

		if ( ! $product || ! is_a( $product, Wc_Product::class ) ) {
			return '';
		}

		add_action( 'woocommerce_locate_template', [ $this, 'woocommerce_locate_template' ], 9999, 3 );

		ob_start(); ob_clean();
		parent::getValue( $context, $contentPlaceholder );
		$html = ob_get_clean();

		remove_action( 'woocommerce_locate_template', [ $this, 'woocommerce_locate_template' ], 9999 );

		return $html;
	}

	public function woocommerce_locate_template( $template, $template_name, $template_path ) {

		$default = WC()->plugin_path() . '/templates/' . $template_name;

		return file_exists( $default ) ? $default : $template;
	}
}