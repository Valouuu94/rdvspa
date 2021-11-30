 <h3> Salle(s) associée(s) à ce service </h3>
<?php		 
global $post ;
        $rooms = get_posts(array(
            'post_type' => 'salles',
            'numberposts' => -1,
            ));
            
            $service_location = get_post_meta( $post->ID,'service-location' , true );
        // Array of WP_User objects.
        foreach ( $rooms as $room ) {
            $room_location = get_post_meta($room->ID, 'room-location', true);

            if( $room_location === $service_location) {            
            $services = get_post_meta( $room->ID, 'select-service-room', true ) ;
            $service = isset($services[$post->ID]) ? true: false ;
            

            ?>
            <div>
                <input type="checkbox" value="yes" name="select-rooms-for-this-service[<?php echo $room->ID ; ?>]"
                <?php echo checked( true,$service , false ); ?>>
                <label for="select-rooms-for-this-service[<?php echo $post->ID ; ?>]"><?php echo $room->post_title ; ?></label>
            </div>
        <?php
            
            } 
        } 
        ?>