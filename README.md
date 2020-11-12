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
Creating an instance is simple:
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

### Arguments
- **slug** (string) - The slug used to identify the post type.
- **singular**  (string) - The singular name of the post type - human readable, used in labels.
- **plural**  (string) - The plural name of the post type - human readable, used in labels.
- **namespace** (string) - The text & theme namespace (often referred to as domain) for the text strings.