<?php
/**
 * Video Block Template.
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
if (!class_exists('VideoBlockTemplate')) {

    class VideoBlockTemplate extends DefaultBlockTemplate implements IBlockTemplate
    {
        private $id = false;
        public $name = 'video';
        private $args = [];

        function __construct($block, $is_preview)
        {
            $this->id = $this->generate_id();
            $this->block = $block;
            $this->is_preview = $is_preview;

            $this->args = [
                'id' => $this->id,
                'class' => '',
                'video_url' => '',
                'video_automute' => false,
                'video_autoplay' => false,
                'video_mute' => false,
                'video_loop' => false,
                'video_controls' => false,
                'video_poster' => false,
                'video_width' => 1800,
                'video_height' => 1080,
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
                return '<video src="https://yootheme.com/site/images/media/yootheme-pro.mp4" width="180" height="120" loop muted playsinline uk-video="autoplay: inview"></video>';
                ?>
            <?php }


            /**
             * Render
             */
            ob_start();
            ?>
            <div class="block-wrapper">
                <video src="<?= $this->args['video_url']; ?>"
                       width="<?= $this->args['video_width']; ?>"
                       height="<?= $this->args['video_height']; ?>"
                    <?= $this->args['video_loop'] ? 'loop' : ''; ?>
                    <?= $this->args['video_automute'] ? 'muted' : ''; ?>
                    <?= $this->args['video_controls'] ? 'controls' : ''; ?>
                    <?= $this->args['video_poster'] ? 'poster="' . $this->args['video_poster'] . '"' : ''; ?>
                       playsinline
                       uk-video="<?= $this->args['video_autoplay'] ? 'autoplay: inview' : ''; ?>;<?= $this->args['video_automute'] ? 'automute: true' :''; ?>">

                </video>
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
$_block = new VideoBlockTemplate($block, $is_preview);
$_THEME_BLOCKS[$_block->get_id()] = $_block;
echo $_block->render();


