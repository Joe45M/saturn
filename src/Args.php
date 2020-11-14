<?php


namespace Joem\Saturn;


trait Args
{
    protected function getDefaultArgs() {
        return array(
            'taxonomies'             => [],
            'supports'               => [],
            'namespace'              => '',
            'singular'               => '',
            'plural'                 => '',
            'hierarchical'           => false,
        );
    }
}