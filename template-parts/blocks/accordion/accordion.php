<?php
require_once get_template_directory() . '/template-parts/blocks/IBlockTemplate.php';
/**
 * Accordions Block Template.
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
if (!class_exists('AccordionBlockTemplate')) {

    class AccordionBlockTemplate extends DefaultBlockTemplate implements IBlockTemplate
    {
        private $id = false;
        public $name = 'accordion';
        private $args = [];

        function __construct($block, $is_preview)
        {
            $this->id = $this->generate_id();
            $this->block = $block;
            $this->is_preview = $is_preview;

            $this->args = [
                'accordions' => [
                    [
                        'title' => 'Item 1',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                    ],
                    [
                        'title' => 'Item 2',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                    ],
                    [
                        'title' => 'Item 3',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                    ]
                ],
                'opened_index' => 1,
                'allow_multiple' => false,
                'id' => $this->id,
                'class' => $this->name,
            ];

            $this->args = wp_parse_args(
                $this->parse_rendering_context(),
                $this->args);
        }

        public function get_id() {
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
                return '<img style="width: 100%; object-fit: contain;" src="' . THEME_DIR_URI . '/template-parts/blocks/accordion/accordion.gif' . '">';
                ?>
            <?php }


            /**
             * Render
             */
            ob_start();
            ?>
            <div <?= $this->args['id'] ? 'id="' . $this->args['id'].'"' :''?> class="block-wrapper <?= $this->args['class']?>">
                <ul class="uk-accordion"
                    uk-accordion="<?= ($this->args['allow_multiple']) ? 'multiple: true' : '' ?>"
                    uk-scrollspy="target: &#8250; li; cls: uk-animation-fade; delay: 500;"
                >

                    <?php foreach ($this->args['accordions'] as $index => $accordion) { ?>
                        <li class="<?= ($this->args['opened_index'] && (intval($this->args['opened_index']) - 1) == $index) ? 'uk-open' : '' ?>">
                            <a class="uk-accordion-title" href="#" title="<?= $accordion['title']; ?>"
                               target="_self"><?= $accordion['title']; ?></a>
                            <div class="uk-accordion-content">
                                <p>
                                    <?= $accordion['content']; ?>
                                </p>
                            </div>
                        </li>
                    <?php } ?>

                </ul>
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
$_block = new AccordionBlockTemplate($block, $is_preview);
$_THEME_BLOCKS[$_block->get_id()] = $_block;
echo $_block->render();