<!-- <h3> Services associée(s) à cette salle </h3>
<?php		 
global $post ;
        $services = get_posts(array(
            'post_type' => 'services',
            'numberposts' => -1,
            ));
            
            $room_location = get_post_meta( $post->ID,'room-location' , true );
        // Array of WP_User objects.
        foreach ( $services as $service ) {
            $service_location = get_post_meta($service->ID, 'service-location', true);

            if( $room_location === $service_location) {            
            $services_select = get_post_meta( $service->ID, 'select-service-room', true ) ;
            $service_select = isset($services_select[$post->ID]) ? true: false ;
            

            ?>
            <div>
                <input type="checkbox" value="yes" name="select-services-for-this-room[<?php echo $service->ID ; ?>]"
                <?php echo checked( true,$servicetest , false ); ?>>
                <label for="select-services-for-this-room[<?php echo $post->ID ; ?>]"><?php echo $service->post_title ; ?></label>
            </div>
        <?php
            
            } 
        } 
        ?> -->