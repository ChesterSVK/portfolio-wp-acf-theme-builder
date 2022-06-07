<?php
require_once get_template_directory() . '/template-parts/blocks/IBlockTemplate.php';
/**
 * ToTop Block Template.
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
//Avoid class redeclare in multiple template use
if (!class_exists('ToTopBlockTemplate')) {

    class ToTopBlockTemplate extends DefaultBlockTemplate implements IBlockTemplate
    {
        private $id = false;
        public $name = 'totop';
        private $args = [];

        function __construct()
        {
            $this->id = 'uk-totop';

            $this->args = [
                'id' => $this->id,
                'scroll_top_background_color' => '#000000',
                'scroll_top_color' => '#ffffff',
            ];

            $this->args = wp_parse_args(
                $this->parse_rendering_context(),
                $this->args);
        }

        public function get_id() {
            return $this->id;
        }

        public function get_block_args(){}
        public function get_dynamic_args(){
            return theme_get_block_args('options', $this->args);
        }

        public function render()
        {
            /**
             * Render
             */
            ob_start();
            ?>
            <div class="component-wrapper">
                <a id="<?= $this->args['id']; ?>"
                   class="uk-padding-small uk-position-bottom-right uk-position-fixed uk-margin uk-margin-right"
                   href="#" uk-totop uk-scroll
                   style="background-color: <?= $this->args['scroll_top_background_color']?>;
                       color: <?= $this->args['scroll_top_color']?>;
                       display: none;">
                </a>
            </div>

            <?php
            return ob_get_clean();
        }
    }
}

if (get_field('allow_scroll_top', 'options')){
    $_ToTop = new ToTopBlockTemplate();
    echo $_ToTop->render();
}
