<?php 
$_SESSION['productdata'] = array();
session_start();
include "header.php"; ?>
 <?php include "sidebar.php"; ?> 
<?php include "config.php"; ?>
      
        <?php
			$errors = array(); 
            
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql2 = "SELECT * FROM products WHERE `product_id`='".$id."'";
				$result = $conn->query($sql2);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $_SESSION['productdata'] = array('product_id'=>$row['product_id'],
                                    'category_id'=>$row['category_id'],
                                    'name'=>$row['name'],
									'image'=>$row['image'],
                                    'description'=>$row['short_desc'],
                                    'price'=>$row['price']);
                    }
				}
				
            }


            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $image = $_POST['image'];
				$category = $_POST['category'];
				$tag = $_POST['tag'];
				$tags = implode(',', $tag);
				$color = $_POST['color'];
				$colors = implode(',', $color);
                $description = $_POST['description'];

                $sql = "SELECT * FROM products WHERE `name`='".$name."'";
                $result2 = $conn->query($sql);

                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        if ($_SESSION['productdata']['product_id'] != $row['product_id']) {
                            $errors[] = array('msg'=>'productname already exists.');
                        }
                    }
                }

                if (sizeof($errors) == 0) {
                    $sql = "UPDATE products SET `category_id` = '".$category."', `tag_id` = '".$tags."',`color_id` = '".$colors."', `name` = '".$name."',
                            `image` = '".$image."', `price` = '".$price."', `short_desc` = '".$description."' 
                            WHERE `product_id`='".$_SESSION['productdata']['product_id']."'";
                    
                    if ($conn->query($sql) === true) {
						echo "<script> alert('Updated successfully') </script>";
                    } else {
                        $errors[] = array('input'=>'form', 'msg'=>$conn->error);
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
					
					<h3>Edit Product</h3>
					
					<ul class="content-box-tabs">
						<!--<li><a href="#tab1" >Manage</a></li>--> <!-- href must be unique and match the id of target div -->
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
					
						<form action="editProduct.php" method="POST">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
									<label>Product Name</label>
									<input class="text-input small-input" type="text" id="small-input" name="name" value="<?php 
                                    echo $_SESSION['productdata']['name'];?>" required/> <!--<span class="input-notification error png_bg">Error message</span>-->
								</p>
                                
                                <p>
									<label>Product Price</label>
										<input class="text-input small-input" type="text" id="small-input" name="price" value="<?php 
                                        echo $_SESSION['productdata']['price'];?>" required/> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
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
												echo '<input type="checkbox" name="tag[]" value="'.$row['tag_id'].'"/> '.$row['name'].'';
											}
										}
									?>
								</p>

								<p>
									<label>Colors</label>
									<?php
										$sql6 = 'SELECT * FROM colors';
										$result6 = $conn->query($sql6);

										if ($result6->num_rows > 0) {
											while ($row = $result6->fetch_assoc()) {
												echo '<input type="checkbox" name="color[]" value="'.$row['color_id'].'"/> '.$row['color'].'';
											}
										}
									?>
								</p>

								<p>
									<label>Description</label>
									<textarea class="text-input textarea wysiwyg" id="textarea" name="description" cols="79" rows="15"><?php 
                                        echo $_SESSION['productdata']['description'];?></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" name="submit" value="Update" />
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
