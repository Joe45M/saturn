<?php


namespace Joem\Saturn;


class SaturnQuery
{
    protected $queryArgs;

    /**
     * Reset the queryArgs property, in order to create a "new" query. Doing this prevents any unforeseen query results
     * if a developer doesn't know exactly how the query engine works.
     */
    public function query()
    {
        $this->setQueryArgs([
            'post_type' => $this->instance->name,
        ]);

        return $this;
    }

    /**
     * Set the limit argument for the queryArgs - this translates into numberposts in the get_posts query object args.
     *
     * As does WordPress, we default this to 5.
     * @param int $limit
     * @return $this
     */
    public function limit($limit = 5)
    {
        $args = $this->getQueryArgs();

        $args['numberposts'] = $limit;

        $this->setQueryArgs($args);

        return $this;
    }

    /**
     * Order the results of the query. This method combines both 'orderby' (as index) & 'order'(as sort) from the
     * traditional get_posts argument params.
     *
     *
     * @param $index string The index to order by.
     *
     * @param $sort string the direction to sort by.
     *
     * @return $this
     */
    public function order($index, $sort)
    {
        $args = $this->getQueryArgs();

        $args['orderby'] = $index;
        $args['order']   = $sort;

        $this->setQueryArgs($args);

        return $this;
    }

    /**
     * Append a meta query to the argument list of this instance. We've gone out of our way to create a more intuitive
     * system to append these, since the original is overly verbose and clunky - especially when you're running a small
     * query.
     *
     *
     * @param array $metaQuery An array where each item is a key-value pair, where key is the meta key, and the value
     *                           is the meta value to check against.
     *
     * @param array $queryConfig An array of configurables for the query, such as 'relation'. Where the key is the name
     *                           of the item to configure, and value is the value. Not required.
     * @return SaturnQuery
     */
    public function meta(array $metaQuery, array $queryConfig = [])
    {
        $args = $this->getQueryArgs();


        $args['meta_query'] = Walkable::walk($metaQuery);

        if (count($queryConfig)) {
            foreach ($queryConfig as $key => $config) {
                $args['meta_query'][$key] = $config;
            }
        }

        $this->setQueryArgs($args);

        return $this;
    }


    /**
     * Set the category to query. This can be an integer or Comma-separated string list of ids.
     *
     * We could probably change this to an array or int param - csv is foul, and should die in a fire with spiders.
     *
     * @param mixed $category an array of IDs of taxonomy terms.
     * @return $this
     * @todo make sure this actually works, seems flaky.
     */
    public function category($category = false)
    {
        $args = $this->getQueryArgs();

        $args['category'] = $category;

        $this->setQueryArgs($args);

        return $this;
    }

    /**
     * Add a tax query to the query params.
     *
     * @param array $taxQuery Taxonomy query array, as per WP_Query.
     * @return $this
     */
    public function tax(array $taxQuery)
    {
        $args = $this->getQueryArgs();

        $args['tax_query'][] = $taxQuery;

        $this->setQueryArgs($args);

        return $this;

    }

    /**
     * Feed our $this->queryArgs to get_posts which will return a list of WordPress
     * @return int[]|\WP_Post[]
     */
    public function runQuery()
    {

        $args = $this->getQueryArgs();

        return get_posts($args);
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