<?php


namespace Joem\Saturn;


class SaturnQuery
{
    protected $queryArgs;

    /**
     * Reset the queryArgs property, in order to create a "new" query.
     */
    public function query() {
        $this->setQueryArgs([]);

        return $this;
    }

    /**
     * Set the limit argument for the queryArgs - this translates into numberposts in the get_posts query object args.
     *
     * As does WordPress, we default this to 5.
     * @param int $limit
     * @return $this
     */
    public function limit($limit = 5) {
        $args = $this->getQueryArgs();

        $args['numberposts'] = $limit;

        $this->setQueryArgs($args);

        return $this;
    }

    /**
     * Feed our $this->queryArgs to get_posts which will return a list of WordPress
     * @return int[]|\WP_Post[]
     */
    public function runQuery() {

        $args = $this->getQueryArgs();

        return get_posts( $args );
    }

    /**
     * @return mixed
     */
    public function getQueryArgs()
    {
        return $this->queryArgs;
    }

    /**
     * @param mixed $queryArgs
     */
    public function setQueryArgs($queryArgs)
    {
        $this->queryArgs = $queryArgs;
    }

}