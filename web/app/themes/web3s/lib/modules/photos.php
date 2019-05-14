<?php
class WzhPhotos
{

    protected $gallery = '';
    protected $imagesInColumns = [];

    public function getProjects()
    {
        $projects = array();
        $args = array(
            'posts_per_page'   => -1,
            'offset'           => 0,
            'category'         => '',
            'category_name'    => '',
            'include'          => '',
            'exclude'          => '',
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'wzh_project',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'           => '',
            'author_name'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true 
        );
        $projects = get_posts($args);
        return $projects;
    }

    public function lazyThumbnail($id)
    {
        $attachmentId = get_post_thumbnail_id($id);
        $img = wp_get_attachment_image_src($attachmentId,'custom-size',false);
        $imgMeta = wp_get_attachment_metadata($attachmentId);
        $imgSrcset = wp_calculate_image_srcset(array($img[1],$img[2]),$img[0],$imgMeta);
        return '<div class="l-ratio-box" style="padding-bottom: calc(('.$img[2].' / '.$img[1].') * 100%);">
            <img data-sizes="auto" 
            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP89v1nPQAJOANnDzEhuQAAAABJRU5ErkJggg==" 
            srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP89v1nPQAJOANnDzEhuQAAAABJRU5ErkJggg==" 
            data-src="'.$img[0].'" 
            data-srcset="'.$imgSrcset.'" 
            class="lazyload l-ratio-box__img" 
            width="'.$img[1].'" height="'.$img[2].'">
            </div>';
    }

    public function gallery($id)
    {
        $images = rwmb_meta('web3s_rwmb_page_gallery', array( 'size' => 'full' ), $id );
        $index = 0;
        if ($images) {
            foreach ( $images as $image ) {
                $index++;
                $img = wp_get_attachment_image_src($image['ID'],'full',false);
                $imgMeta = wp_get_attachment_metadata($image['ID']);
                $imgSrcset = wp_calculate_image_srcset(array($img[1],$img[2]),$img[0],$imgMeta);
                $this->gallery .= '<div class="gallery-item item--'.$index.'">';
                $this->gallery .= '<div class="gallery-item__img">';
                $this->gallery .= '<div class="l-ratio-box">';
                
                $this->gallery .= '<a href="'.$image['url'].'" class="gallery-item-link jsGalleryItem">';
                $this->gallery .= '<img data-sizes="auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP89v1nPQAJOANnDzEhuQAAAABJRU5ErkJggg==" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP89v1nPQAJOANnDzEhuQAAAABJRU5ErkJggg==" data-src='.$img[0].' data-srcset="'.$imgSrcset.'" width="'.$img[1].'" height="'.$img[2].'" class="lazyload l-ratio-box__img">';
                $this->gallery .= '</a>';
                
                $this->gallery .= '</div>';
                $this->gallery .= '</div>';
                $this->gallery .= '</div>';

                if ($index===3) $index = 0;
            }
        }
        return $this->gallery;
    }

    public function galleryColumns($id)
    {
        $images = rwmb_meta('web3s_rwmb_page_gallery', array( 'size' => 'full' ), $id );
        if ($images) {
            $i=0;
            foreach ( $images as $image ) {
                $i++;
                $img = wp_get_attachment_image_src($image['ID'],'full',false);
                $imgMeta = wp_get_attachment_metadata($image['ID']);
                $imgSrcset = wp_calculate_image_srcset(array($img[1],$img[2]),$img[0],$imgMeta);
                $this->imagesInColumns[$i] .= '<div class="gallery-item">';
                $this->imagesInColumns[$i] .= '<div class="gallery-item__img">';
                $this->imagesInColumns[$i] .= '<div class="l-ratio-box">';
                
                $this->imagesInColumns[$i] .= '<a href="'.$image['url'].'" class="gallery-item-link jsGalleryItem">';
                $this->imagesInColumns[$i] .= '<img data-sizes="auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP89v1nPQAJOANnDzEhuQAAAABJRU5ErkJggg==" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP89v1nPQAJOANnDzEhuQAAAABJRU5ErkJggg==" data-src='.$img[0].' data-srcset="'.$imgSrcset.'" width="'.$img[1].'" height="'.$img[2].'" class="lazyload l-ratio-box__img">';
                $this->imagesInColumns[$i] .= '</a>';
                
                $this->imagesInColumns[$i] .= '</div>';
                $this->imagesInColumns[$i] .= '</div>';
                $this->imagesInColumns[$i] .= '</div>';
                if ($i === 3) $i=0;
            }
        }
        return $this->imagesInColumns;
    }
}