

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.js"></script><!-- -- Semantic-UI CSS & JS files included here -- -->
<?php
   /**
    * Show custom user profile fields
    * 
    * @param  object $profileuser A WP_User object
    * @return void
    */
   
   ?>
<h3>Informations suplémentaires</h3>
<table class="form-table">
   <tr>
      <td>Choisir un lieu</td>
      <?php
         $locations = get_posts(array(
         'post_type' => 'spa',
         'numberposts' => -1,
         ));
         ?>
      <td>
  <select id="select-location-user" name="select-location-user" style="margin-right: 250px;">
            <?php
            $meta_value = get_user_meta( $user->ID,'select-location-user', true ) ;
               foreach ($locations as $location) {
               ?>
            
            <option <?php echo selected( $location->ID , $meta_value, false )?> value="<?php echo $location->ID ; ?>"><?php echo $location->post_title ; ?></option> 
            <?php
               }
               ?>
    </select>       

        
      </td>
      <br><br>
   </tr>
   <tr>
      <td> Numero de telephone</td>
      <td>
         <input type="tel" id="user-tel" name="user-tel" value="<?php echo $value_user_tel ; ?>" required>
         <small>Format: xx-xx-xx-xx-xx</small>   
      </td>
      <br><br>
   </tr>
   <tr>
      <td>Choisir une couleur</td>

         
         <td>
         <input type="text" value="<?php echo $value_user_color ;?>" name="color-picker-user" class="my-color-field"  />

         </td>
               
      </div>
      <br><br>
   </tr>
   <tr>
      <td>Choisir Service</td>
      <?php		
         $services = get_posts(array(
         'post_type' => 'services',
         'numberposts' => -1,
         ));
         ?>
      <td>
      <input hidden type="text" value="no" name="select-service-user">
         <?php
           $user_location = get_user_meta( $user->ID,'select-location-user' , true );
           foreach ( $services as $service ) {
               $service_location = get_post_meta($service->ID, 'service-location', true);
   
               if( $user_location === $service_location) {            
            ?>
               <div class="checkbox-user-services">
                  <input type="checkbox" value="yes" name="select-service-user[<?php echo $service->ID; ?>]" 
                  <?php echo checked( 'yes', get_user_meta( $user->ID,'select-service-user', true )[$service->ID], false ); ?> >
                  <label for="select-service-user[<?php echo $service->ID; ?>]"><?php echo $service->post_title ; ?></label><br>
               </div>
         <?php
        
               }
        
            }
            ?>
      </td>
      <br>
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.js"></script><!-- -- Semantic-UI CSS & JS files included here -- -->
   </tr>
   <tr>
      <td>Choisir les horaires </td>
      <td>
         <?php
            $input_newdays = array(
                'lundi' => 'lundi',
                'mardi' => 'mardi',
                'mercredi' => 'mercredi',
                'jeudi' => 'jeudi',
                'vendredi' => 'vendredi',
                'samedi' => 'samedi',
                'dimanche' => 'dimanche'
                
            );
            
            $user_time_starts = array(
               '00:00','00:05','00:10','00:15','00:20','00:25','00:30','00:35','00:40','00:45','00:50','00:55',
               '01:00','01:05','01:10','01:15','01:20','01:25','01:30','01:35','01:40','01:45','01:50','01:55',
               '02:00','02:05','02:10','02:15','02:20','02:25','02:30','02:35','02:40','02:45','02:50','02:55',
               '03:00','03:05','03:10','03:15','03:20','03:25','03:30','03:35','03:40','03:45','03:50','03:55',
               '04:00','04:05','04:10','04:15','04:20','04:25','04:30','04:35','04:40','04:45','04:50','04:55',
               '05:00','05:05','05:10','05:15','05:20','05:25','05:30','05:35','05:40','05:45','05:50','05:55',
               '06:00','06:05','06:10','06:15','06:20','06:25','06:30','06:35','06:40','06:45','06:50','06:55',
               '07:00','07:05','07:10','07:15','07:20','07:25','07:30','07:35','07:40','07:45','07:50','07:55',
               '08:00','08:05','08:10','08:15','08:20','08:25','08:30','08:35','08:40','08:45','08:50','08:55',
               '09:00','09:05','09:10','09:15','09:20','09:25','09:30','09:35','09:40','09:45','09:50','09:55',
               '10:00','10:05','10:10','10:15','10:20','10:25','10:30','10:35','10:40','10:45','10:50','10:55',
               '11:00','11:05','11:10','11:15','11:20','11:25','11:30','11:35','11:40','11:45','11:50','11:55',
               '12:00','12:05','12:10','12:15','12:20','12:25','12:30','12:35','12:40','12:45','12:50','12:55',
               '13:00','13:05','13:10','13:15','13:20','13:25','13:30','13:35','13:40','13:45','13:50','13:55',
               '14:00','14:05','14:10','14:15','14:20','14:25','14:30','14:35','14:40','14:45','14:50','14:55',
               '15:00','15:05','15:10','15:15','15:20','15:25','15:30','15:35','15:40','15:45','15:50','15:55',
               '16:00','16:05','16:10','16:15','16:20','16:25','16:30','16:35','16:40','16:45','16:50','16:55',
               '17:00','17:05','17:10','17:15','17:20','17:25','17:30','17:35','17:40','17:45','17:50','17:55',
               '18:00','18:05','18:10','18:15','18:20','18:25','18:30','18:35','18:40','18:45','18:50','18:55',
               '19:00','19:05','19:10','19:15','19:20','19:25','19:30','19:35','19:40','19:45','19:50','19:55',
               '20:00','20:05','20:10','20:15','20:20','20:25','20:30','20:35','20:40','20:45','20:50','20:55',
               '21:00','21:05','21:10','21:15','21:20','21:25','21:30','21:35','21:40','21:45','21:50','21:55',
               '22:00','22:05','22:10','22:15','22:20','22:25','22:30','22:35','22:40','22:45','22:50','22:55',
               '23:00','23:05','23:10','23:15','23:20','23:25','23:30','23:35','23:40','23:45','23:50','23:55'


            );
            $user_time_ends = array(
               '00:00','00:05','00:10','00:15','00:20','00:25','00:30','00:35','00:40','00:45','00:50','00:55',
               '01:00','01:05','01:10','01:15','01:20','01:25','01:30','01:35','01:40','01:45','01:50','01:55',
               '02:00','02:05','02:10','02:15','02:20','02:25','02:30','02:35','02:40','02:45','02:50','02:55',
               '03:00','03:05','03:10','03:15','03:20','03:25','03:30','03:35','03:40','03:45','03:50','03:55',
               '04:00','04:05','04:10','04:15','04:20','04:25','04:30','04:35','04:40','04:45','04:50','04:55',
               '05:00','05:05','05:10','05:15','05:20','05:25','05:30','05:35','05:40','05:45','05:50','05:55',
               '06:00','06:05','06:10','06:15','06:20','06:25','06:30','06:35','06:40','06:45','06:50','06:55',
               '07:00','07:05','07:10','07:15','07:20','07:25','07:30','07:35','07:40','07:45','07:50','07:55',
               '08:00','08:05','08:10','08:15','08:20','08:25','08:30','08:35','08:40','08:45','08:50','08:55',
               '09:00','09:05','09:10','09:15','09:20','09:25','09:30','09:35','09:40','09:45','09:50','09:55',
               '10:00','10:05','10:10','10:15','10:20','10:25','10:30','10:35','10:40','10:45','10:50','10:55',
               '11:00','11:05','11:10','11:15','11:20','11:25','11:30','11:35','11:40','11:45','11:50','11:55',
               '12:00','12:05','12:10','12:15','12:20','12:25','12:30','12:35','12:40','12:45','12:50','12:55',
               '13:00','13:05','13:10','13:15','13:20','13:25','13:30','13:35','13:40','13:45','13:50','13:55',
               '14:00','14:05','14:10','14:15','14:20','14:25','14:30','14:35','14:40','14:45','14:50','14:55',
               '15:00','15:05','15:10','15:15','15:20','15:25','15:30','15:35','15:40','15:45','15:50','15:55',
               '16:00','16:05','16:10','16:15','16:20','16:25','16:30','16:35','16:40','16:45','16:50','16:55',
               '17:00','17:05','17:10','17:15','17:20','17:25','17:30','17:35','17:40','17:45','17:50','17:55',
               '18:00','18:05','18:10','18:15','18:20','18:25','18:30','18:35','18:40','18:45','18:50','18:55',
               '19:00','19:05','19:10','19:15','19:20','19:25','19:30','19:35','19:40','19:45','19:50','19:55',
               '20:00','20:05','20:10','20:15','20:20','20:25','20:30','20:35','20:40','20:45','20:50','20:55',
               '21:00','21:05','21:10','21:15','21:20','21:25','21:30','21:35','21:40','21:45','21:50','21:55',
               '22:00','22:05','22:10','22:15','22:20','22:25','22:30','22:35','22:40','22:45','22:50','22:55',
               '23:00','23:05','23:10','23:15','23:20','23:25','23:30','23:35','23:40','23:45','23:50','23:55'


            );
         
        
           foreach ($input_newdays as $input_newday) {
            
            ?>
           
               <input type="checkbox" value="yes" name="user-select-day-work[<?php echo $input_newday; ?>]" 
               <?php echo checked( 'yes', get_user_meta( $user->ID,'user-select-day-work', true )[$input_newday], false ); ?> >
               <label for="user-select-day-work[<?php echo $input_newday; ?>]" style="padding-right: 70px;"><?php echo $input_newday ; ?> </label>
               Heure debut

               <select id="user-time-start[<?php echo $input_newday ; ?>]" name="user-time-start[<?php echo $input_newday ; ?>]" style="margin-right: 50px;">
               <option <?php echo selected( '', $value_user_start_time, false ) ?> value="">-- Choisir --</option>
               <?php
               foreach( $user_time_starts as $user_time_start){

                  ?>
                  
                   <option <?php echo selected( $user_time_start , $value_user_start_time[$input_newday], false )?> value="<?php echo $user_time_start ; ?>"><?php echo $user_time_start ; ?></option>
                   <?php 
                  } 
                  ?> 
                   </select>
                   Heure fin

               <select id="user-time-end[<?php echo $input_newday ; ?>]" name="user-time-end[<?php echo $input_newday ; ?>]">
               <option <?php echo selected( '', $value_user_end_time, false ) ?> value="">-- Choisir --</option>
               <?php
               foreach( $user_time_ends as $user_time_end){

                  ?>
                  
                   <option <?php echo selected( $user_time_end , $value_user_end_time[$input_newday], false )?> value="<?php echo $user_time_end ; ?>"><?php echo $user_time_end ; ?></option>
                   <?php 
                  } 
                  ?> 
                   </select>
                   <br>
                 <?php 
                     
                  }
               
                      ?> 
                       
                      


            
      </td>
   </tr>
