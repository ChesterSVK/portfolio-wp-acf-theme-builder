<?php
/**
 * Button Block Template.
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
if (!class_exists('ButtonBlockTemplate')) {

    class ButtonBlockTemplate extends DefaultBlockTemplate implements IBlockTemplate
    {
        private $id = false;
        public $name = 'button';
        private $args = [];

        function __construct($block, $is_preview)
        {
            $this->id = $this->generate_id();
            $this->block = $block;
            $this->is_preview = $is_preview;

            $this->args = [
                'disabled' => false,
                'margin' => 'uk-margin',
                'padding' => 'uk-padding-small',
                'style' => 'uk-button-default',
                'display' => 'inline',
                'width' => 'auto',
                'radius' => 0,
                'text' => 'Button',
                'text_align' => 'uk-text-center',
                'align' => 'uk-align-left',
                'target' => '_self',
                'size' => 'fit-content',
                'link' => '',
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
                return '<button class="uk-button uk-button-default">Button</button>';
                ?>
            <?php }


            /**
             * Render
             */
            ob_start();
            ?>
            <div <?= $this->args['id'] ? 'id="' . $this->args['id'].'"' :''?> class="block-wrapper<?= $this->args['class']?>">
                <<?= (isset($this->args['link']) && $this->args['link']) ? 'a' : 'button' ?>
                class="uk-button <?= $this->args['margin']; ?>  <?= $this->args['padding']; ?>  <?= $this->args['style']; ?> <?= $this->args['text_align'] ?> <?= $this->args['align'] ?>"
                style="border-radius: <?= $this->args['radius'] ?>; display: <?= $this->args['display'] ?>; width: <?= $this->args['width'] ?>"
                <?= ($this->args['disabled']) ? 'disabled' : '' ?>
                <?= isset($this->args['target']) ? ' target="' . $this->args['target'] . '"' : '' ?>
                <?= (isset($this->args['link']) && !$this->is_preview) ? ' href="' . $this->args['link'] . '"' : '' ?>
                >
                <?= $this->args['text'] ?>
                </<?= (isset($this->args['link']) && $this->args['link']) ? 'a' : 'button' ?>>
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
$_block = new ButtonBlockTemplate($block, $is_preview);
$_THEME_BLOCKS[$_block->get_id()] = $_block;
echo $_block->render();


