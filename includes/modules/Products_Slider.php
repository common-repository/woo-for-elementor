<?php
namespace WFE\Modules;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use WFE\Base\Base_Widget;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Woocommerce products widget.
 *
 * Display Woocommerce products.
 *
 * @since 1.0.0
 */
class Products_Slider extends Base_Widget {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wfe_products_slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'WFE: Products Slider', 'woocommerce-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Woocommerce Products widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-woocommerce';
	}

	public function get_script_depends() {
		return [ 'wfe-frontend-scripts', 'jquery-slick' ];
	}

	/**
	 * Register Woocommerce products widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider Options', 'pd-framework' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'pd-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'pd-framework' ),
					'arrows' => __( 'Arrows', 'pd-framework' ),
					'dots' => __( 'Dots', 'pd-framework' ),
					'none' => __( 'None', 'pd-framework' ),
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'pd-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'pd-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'slides_to_show',
			[
				'label' => __( 'Slides To Show', 'pd-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
			]
		);

		$this->add_control(
			'slides_to_scroll',
			[
				'label' => __( 'Slides To Scroll', 'pd-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'pd-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'pd-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'transition',
			[
				'label' => __( 'Transition', 'pd-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'pd-framework' ),
					'fade' => __( 'Fade', 'pd-framework' ),
				],
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label' => __( 'Transition Speed (ms)', 'pd-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label' => __( 'Content Animation', 'pd-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					'' => __( 'None', 'pd-framework' ),
					'fadeInDown' => __( 'Down', 'pd-framework' ),
					'fadeInUp' => __( 'Up', 'pd-framework' ),
					'fadeInRight' => __( 'Right', 'pd-framework' ),
					'fadeInLeft' => __( 'Left', 'pd-framework' ),
					'zoomIn' => __( 'Zoom', 'pd-framework' ),
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Tab Style.
		 */
		$this->start_controls_section(
			'section_products_slider_layout_style',
			[
				'label' => __( 'Layout', 'woocommerce-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/**
		 * Layout Tabs Background.
		 */
		$this->start_controls_tabs( 'section_products_slider_layout_tabs_background' );

		$this->start_controls_tab(
			'section_products_slider_layout_tab_background_normal',
			[
				'label' => __( 'Normal', 'woocommerce-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'section_products_slider_layout_background',
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'section_products_slider_layout_tab_background_hover',
			[
				'label' => __( 'Hover', 'woocommerce-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'section_products_slider_layout_background_hover',
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item:hover',
			]
		);

		$this->add_control(
			'section_products_slider_layout_background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.25,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item' => 'transition: all {{SIZE}}s ease-in-out;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		// End Layout Background.

		$this->add_responsive_control(
			'layout_vertical_padding',
			[
				'label' => __( 'Vertical Padding', 'woocommerce-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'layout_horizontal_padding',
			[
				'label' => __( 'Horizontal Padding', 'woocommerce-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider' => 'margin-left: -{{SIZE}}{{UNIT}};margin-right: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'layout_content_padding',
			[
				'label' => __( 'Content Padding', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_border_style',
			[
				'label' => __( 'Border', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'layout_border_width',
			[
				'label' => __( 'Border Width', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'layout_border_style',
			[
				'label'     => __( 'Border Style', 'woocommerce-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'solid'  => esc_html__( 'Solid', 'woocommerce-for-elementor' ),
					'dashed' => esc_html__( 'Dashed', 'woocommerce-for-elementor' ),
					'dotted' => esc_html__( 'Dotted', 'woocommerce-for-elementor' ),
					'double' => esc_html__( 'Double', 'woocommerce-for-elementor' ),
					'groove' => esc_html__( 'Groove', 'woocommerce-for-elementor' ),
					'inset'  => esc_html__( 'Inset', 'woocommerce-for-elementor' ),
					'outset' => esc_html__( 'Outset', 'woocommerce-for-elementor' ),
					'ridge'  => esc_html__( 'Ridge', 'woocommerce-for-elementor' ),
				),
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item' => 'border-style: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_responsive_control(
			'layout_border_color',
			[
				'label' => __( 'Border Color', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'layout_border_radius',
			[
				'label' => __( 'Border Radius', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_products_slider_header_style',
			[
				'label' => __( 'Header', 'woocommerce-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_sale_flash_style',
			[
				'label' => __( 'Sale Flash', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		/**
		 * Sale Flash Tabs Background.
		 */
		$this->start_controls_tabs( 'header_sale_flash_tabs_background' );

		$this->start_controls_tab(
			'header_sale_flash_tab_background_normal',
			[
				'label' => __( 'Normal', 'woocommerce-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_sale_flash_background',
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'header_sale_flash_tab_background_hover',
			[
				'label' => __( 'Hover', 'woocommerce-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_sale_flash_background_hover',
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item:hover .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale',
			]
		);

		$this->add_control(
			'header_sale_flash_background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.25,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'transition: all {{SIZE}}s ease-in-out;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		// End Sale Flash Background.

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'header_sale_flash_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale',
			]
		);

		$this->add_responsive_control(
			'header_sale_flash_color',
			[
				'label'     => __( 'Color', 'woocommerce-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'header_sale_flash_width',
			[
				'label' => __( 'Width', 'woocommerce-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_sale_flash_height',
			[
				'label' => __( 'Height', 'woocommerce-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_sale_flash_border_radius',
			[
				'label' => __( 'Border Radius', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_sale_flash_position_top',
			[
				'label' => __( 'Top', 'woocommerce-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_sale_flash_position_right',
			[
				'label' => __( 'Right', 'woocommerce-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_sale_flash_position_bottom',
			[
				'label' => __( 'Bottom', 'woocommerce-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_sale_flash_position_left',
			[
				'label' => __( 'Left', 'woocommerce-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-header .wfe-product-item__thumbnail .onsale' => 'left: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_products_slider_footer_style',
			[
				'label' => __( 'Footer', 'woocommerce-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'footer_align',
			[
				'label' => __( 'Alignment', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'woocommerce-for-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'woocommerce-for-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'woocommerce-for-elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'woocommerce-for-elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'footer_title_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__title',
			]
		);

		/**
		 * Start Footer Title Tabs Background.
		 */
		$this->start_controls_tabs( 'footer_title_tabs_title' );

		$this->start_controls_tab(
			'footer_title_tab_title_normal',
			[
				'label' => __( 'Normal', 'woocommerce-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'footer_title_color',
			[
				'label'     => __( 'Color', 'woocommerce-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'footer_title_tab_title_hover',
			[
				'label' => __( 'Hover', 'woocommerce-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'footer_title_color_hover',
			[
				'label'     => __( 'Color', 'woocommerce-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item:hover .wfe-product-item__entry-footer .wfe-product-item__title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		// End Footer Title Background.

		$this->add_control(
			'heading_regular_price_style',
			[
				'label' => __( 'Regular Price', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'footer_regular_price_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__price .price ins',
			]
		);

		$this->add_responsive_control(
			'footer_regular_price_color',
			[
				'label'     => __( 'Regular Price Color', 'woocommerce-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__price .price ins' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_sale_price_style',
			[
				'label' => __( 'Sale Price', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'footer_sale_price_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__price .price del',
			]
		);

		$this->add_responsive_control(
			'footer_sale_price_color',
			[
				'label'     => __( 'Sale Price Color', 'woocommerce-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__price .price del' => 'color: {{VALUE}}',
				],
			]
		);

		/**
		 * Add To Cart
		 */
		$this->add_control(
			'heading_add_to_cart_style',
			[
				'label' => __( 'Add To Cart', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'add_to_cart_align',
			[
				'label' => __( 'Alignment', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'woocommerce-for-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'woocommerce-for-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'woocommerce-for-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__add-to-cart' => 'justify-content: {{VALUE}};',
				],
			]
		);

		/**
		 * Add To Cart Tabs Background.
		 */
		$this->start_controls_tabs( 'add_to_cart_tabs_background' );

		$this->start_controls_tab(
			'add_to_cart_tab_background_normal',
			[
				'label' => __( 'Normal', 'woocommerce-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'add_to_cart_background',
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__add-to-cart > a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'add_to_cart_tab_background_hover',
			[
				'label' => __( 'Hover', 'woocommerce-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'add_to_cart_background_hover',
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item:hover .wfe-product-item__entry-footer .wfe-product-item__add-to-cart > a',
			]
		);

		$this->add_control(
			'add_to_cart_background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.25,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__add-to-cart > a' => 'transition: all {{SIZE}}s ease-in-out;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		// End Add To Cart Background.

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'header_add_to_cart_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__add-to-cart > a',
			]
		);

		$this->add_responsive_control(
			'add_to_cart_color',
			[
				'label'     => __( 'Color', 'woocommerce-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__add-to-cart > a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'add_to_cart_padding',
			[
				'label' => __( 'Padding', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__add-to-cart > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'add_to_cart_margin',
			[
				'label' => __( 'Margin', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__add-to-cart > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'add_to_cart_border_radius',
			[
				'label' => __( 'Border Radius', 'woocommerce-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wfe-products-slider .wfe-product-item-wrap .wfe-product-item .wfe-product-item__entry-footer .wfe-product-item__add-to-cart > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Woocommerce products widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();

		$number  = $settings['number'];

		$is_rtl      = is_rtl();
		$direction   = $is_rtl ? 'rtl' : 'ltr';
		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$slick_options = [
			'slidesToShow'   => absint( $settings['slides_to_show'] ),
			'slidesToScroll' => absint( $settings['slides_to_scroll'] ),
			'autoplaySpeed'  => absint( $settings['autoplay_speed'] ),
			'autoplay'       => ( 'yes' === $settings['autoplay'] ),
			'infinite'       => ( 'yes' === $settings['infinite'] ),
			'pauseOnHover'   => ( 'yes' === $settings['pause_on_hover'] ),
			'speed'          => absint( $settings['transition_speed'] ),
			'arrows'         => $show_arrows,
			'dots'           => $show_dots,
			'rtl'            => $is_rtl,
			'dotsClass'      => 'wfe-slick-dots',
			// 'prevArrow'     => '<img src="' . $settings['prev_arrow'] . '" />',
			// 'nextArrow'     => '<img src="' . $settings['next_arrow'] . '" />',
			// 'prevArrow'     => '<div class="pdvn-slick-prev"></div>',
			// 'nextArrow'     => '<div class="pdvn-slick-next"></div>',
		];

		if ( 'fade' === $settings['transition'] ) {
			$slick_options['fade'] = true;
		}

		$rand = wp_rand( 10000, 100000 );

		$slider_id      = [ 'wfe-products-slider-' . $rand ];
		$slider_classes = [ 'wfe-products-slider', 'js-slick-slider' ];

		$this->add_render_attribute( 'slider', [
			'id'                               => $slider_id,
			'class'                            => $slider_classes,
			'data-wfe-products-slider_options' => wp_json_encode( $slick_options ),
			'data-animation'                   => $settings['content_animation'],
		] );

		$li_class = 'wfe-product-item-wrap';
		$this->add_render_attribute( $li_class, 'class', [ 'wfe-product-item-wrap' ] );

		$products_args = array(
			'post_type'           => 'product',
			'posts_per_page'      => $number,
			'ignore_sticky_posts' => 1,
		);

		$products_query = new \WP_Query( $products_args );
		?>
		<?php if ( $products_query->have_posts() ) : ?>
		<ul <?php echo $this->get_render_attribute_string( 'slider' ); ?> dir="<?php echo esc_attr( $direction ); ?>">
			<?php while ( $products_query->have_posts() ) : $products_query->the_post(); ?>
				<?php wfe_get_template( 'content-product.php', [ 'li_class' => $this->get_render_attribute_string( $li_class ) ] ); ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
		<?php endif; ?>
		<?php
	}

	/**
	 * Render Woocommerce products widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {}
}
