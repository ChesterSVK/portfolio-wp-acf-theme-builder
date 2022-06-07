<?php

/**
 * Container Block Template.
 *
 *
 * This template is used for Guttenberg builder as well as acf Dynamic render field
 * Guttenberg Block setup is in {template-slug}-block.php file
 * ACF Dynamic field setup is in {template-slug}-dynamic.php file
 *
 * @param array $block The block settings and attributes from Guttenberg.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

require_once get_template_directory() . '/template-parts/blocks/IBlockTemplate.php';

//Avoid class redeclare in multiple template use
if (!class_exists('ContainerBlockTemplate')) {
    class ContainerBlockTemplate extends DefaultBlockTemplate implements IBlockTemplate
    {
        private $id = false;
        public $name = 'container';
        private $args = [];

        function __construct($block, $is_preview)
        {
            $this->id = $this->generate_id();
            $this->block = $block;
            $this->is_preview = $is_preview;

            $this->args = [
                'id' => $this->id,
                'class' => $this->name,
                'size' => 'uk-container-xsmall',
                'columns_count' => 1,
//                'columns' => [],
                'padding' => 'uk-padding-small',
            ];

            $this->args = wp_parse_args(
                $this->parse_rendering_context(),
                $this->args);


            wp_register_script(
                'gutenberg-examples-dynamic',
                THEME_TEMPLATES_DIR_URI .  '/blocks/container/container.js',
                [],
                false,
                true);
        }


        // Methods
        public function get_id()
        {
            return $this->id;
        }

        public function get_args()
        {
            return $this->args;
        }

        public function set_args($args)
        {
            $this->args = $args;
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

            // Create class attribute allowing for custom "className" and "align" values.
            $class = $this->args['class'];
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
                ob_start();
                //Todo BG here
                ?>
                <img style="display:block; width:300px; height: 300px; object-fit: contain; margin: 0 auto;"
                     src="<?= THEME_TEMPLATES_DIR_URI . '/blocks/' . $this->name . '/' . $this->name . '.jpg'; ?>">
                <?php
                return ob_get_clean();

            }

            /**
             * Render
             */
            ob_start();
            //Todo BG here
            ?>
            <div <?= $this->args['id'] ? 'id="' . $this->args['id'].'"' :''?> class="block-wrapper <?= $this->args['class']?>">
                <div class="container-wrapper">
                    <div class="uk-container <?= $this->args['size'] ?> <?= $this->args['padding'] ?>">
                        <div class="uk-columns-wrapper uk-column-1-<?= $this->args['columns_count'] ?>">
                            <?php
                            for ($i = 0 ; $i < $this->args['columns_count']; $i++) {
                                ?>
                                <div class="uk-column">
                                    Column
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
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
$_block = new ContainerBlockTemplate($block, $is_preview);
$_THEME_BLOCKS[$_block->get_id()] = $_block;
echo $_block->render();
?>