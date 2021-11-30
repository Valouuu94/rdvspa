<div class="meta-box-item-title" style="padding-left:40%;padding-bottom:20px;">
	<h3>Details du service</h3>
</div>
<div class="meta-box-item-content">
	Nom du service
	<input type="text" name="service-name" id="service-name" value="<?= $value_service_name ?>"style=" margin-left:90px;"/>
		<br><br> Prix( en euros)
	<input type="text" name="service-price" id="service-price" value="<?= $value_service_price ?>"style=" margin-left: 100px;"/>
		<br><br> Capacité
		<select id="service-capacity" name="service-capacity" style=" margin-left:130px;">
			<option <?php echo selected( '', $value_service_capacity, false ) ?> value="">-- Choisir --</option>
			<option <?php echo selected( '1personne', $value_service_capacity, false ) ?> value="1personne">1 personne</option>
			<option <?php echo selected( '2personnes', $value_service_capacity, false ) ?> value="2personnes">2 personnes</option>
		</select>

		<br><br> Durée
	<input type="text" name="service-duration-number" id="service-duration-number" value="<?= $value_service_duration_number ?>"style=" margin-left:145px;"/>
        <select name="service-duration" id="service-duration">
			<option <?php echo selected( '', $value_service_duration, false ) ?> value="">-- Choisir --</option>
			<option <?php echo selected( 'minutes', $value_service_duration, false ) ?> value="minutes">Minutes</option>
			<option <?php echo selected( 'hours', $value_service_duration, false ) ?> value="hours">Heure(s)</option>
        </select>
		<br><br>Nombre de fournisseur(s)<br>requis
		<select id="service-countfournisseur" name="service-countfournisseur" style=" margin-left:140px;">
			<option <?php echo selected( '', $value_service_countfournisseur, false ) ?> value="">-- Choisir --</option>
			<option <?php echo selected( '1fournisseur', $value_service_countfournisseur, false ) ?> value="1fournisseur">1 fournisseur</option>
			<option <?php echo selected( '2fournisseurs', $value_service_countfournisseur, false ) ?> value="2fournisseurs">2 fournisseurs</option>
		</select>
		<br><br>Lieu 
        <?php
            $locations = get_posts(array(
            'post_type' => 'spa',
	        'numberposts' => -1,
	        ));
	    ?>
  		<select id="service-location" name="service-location" style="margin-left: 150px;">
        <?php
            foreach ($locations as $location) {
        ?>
            <option <?php echo selected( $location->ID , $value_service_location, false )?> value="<?php echo $location->ID ; ?>"><?php echo $location->post_title ; ?></option> 
            <?php
            }
            ?>
   		</select> 
		   <br><br> Durée d'espacement entre <br>le service
	<input type="text" name="service-time-espacement" id="service-time-espacement" value="<?= $value_service_time_espacement ?>"style=" margin-left:125px;"/>
		Minutes de temps d'espacement
        <select name="service-time-espacement-padding" id="service-time-espacement-padding">
			<option <?php echo selected( '', $value_service_time_espacement_padding, false ) ?> value="">-- Choisir --</option>
			<option <?php echo selected( 'before', $value_service_time_espacement_padding, false ) ?> value="before">Avant</option>
			<option <?php echo selected( 'after', $value_service_time_espacement_padding, false ) ?> value="after">Apres</option>
        </select>      
		<br><br> Category
	<input type="text" name="service-category" id="service-category" value="<?= $value_service_category ?>"style=" margin-left:125px;"/> 
</div>

			