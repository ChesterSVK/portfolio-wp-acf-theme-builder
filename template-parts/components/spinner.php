<?php
require_once get_template_directory() . '/template-parts/blocks/IBlockTemplate.php';
/**
 * Spinner Block Template.
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
if (!class_exists('SpinnerBlockTemplate')) {

    class SpinnerBlockTemplate extends DefaultBlockTemplate implements IBlockTemplate
    {
        private $id = false;
        public $name = 'uk-spinner';
        private $args = [];

        function __construct()
        {
            $this->id = 'uk-spinner';

            $this->args = [
                'id' => $this->id,
                'spinner_background_color' => '#000000',
                'spinner_ratio' => '1',
                'spinner_color' => '#ccc',
                'spinner_timeout' => '500'
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
        }

        public function get_dynamic_args()
        {
            return theme_get_block_args('options', $this->args);
        }

        public function render()
        {
            /**
             * Render
             */
            ob_start();
            ?>
            <!--BEGIN PAGE SPINNER -->
            <div class="component-wrapper">
                <div id="<?= $this->args['id']; ?>"
                     data-timeout="<?= $this->args['spinner_timeout']?>"
                     style="background-color: <?= $this->args['spinner_background_color'] ?>;
                             position: fixed;
                             left: 0;
                             right: 0;
                             top: 0;
                             bottom: 0;
                             z-index: 1000000;
                             text-align: center;
                             display: flex;
                             flex-direction: column;
                             flex-wrap: wrap;
                             justify-content: center;
                             ">
                    <div uk-spinner="ratio: <?= $this->args['spinner_ratio'] ?>" style="color: <?= $this->args['spinner_color']?>"></div>
                </div>
            </div>
            <!--END PAGE SPINNER -->

            <?php
            return ob_get_clean();
        }
    }
}

if (get_field('allow_spinner', 'options')) {
    $_spinner = new SpinnerBlockTemplate();
    echo $_spinner->render();
}