</table>
<script type="text/javascript">
   $('input').addClass('regular-text');
   $('select[name=select-location]').val('<?php echo get_the_author_meta('select-location', $user->ID); ?>');
   $(".ui.dropdown").dropdown();
   // Hide some default options //
   /*
   $('.user-url-wrap').hide();
   $('.user-description-wrap').hide();
   $('.user-profile-picture').hide();
   $('.user-rich-editing-wrap').hide();
   $('.user-admin-color-wrap').hide();
   $('.user-comment-shortcuts-wrap').hide();
   $('.show-admin-bar').hide();
   $('.user-language-wrap').hide();
   //*/
</script>
</table>
<!-- <?php
   $input_fields = array(
   'azezzeze' => 'test',
   'ojsdkoskd' => 'test1',
   'osjdpisjd' => 'test2'
   );
   ?>
   <div id="input-fields">
   <?php
      foreach ($input_fields as $key => $input_field) {
      ?>
   <input type="text" name="input-fields[<?php echo $key ; ?>]" value="<?php echo $input_field ; ?>">
   <select name="service-time" id="service-time">
   <option value="service-time-min">Minutes</option>
   <option value="service-time-hours">Heures</option>
   ....
   </select><br>
   <?php
      }
      ?>
   </div>
   <div onclick="add_field()">Add</div>
   
   <script>
   function add_field(){
   
   const old_html = document.querySelector('#input-fields');
   const new_input = '<input type="text" name="input-fields['+ Math.random().toString(36).substr(2, 9) +']" value=""><br>'
   old_html.innerHTML = old_html.innerHTML + new_input;
   }
   </script>
   -->

