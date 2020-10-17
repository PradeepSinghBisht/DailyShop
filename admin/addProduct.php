<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>
<?php include "config.php"; 
      $errors = array();  ?>

        <?php
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $image = $_POST['image'];
				$category = $_POST['category'];
			
				$tag = array();
				$i = 0;

				$sql5 = 'SELECT * FROM tags';
				$result5 = $conn->query($sql5);

				if ($result5->num_rows > 0) {
					while ($row = $result5->fetch_assoc()) {
						if (isset($_POST[$row['name']])) {
							$tag[$i] = $_POST[$row['name']];
							$i++;
						}
					}
				}

				print_r($tag);

				$tags = json_encode($tag);
				print_r($tags);

				//$color = $_POST['color'];
				//$quantity = $_POST['quantity'];

                $description = $_POST['description'];

                $sql = "SELECT * FROM products WHERE `name`='".$name."'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
						$errors[] = array('msg'=>'product name already exists');
                    }
                }

                if (sizeof($errors) == 0) {

                    $sql2 = 'INSERT INTO products(`category_id`,`tag_id`, `name`,`image`,`price`,`short_desc`) 
                    VALUES("'.$category.'","'.$tags.'","'.$name.'","'.$image.'","'.$price.'","'.$description.'")';
					
                    if ($conn->query($sql2) === true) {
                        echo "<script> alert('Added successfully'); </script>";

                    } else {
                        $errors[] = array('msg'=>$conn->error);
                        echo "Error: " . $sql2 . "<br>" . $conn->error;
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
					
					<h3>Add Product</h3>
					
					<ul class="content-box-tabs">
						<!--<li><a href="#tab1" >Manage</a></li> --><!-- href must be unique and match the id of target div -->
						<li><a href="#tab2" class="default-tab">Add</a></li>
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
					
						<form action="addProduct.php" method="POST">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
									<label>Product Name</label>
									<input class="text-input small-input" type="text" id="small-input" name="name" required/> <!--<span class="input-notification error png_bg">Error message</span>-->
								</p>
                                
                                <p>
									<label>Product Price</label>
										<input class="text-input small-input" type="text" id="small-input" name="price" required/> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
										<br /><!--<small>A small description of the field</small>-->
								</p>
                                
                                <p>
									<label>Product Image</label>
										<input class="text-input small-input" type="file" id="small-input" name="image" required/> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
										<br /><!--<small>A small description of the field</small>-->
                                </p>
                                
                                <p>
                                    <label>Category</label>              
                                    <select name="category" class="small-input" required>
										<?php
											$sql3 = 'SELECT * FROM categories';
											$result3 = $conn->query($sql3);

											if ($result3->num_rows > 0) {
												while ($row = $result3->fetch_assoc()) {
													echo '<option value="'.$row['category_id'].'">'.$row['name'].'</option>';
												}
											}
										?>
                                    </select>
                                </p>

                                <p>
									<label>Tags</label>
									<?php
										$sql4 = 'SELECT * FROM tags';
										$result4 = $conn->query($sql4);

										if ($result4->num_rows > 0) {
											while ($row = $result4->fetch_assoc()) {
												echo '<input type="checkbox" name="'.$row['name'].'" value="'.$row['tag_id'].'" /> '.$row['name'].'';
											}
										}
									?>
								</p>
								
								<!--<p>
									<label>Product Color</label>
										<input class="text-input small-input" type="text" id="small-input" name="color" required/> 
										<br />
								</p>

								<p>
									<label>Product Quantity</label>
										<input class="text-input small-input" type="number" id="small-input" name="quantity" required/> 
										<br />
								</p>-->

								<p>
									<label>Description</label>
									<textarea class="text-input textarea wysiwyg" id="textarea" name="description" cols="79" rows="15"></textarea>
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
