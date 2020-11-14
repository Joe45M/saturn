<?php

namespace Joem\Saturn;

class Saturn extends SaturnQuery
{
    use Args;

    protected $slug;
    protected $args;
    protected $instance;
    protected $query;

    public function __construct(Array $config)
    {
        $this->setArgs($config);
        $this->createFromArgs();
    }

    public function add($atts) {

    }

    /**
     * Boot the post type.
     *
     * This effectively wraps the common register_post_type method which already exists in WordPress.
     *
     * Once registered, assign the post type to $this->instance - which is used throughout the class to manipulate
     * the post type and the posts associated.
     *
     * @param array $config Array of key-value pairs which are to be used inside of the labels & args, which are used
     *                      used when the post type is registered.
     * @return $this
     * @since 0.0.1
     */
    public function createFromArgs( $config = [] ) {

        if( $config ) $this->setArgs( $config );

        $args = $this->getArgs();

        $labels = array(
            'name'                => _x( $args['plural'], 'Post Type General Name', $args['namespace'] ),
            'singular_name'       => _x( $args['singular'], 'Post Type Singular Name', $args['namespace'] ),
            'menu_name'           => __( $args['plural'], $args['namespace'] ),
            'parent_item_colon'   => __( 'Parent ' . $args['singular'], $args['namespace'] ),
            'all_items'           => __( 'All ' . $args['plural'], $args['namespace'] ),
            'view_item'           => __( 'View ' . $args['singular'], $args['namespace'] ),
            'add_new_item'        => __( 'Add New ' . $args['singular'], $args['namespace'] ),
            'add_new'             => __( 'Add New', $args['namespace'] ),
            'edit_item'           => __( 'Edit ' . $args['singular'], $args['namespace'] ),
            'update_item'         => __( 'Update ' . $args['singular'], $args['namespace'] ),
            'search_items'        => __( 'Search ' . $args['singular'], $args['namespace'] ),
            'not_found'           => __( 'Not Found', $args['namespace'] ),
            'not_found_in_trash'  => __( 'Not found in Trash', $args['namespace'] ),
        );

        $cpt_args = array(
            'label'               => __( $args['singular'], $args['namespace'] ),
            'description'         => __( '', $args['namespace'] ),
            'labels'              => $labels,
            'supports'            => $args['supports'],
            'taxonomies'          => $args['taxonomies'],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,

        );

        $created_type = register_post_type( $args['slug'], $cpt_args );
        $this->setInstance($created_type);

        return $this;
    }

    /**
     * We refer to each post type as an instance. Therefore, when we return an instance, we return the slug for the
     * post type, which is set in $this->createFromArgs.
     * @return mixed
     */
    public function instance () {
        return $this->getInstance();
    }

    /**
     * @return mixed
     */
    protected function getArgs()
    {
        return $this->args;
    }

    /**
     * @param mixed $args
     */
    protected function setArgs($args)
    {
        $default_args = $this->getDefaultArgs();

        $this->args = array_merge($default_args, $args);
    }

    /**
     * @return mixed
     */
    protected function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param mixed $instance
     */
    protected function setInstance($instance)
    {
        $this->instance = $instance;
    }
}