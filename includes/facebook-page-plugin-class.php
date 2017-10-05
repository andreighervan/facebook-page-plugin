<?php

class Facebook_Page_Plugin_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array(

            'description' => __('Shows a facebook page plugin in a widget','fpp_domain')
        );
        parent::__construct( 'facebook_page_plugin_widget', __('Facebook page plugin','fpp_domain'), $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        // outputs the content of the widget
        $data=array();
        $data['page_url']=esc_attr($instance['page_url']);
        $data['show_timeline']=esc_attr($instance['show_timeline']);
        $data['adapt_container']=esc_attr($instance['adapt_container']);
        $data['width']=esc_attr($instance['width']);
        $data['height']=esc_attr($instance['height']);
        $data['hide_cover']=esc_attr($instance['hide_cover']);
        $data['use_small_header']=esc_attr($instance['use_small_header']);
        $data['show_facepile']=esc_attr($instance['show_facepile']);
        echo $args['before_widget'];
        echo $args['before_title'];
        echo $instance['title'];
        echo $this->getPagePlugin($data);
        echo $args['after_title'];
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        $this->getAdminForm($instance);
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance=array(
            'title'=>(!empty($new_instance['title']))?strip_tags($new_instance['title']):'',
            'page_url'=>(!empty($new_instance['page_url']))?strip_tags($new_instance['page_url']):'',
            'show_timeline'=>(!empty($new_instance['show_timeline']))?strip_tags($new_instance['show_timeline']):'',
            'width'=>(!empty($new_instance['width']))?strip_tags($new_instance['width']):'',
            'height'=>(!empty($new_instance['height']))?strip_tags($new_instance['height']):'',
            'show_facepile'=>(!empty($new_instance['show_facepile']))?strip_tags($new_instance['show_facepile']):'',
            'use_small_header'=>(!empty($new_instance['use_small_header']))?strip_tags($new_instance['use_small_header']):'',
            'hide_cover'=>(!empty($new_instance['hide_cover']))?strip_tags($new_instance['hide_cover']):'',
            'adapt_container'=>(!empty($new_instance['adapt_container']))?strip_tags($new_instance['adapt_container']):''
        );
        return $instance;
    }
    public function getAdminForm($instance){
        if(isset($instance['title'])){
            $title=$instance['title'];
        }
        else{
            $title=__('Like us on facebook','fpp_domain');
        }
        if(isset($instance['page_url'])){
            $page_url=$instance['page_url'];
        }
        else{
            $page_url='https://www.facebook.com/facebook';
        }
        if(isset($instance['adapt_container'])){
            $adapt_container=$instance['adapt_container'];
        }
        else{
            $adapt_container='true';
        }
        if(isset($instance['width'])){
            $width=$instance['width'];
        }
        else{
            $width=250;
        }
        if(isset($instance['height'])){
            $height=$instance['height'];
        }
        else{
            $height=500;
        }
        if(isset($instance['show_timeline'])){
            $show_timeline=$instance['show_timeline'];
        }
        else{
            $show_timeline='true';
        }
        if(isset($instance['show_facepile'])){
            $show_facepile=$instance['show_facepile'];
        }
        else{
            $show_facepile='true';
        }
        if(isset($instance['use_small_header'])){
            $use_small_header=$instance['use_small_header'];
        }
        else{
            $use_small_header='false';
        }
        if(isset($instance['hide_cover'])){
            $hide_cover=$instance['hide_cover'];
        }
        else{
            $hide_cover='false';
        }
        ?>
<p><label for="<?php $this->get_field_id('title');?>"><?php _e('Title','fpp_domain');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title');?>"
           name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo esc_attr($title);?>">
</p>
        <p><label for="<?php $this->get_field_id('page_url');?>"><?php _e('Page URL','fpp_domain');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('page_url');?>"
                   name="<?php echo $this->get_field_name('page_url');?>" type="text" value="<?php echo esc_attr($page_url);?>">
        </p>
        <p><label for="<?php $this->get_field_id('show_timeline');?>"><?php _e('Show timeline','fpp_domain');?></label>
            <select class="widefat" id=""<?php echo $this->get_field_id('show_timeline');?>" name="<?php echo $this->get_field_name('show_timeline');?>">
            <option value="true" <?php echo ($show_timeline=='true')?'selected' :'';?>>True</option>
            <option value="false" <?php echo ($show_timeline=='false')?'selected' :'';?>>False</option>
            </select>
            </p>
        <p><label for="<?php $this->get_field_id('adapt_container');?>"><?php _e('Adapt container','fpp_domain');?></label>
            <select class="widefat" id=""<?php echo $this->get_field_id('adapt_container');?>" name="<?php echo $this->get_field_name('adapt_container');?>">
            <option value="true" <?php echo ($adapt_container=='true')?'selected' :'';?>>True</option>
            <option value="false" <?php echo ($adapt_container=='false')?'selected' :'';?>>False</option>
            </select>
        </p>
        <p><label for="<?php $this->get_field_id('width');?>"><?php _e('Width','fpp_domain');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('width');?>"
                   name="<?php echo $this->get_field_name('width');?>" type="text" value="<?php echo esc_attr($width);?>">
        </p>
        <p><label for="<?php $this->get_field_id('height');?>"><?php _e('Height','fpp_domain');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('height');?>"
                   name="<?php echo $this->get_field_name('height');?>" type="text" value="<?php echo esc_attr($height);?>">
        </p>
        <p><label for="<?php $this->get_field_id('show_facepile');?>"><?php _e('Show facepile','fpp_domain');?></label>
            <select class="widefat" id=""<?php echo $this->get_field_id('show_facepile');?>" name="<?php echo $this->get_field_name('show_facepile');?>">
            <option value="true" <?php echo ($show_facepile=='true')?'selected' :'';?>>True</option>
            <option value="false" <?php echo ($show_facepile=='false')?'selected' :'';?>>False</option>
            </select>
        </p>
        <p><label for="<?php $this->get_field_id('use_small_header');?>"><?php _e('Use small header','fpp_domain');?></label>
            <select class="widefat" id=""<?php echo $this->get_field_id('use_small_header');?>" name="<?php echo $this->get_field_name('use_small_header');?>">
            <option value="true" <?php echo ($use_small_header=='true')?'selected' :'';?>>True</option>
            <option value="false" <?php echo ($use_small_header=='false')?'selected' :'';?>>False</option>
            </select>
        </p>
        <p><label for="<?php $this->get_field_id('hide_cover');?>"><?php _e('Hide cover','fpp_domain');?></label>
            <select class="widefat" id=""<?php echo $this->get_field_id('hide_cover');?>" name="<?php echo $this->get_field_name('hide_cover');?>">
            <option value="true" <?php echo ($hide_cover=='true')?'selected' :'';?>>True</option>
            <option value="false" <?php echo ($hide_cover=='false')?'selected' :'';?>>False</option>
            </select>
        </p>

<?php
    }
    public function getPagePlugin($data){
        ?>
<div class="fb-page" data-href="<?php echo $data['page_url'];?>"
     <?php if($data['show_timeline']=='true'):?>
     data-tabs="timeline"
     <?php endif;?>
     data-small-header="<?php echo $data['use_small_header'];?>"
     <?php if($data['adapt_container']=='false'):?>
         data-width="<?php echo $data['width'];?>"
         data-height="<?php echo $data['height'];?>"
     <?php else:?>
     data-adapt-container-width="<?php echo $data['adapt_container'];?>"
     <?php endif;?>
     data-hide-cover="<?php echo $data['hide_cover'];?>"
     data-show-facepile="<?php echo $data['show_facepile'];?>"><div class="fb-xfbml-parse-ignore">
        <blockquote cite="https://www.facebook.com/facebook">
            <a href="https://www.facebook.com/facebook">Facebook</a>
        </blockquote></div></div>
<?php
    }
}