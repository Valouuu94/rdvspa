<h3> Fournisseurs</h3>
<p> Associer les fournisseur pouvant exercer ce service <p>
<?php		 
global $post ;
        $fournisseurs = get_users( array( 'role__in' => array( 'fournisseur' ) ) );
        // Array of WP_User objects.
        foreach ( $fournisseurs as $user ) {
            $services = get_user_meta( $user->ID, 'select-service-user', true ) ;
            $service = isset($services[$post->ID]) ? true: false ;
            $user_location = get_user_meta( $user->ID,'select-location-user' , true );
            $service_location = get_post_meta($post->ID, 'service-location', true);
    
                if( $user_location === $service_location) { 
            ?>
            <div>
                <input type="checkbox" value="yes" name="select-users-for-this-service[<?php echo $user->ID ; ?>]"
                <?php echo checked( true,$service , false ); ?>>
                <label for="select-users-for-this-service[<?php echo $user->ID ; ?>]"><?php echo $user->display_name ; ?></label>
            </div>
           
        <?php
        }
    }
        ?>

