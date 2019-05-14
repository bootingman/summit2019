<?php
class WzhVideo
{
    protected $posts;
    protected $entries;
    protected $groups;
    protected $categories;

    function __construct()
    {
        $this->categories = get_categories(array('taxonomy' => 'web3s_video_category','orderby' => 'name','order' => 'ASC'));
    }

    public function getVideo()
    {
        foreach ($this->posts as $post) {
            $this->entries[] = (object) array(
                'title' => $post->post_title,
                'subtitle' => rwmb_meta( 'web3s_rwmb_video_subtitle', '', $post->ID ),
                'permalink' => get_permalink($post->ID),
            );
        }
        return $this->entries;
    }

    protected function getPostsInCategory($cat) {
        $args = array(
            'posts_per_page'   => -1,
            'offset'           => 0,
            'category'         => '',
            'category_name'    => '',
            'include'          => '',
            'exclude'          => '',
            'orderby'          => 'meta_value',
            'meta_key'         => 'web3s_rwmb_video_subtitle',
            'order'            => 'ASC',
            'post_type'        => 'web3s_video',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'           => '',
            'author_name'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true,
            'tax_query' => array(
                array(
                    'taxonomy' => 'web3s_video_category',
                    'field' => 'term_id',
                    'terms' => $cat->term_id,
                )
            )
        );

        var_dump(get_posts($args));
        return get_posts($args);
    }

    public function getFrontVideo() {
        $args = array(
            'posts_per_page'   => -1,
            'offset'           => 0,
            'category'         => '',
            'category_name'    => '',
            'include'          => '',
            'exclude'          => '',
            'orderby'          => 'post_title',
            // 'meta_key'         => 'web3s_rwmb_video_subtitle',
            'order'            => 'ASC',
            'post_type'        => 'web3s_video',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'           => '',
            'author_name'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true,
            'tax_query' => array(
                array(
                    'taxonomy' => 'web3s_video_category',
                    'field' => 'term_id',
                    'terms' => 'front',
                )
            )
        );

        return get_posts($args);
    }

    public function getVideoByCats()
    {
        foreach ($this->categories as $index => $cat) {
            $this->groups[$index]['name'] = $cat->name;
            $this->groups[$index]['entries'] = $this->getPostsInCategory($cat);
        }
        return $this->groups;
    }

}
