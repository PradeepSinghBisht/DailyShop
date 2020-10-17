<?php $_SESSION['userdata'] = array();
session_start(); ?>
<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>
<?php include "config.php"; 
      $errors = array();  ?>

        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql2 = "SELECT * FROM users WHERE `user_id`='".$id."'";
                $result = $conn->query($sql2);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $_SESSION['userdata'] = array('user_id'=>$row['user_id'],
                                    'name'=>$row['name'],
                                    'password'=>$row['password'],
                                    'email'=>$row['email'],
                                    'role'=>$row['role'],
                                    'address'=>$row['address']);
                    }
                }
            }

            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $password = $_POST['password'];
                $repassword = $_POST['repassword'];
                $email = $_POST['email'];
                $role = $_POST['role'];
                $address = $_POST['address'];
            
                if ($password != $repassword) {
                    $errors[] = array('msg'=>'password doesnt match');
                }
            
                $sql2 = "SELECT * FROM users WHERE `name`='".$name."'
                         OR `email`='".$email."'";
                $result = $conn->query($sql2);
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $user_id = $_SESSION['userdata']['user_id'];
                        if ($user_id != $row['user_id'] && $name == $row['name']) {
                             $errors[] = array('msg'=>'username already exists.');
                        }
                        if ($user_id != $row['user_id'] && $email == $row['email']) {
                            $errors[] = array('msg'=>'email already exists.');
                        }
                    }
                }
            
                if (sizeof($errors) == 0) {
                    $sql = "UPDATE users SET `name` = '".$name."',
                            `password` = '".$password."', `email` = '".$email."',
                            `role` = '".$role."', `address` = '".$address."' 
                            WHERE `user_id` = '".$_SESSION['userdata']['user_id']."'";
                 
                    if ($conn->query($sql) === true) {
                        echo "<script> alert('Updated successfully'); </script>";
                        //$_SESSION['userdata']['username'] = $username;
                        //$_SESSION['userdata']['email'] = $email;
            
                    } else {
                        $errors[] = array('msg'=>$conn->error);
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        ?>

		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<h2>Welcome John</h2>
			<p id="page-intro">What would you like to do?</p>
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Edit User</h3>
					
					<ul class="content-box-tabs">
						<!--<li><a href="#tab1" class="default-tab">Manage</a></li>--> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2" class="default-tab">Edit</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab2">
                        <?php foreach ($errors as $key=>$value) { ?>
							<div class="notification attention png_bg">
								<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
								<div>
									<?php echo $errors[$key]['msg'];
							echo '</div>';
						echo '</div>';
						}?>
					
						<form action="editUser.php" method="POST">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
									<label>User Name</label>
									    <input class="text-input small-input" type="text" id="small-input" name="name" value="<?php 
                                        echo $_SESSION['userdata']['name'];?>" required/> <!--<span class="input-notification error png_bg">Error message</span>-->
								</p>
                                
                                <p>
									<label>Password</label>
										<input class="text-input small-input" type="password" id="small-input" name="password" value="<?php 
                                        echo $_SESSION['userdata']['password'];?>" required/> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
										<br /><!--<small>A small description of the field</small>-->
								</p>
                                
                                <p>
									<label>Re-Password</label>
										<input class="text-input small-input" type="password" id="small-input" name="repassword" value="<?php 
                                        echo $_SESSION['userdata']['password'];?>" required/> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
										<br /><!--<small>A small description of the field</small>-->
								</p>
                                
                                <p>
									<label>Email</label>
										<input class="text-input small-input" type="email" id="small-input" name="email" value="<?php 
                                        echo $_SESSION['userdata']['email'];?>" required/> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
										<br /><!--<small>A small description of the field</small>-->
								</p>

                                <p>
									<label>Role</label>
										<input class="text-input small-input" type="text" id="small-input" name="role" value="<?php 
                                        echo $_SESSION['userdata']['role'];?>" required/> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
										<br /><!--<small>A small description of the field</small>-->
                                </p>
                                
                                <p>
									<label>Address</label>
									    <input class="text-input small-input" type="text" id="small-input" name="address" value="<?php 
                                        echo $_SESSION['userdata']['address'];?>" required/> <!--<span class="input-notification error png_bg">Error message</span>-->
								</p>
								
								<p>
									<input class="button" type="submit" name="submit" value="Submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->         
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			
			<!-- Start Notifications -->
			<!--
			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
				</div>
			</div>
			
			<div class="notification information png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			-->
			<!-- End Notifications -->
			
			<?php include "footer.php"; ?>
			
		</div> <!-- End #main-content -->
	</div></body>
</html>
