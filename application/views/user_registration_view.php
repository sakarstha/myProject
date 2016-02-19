<!DOCTYPE html>
<html>
<head>
   
    <title>CodeIgniter User Registration Form Demo</title>
    
</head>
<body>
	<?php echo $this->session->flashdata('verify_msg'); ?>
    <h4>User Registration Form</h4>
            
    <?php $attributes = array("name" => "registrationform");
          echo form_open("user/register", $attributes);?>
                
    First Name: <input name="fname" placeholder="Your First Name" type="text" value="<?php echo set_value('fname'); ?>" />
    <?php echo form_error('fname');
    	  echo "</br>";?>
                    
    Last Name :<input name="lname" placeholder="Last Name" type="text" value="<?php echo set_value('lname'); ?>" />
    <?php echo form_error('lname'); 
    	  echo "</br>";?>
    	  
   Address : <input name="address" placeholder = "Your Address" type="text" value="<?php echo set_value('address');?>" />
   <?php echo form_error('address');
   		 echo "</br>";
   ?>
   
   Country : <select name="country">
   					<option  value="">Please select your country</option>
   					<option  value="nepal"<?php echo set_select('country','nepal')?>>Nepal</option>
   					<option  value="bhutan"<?php echo set_select('country','bhutan')?>>Bhutan</option>
   					<option  value="china"<?php echo set_select('country','china')?>>China</option>
   			</select>
   			<?php echo form_error('country');?>
   			<br>
   Gender : 	Male 	<input type="radio" name="gender" value ="male" checked ="checked"/>
   				Female	<input type="radio" name="gender" value = "female" /> <br>
   		
                    
     Email ID :<input name="email" placeholder="Email-ID" type="text" value="<?php echo set_value('email'); ?>" />
     <?php echo form_error('email'); 
     	   echo "</br>";?>
     	   
     Username : <input name="username" placeholder="Username" type="text" value="<?php echo set_value('username')?>" >
     <?php 
     		echo form_error('username');
     		echo "</br>";
     ?>
                    
     Password: <input name="password" placeholder="Password" type="password"/>
     <?php echo form_error('password'); 
     	   echo "</br>";?>
                    
     Confirm Password: <input name="cpassword" placeholder="Confirm Password" type="password" />
     <?php echo form_error('cpassword');
           echo "</br>"; ?>

      <button name="submit" type="submit">Signup</button>
      <!-- './' redirects the user to site root  -->
      <button onClick="location.href='<?php echo base_url();?>./'" type="button">Cancel</button>
            
       <?php echo form_close(); ?>
       <?php echo $this->session->flashdata('msg'); ?>

</div>
</div>
</body>
</html>