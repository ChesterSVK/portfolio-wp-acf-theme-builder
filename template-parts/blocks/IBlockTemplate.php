<?php

/**
 * Default Block Template Class
 *
 *
 */

interface IBlockTemplate{
    // Methods
    public function get_id();
    public function get_args();
    public function set_args($args);
    public function render();
    public function get_block_args();
    public function get_dynamic_args();
}

abstract class DefaultBlockTemplate implements IBlockTemplate {
    // Properties
    public $name;
    private $args;
    protected $block = false;
    protected $is_preview = false;

    protected function generate_id() {
        return $this->name . '-' . uniqid();
    }

    protected function is_preview(){
        return $this->block && isset($this->block['data']) && !empty($this->block['data']['_is_preview']);
    }
    protected function parse_rendering_context(){
        /**
         * Decision point
         */

        //For Guttenberg Preview
        if (!empty($this->block)) {
            return $this->get_block_args();
        } //For AcF Builder preview
        elseif (isset($this->is_preview)) {
            return $this->get_dynamic_args();
        } //For rendering acf in the FE template files
        else {
            return $this->get_dynamic_args();
        }
    }

    // Methods
    public function get_args() {
        return $this->args;
    }
    public function set_args($args) {
        $this->args = $args;
    }
    public function render() {
        return 'No rendering template';
    }
}