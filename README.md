
![Image of Yaktocat](https://joemoses.dev/saturn-logo.png)
# Saturn 
#### An object-mapped post type builder &amp; interface for WordPress.

Saturn is a fluent interface used to effortlessly create and manipulate post types and their contents in WordPress.

How Effortlessly? Take a look:

```php
// Provide arguments.
$args = array(
    'slug'      => 'interview',
    'singular'  => 'Interview',
    'plural'    => 'Interviews',
    'namespace' => 'twentytwenty',
);

// Register the post type.
$saturn = new Saturn($args);

// Run a query, returning 10 posts.
$posts = $saturn->query()->limit( 10 )->runQuery();
```

Saturn is designed to almost act as a model, or resource to represent a post type, this means you can create,
 delete and change post types through an instance of Saturn, and it's easy peasy.
 
Not only that, Saturn provides a query engine to interact with post objects (or pages) directly within the instance. 
The query builder wraps `get_posts`, which means everything in `get_posts` is possible from a saturn instance - with 
a beautifully simple interface. 

## Create an instance
Creating an instance of Saturn is simple:
```php
// Provide arguments.
$args = array(
    'slug'      => 'interview',
    'singular'  => 'Interview',
    'plural'    => 'Interviews',
    'namespace' => 'twentytwenty',
);

// Register the post type.
$saturn = new Saturn($args);
```

Saturn requires an array of parameters, which are used to construct the post type and create the instance:

### Parameters
- **slug** (string) - The slug used to identify the post type.
- **singular**  (string) - The singular name of the post type - human readable, used in labels.
- **plural**  (string) - The plural name of the post type - human readable, used in labels.
- **namespace** (string) - The text & theme namespace (often referred to as domain) for the text strings.

## Instance methods
Methods which are available in an instance of Saturn are detailed below.

#### instance

**Usage** 

`$saturn->instance();`

**Return** 

Type: `Object` `WP_Post_Type`

An instance of a post type. We do not recommend altering its contents - instead, use Saturn methods. Helpful to quickly 
access the object.


#### instance

**Usage** 

`$saturn->instance();`

**Return** 

Type: `Object` `WP_Post_Type`

An instance of a post type. We do not recommend altering its contents - instead, use Saturn methods. Helpful to quickly 
access the object.

#### query

**Usage** 

`$saturn->query();`

**Return** 

Type: `Object` `Saturn`

Used to clear any lingering paramaters in the query engine from previous queries. It is important to **use this method
before setting up queries** to prevent any strange or unexpected results.

#### limit

**Parameters** 
- **quantity** (int) - The quantity of objects to return for a specified query.

**Usage** 

`$saturn->limit( 15 );`

**Return** 

Type: `Object` `Saturn`

Sets the number of objects to return from a query. The query engine will return the FIRST n matches if specified.


#### meta

**Parameters** 
- **metaQuery** (array) - An array which can contain a single key-value pair, where the key is the meta slug, and the 
value is the meta value. You can query multiple meta values by instead passing an array of arrays which contain the 
key-value pair.

- **queryConfig** (array) - A list of key-value config items, which would otherwise be provided inside of `meta_query`.
An example of config item would be `relation`. Not required.

**Usage** 

Single meta query:
```php
$saturn->query()
    ->meta( ['name' => 'joe'] )
    ->runQuery();
```


Multiple meta queries:
```php
$saturn->query()
    ->meta([
        ['name' => 'joe'],
        ['age' => 43]])
    ->runQuery();
```

Multiple meta queries with config:
```php
$saturn->query()
    ->meta([
        ['name' => 'joe'],
        ['age' => 43]],
        ['relation' => 'AND'])
    ->runQuery();
```

**Return** 

Type: `Object` `Saturn`

Sets the meta_query for the query.