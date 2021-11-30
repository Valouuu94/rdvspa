<div class="meta-box-item-title" style="padding-left:40%;padding-bottom:20px;">
	<h3>Details de la salle</h3>
</div>
<div class="meta-box-item-content">
	Nom de la salle

	<input type="text" name="room-name" id="room-name" value="<?= $value_room_name ?>"style=" margin-left:90px;"/>
	<br><br> Capacité
    <select id="room-capacity" name="room-capacity" style=" margin-left:130px;">
        <option <?php echo selected( '', $value_room_capacity, false ) ?> value="">-- Choisir --</option>
        <option <?php echo selected( '1personne', $value_room_capacity, false ) ?> value="1personne">1 personne</option>
        <option <?php echo selected( '2personnes', $value_room_capacity, false ) ?> value="2personnes">2 personnes</option>
    </select>
		<br><br>Lieu 
        <?php
            $locations = get_posts(array(
            'post_type' => 'spa',
	        'numberposts' => -1,
	        ));
	    ?>
  		<select id="room-location" name="room-location" style="margin-left: 150px;">
        <?php
            foreach ($locations as $location) {
        ?>
            <option <?php echo selected( $location->ID , $value_room_location, false )?> value="<?php echo $location->ID ; ?>"><?php echo $location->post_title ; ?></option> 
            <?php
            }
            ?>
   		</select>
           <br><br>Choissiez les services associés à cette salle
           <input hidden type="text" value="no" name="select-service-room">
         <?php
               $services = get_posts(array(
               'post_type' => 'services',
               'numberposts' => -1,
               ));
               
               $room_location = get_post_meta( $post->ID,'room-location' , true );
                foreach ( $services as $service ) {
                   $service_location = get_post_meta($service->ID, 'service-location', true);
       
                   if( $room_location === $service_location) {
            ?>
               <div class="checkbox-user-services">
                  <input type="checkbox" value="yes" name="select-service-room[<?php echo $service->ID; ?>]" 
                  <?php echo checked( 'yes', get_post_meta( $post->ID,'select-service-room', true )[$service->ID], false ); ?> >
                  <label for="select-service-room[<?php echo $service->ID; ?>]"><?php echo $service->post_title ; ?></label>
               </div>
         <?php
            }
        }
            ?>
		<br><br> Category
	<input type="text"  id="room-category" name="room-category" value="<?php echo $value_room_category ;?>" style=" margin-left:125px;"/> 
    <br><br> Associé une couleur à cette salle
    <?php
  
	?>
</div>
			