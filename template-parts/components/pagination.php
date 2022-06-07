<?php
require_once get_template_directory() . '/template-parts/blocks/IBlockTemplate.php';
/**
 * Pagination Block Template.
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
if (!class_exists('PaginationBlockTemplate')) {

    class PaginationBlockTemplate extends DefaultBlockTemplate implements IBlockTemplate
    {
        private $id = false;
        public $name = 'pagination';
        private $args = [];

        function __construct()
        {
            $this->id = $this->generate_id();

            $this->args = [
                'id' => $this->id,
                'class' => $this->name,
                'flex' => 'uk-flex-center'
            ];
        }

        public function get_id() {
            return $this->id;
        }

        public function get_block_args(){}
        public function get_dynamic_args(){}

        public function render()
        {
            /**
             * Render
             */
            ob_start();
            ?>
            <div class="component-wrapper">
                <ul class="uk-pagination <?= $this->args['flex']?> uk-width-expand">
                    <li><a href="#"><span uk-pagination-previous></span></a></li>
                    <li><a href="#">1</a></li>
                    <li class="uk-disabled"><span>...</span></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li class="uk-active"><span>7</span></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#"><span uk-pagination-next></span></a></li>
                </ul>
            </div>

            <?php
            return ob_get_clean();
        }
    }
}

$_pagination = new PaginationBlockTemplate();
echo $_pagination->render();