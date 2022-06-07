<?php
/**
 * Slider Block Template.
 *
 *
 * This template is used for Guttenberg builder as well as acf Dynamic render field
 * Guttenberg Block setup is in {template-slug}-block.php file
 * ACF Dynamic field setup is in {template-slug}-dynamic.php file
 *
 * Flow
 * 1. Default variables - current file
 * 2. Decision point
 * 3. Overriding varaibles based on builder
 * 4. Rendering
 *
 * @param array $block The block settings and attributes from Guttenberg.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

require_once get_template_directory() . '/template-parts/blocks/IBlockTemplate.php';
//Avoid class redeclare in multiple template use
if (!class_exists('SliderBlockTemplate')) {

    class SliderBlockTemplate extends DefaultBlockTemplate implements IBlockTemplate
    {
        private $id = false;
        public $name = 'slider';
        private $args = [];

        function __construct($block, $is_preview)
        {
            $this->id = $this->generate_id();
            $this->block = $block;
            $this->is_preview = $is_preview;

            $this->args = [
                'id' => $this->id,
                'class' => ''
            ];

            $this->args = wp_parse_args(
                $this->parse_rendering_context(),
                $this->args);
        }

        public function get_id()
        {
            return $this->id;
        }

        public function get_block_args()
        {

            $id = '';
            if (!empty($block['id'])) {
                // Load values and assign defaults.
                $id = get_field('id') ?: $this->name . '-' . $block['id'];
            }

            // Create id attribute allowing for custom "anchor" value.
            if (!empty($block['anchor'])) {
                $id = $block['anchor'];
            }

            $class = $this->args['class'];
            // Create class attribute allowing for custom "className" and "align" values.
            if (!empty($block['className'])) {
                $class .= ' ' . $block['className'];
            }

            $args = theme_get_block_args('block', $this->args);
            $args['id'] = get_field('id') ?: $id;
            $args['class'] = $class;


            return $args;

        }

        public function get_dynamic_args()
        {
            return theme_get_block_args('dynamic', $this->args);
        }

        public function render()
        {

            /**
             * Ajax Preview
             */

            if ($this->is_preview()) {
                return 'Slider preview todo';
                ?>
            <?php }


            /**
             * Render
             */
            ob_start();
            ?>
            <div class="block-wrapper">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                     uk-slider="center: true; autoplay: true">

                    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid">
                        <li>
                            <div class="uk-panel">
                                <img src="images/slider1.jpg" width="400" height="600" alt="">
                                <div class="uk-position-center uk-panel"><h1>1</h1></div>
                            </div>
                        </li>
                    </ul>


                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
                       uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
                       uk-slider-item="next"></a>

                </div>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
            </div>
            <?php
            return ob_get_clean();
        }
    }
}


global $_THEME_BLOCKS;

if (!isset($block)) {
    $block = false;
}
if (!isset($is_preview)) {
    $is_preview = false;
}
$_block = new SliderBlockTemplate($block, $is_preview);
$_THEME_BLOCKS[$_block->get_id()] = $_block;
echo $_block->render();


