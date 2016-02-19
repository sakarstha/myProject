<!DOCTYPE html>
<html>

<body>
<?php 
	$attributes = array( "id" => "loginform", "name" => "loginform");
     echo form_open("user/login", $attributes);?>
      <fieldset>
      	<legend>Login</legend>
      	<input  name="username" placeholder="Username" type="text" value="<?php echo set_value('username'); ?>" />
        <?php
        echo form_error('username');
        echo "</br>";        	  
        ?>
         
        <input id="password" name="password" placeholder="Password" type="password" value="<?php echo set_value('password'); ?>" />
        <?php
        echo form_error('password'); 
        echo "</br>";
        ?>
         
        <input name="login_btn" type="submit" value="Login" /> </br>
        <button onclick="location.href='<?php echo base_url();?>user/register'" type="button">Register</button>
      </fieldset>
          
          <?php echo form_close(); ?>
          <?php  echo $this->session->flashdata('msg'); ?>
  
</body>
</html>