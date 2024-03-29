<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>
<?php include "config.php"; 
		$errors = array();  ?>

		<?php
			if (isset($_POST['submit'])) {
				$name = $_POST['name'];

				$sql = "SELECT * FROM tags WHERE `name`='".$name."'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$errors[] = array('msg'=>'tag name already exists');
					}
				}

				if (sizeof($errors) == 0) {

					$sql2 = 'INSERT INTO tags(`name`) VALUES("'.$name.'")';

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
					
					<h3>Manage Tags</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2">Add</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
						<!--<div class="notification attention png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
							</div>
                        </div>-->
                        
                        <?php
                            $sql2 = "SELECT * FROM tags";
                            $result2 = $conn->query($sql2);
                                    
                            if ($result2->num_rows > 0) {
                                $html2 = '<table>
                                            <thead>
			                					<tr>
                                                    <th><input class="check-all" type="checkbox" /></th>
                                                    <th>Tag Id</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
								                </tr>
                                            </thead>
                                            
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="bulk-actions align-left">
                                                            <select name="dropdown">
                                                                <option value="option1">Choose an action...</option>
                                                                <option value="option2">Edit</option>
                                                                <option value="option3">Delete</option>
                                                            </select>
                                                            <a class="button" href="#">Apply to selected</a>
                                                        </div>
                                                        
                                                        <div class="pagination">
                                                            <a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
                                                            <a href="#" class="number" title="1">1</a>
                                                            <a href="#" class="number" title="2">2</a>
                                                            <a href="#" class="number current" title="3">3</a>
                                                            <a href="#" class="number" title="4">4</a>
                                                            <a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
                                                        </div> <!-- End .pagination -->
                                                        <div class="clear"></div>
                                                    </td>
                                                </tr>
                                            </tfoot>

                                            <tbody>';
                                while ($row = $result2->fetch_assoc()) {
                                    $html2 .= '<tr>
                                                    <td><input type="checkbox" /></td>
                                                    <td>'.$row['tag_id'].'</td>
                                                    <td>'.$row['name'].'</td>
                                                    <td>
                                                        <!-- Icons -->
                                                        <a href="deleteTag.php?id='.$row['tag_id'].'" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
                                                    </td>
                                                </tr>';
                                }
                                $html2 .= '</tbody> </table>';
                                echo $html2;
                            }
                        ?> 
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">
						<?php foreach ($errors as $key=>$value) { ?>
							<div class="notification attention png_bg">
								<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
								<div>
									<?php echo $errors[$key]['msg'];
							echo '</div>';
						echo '</div>';
						}?>
					
						<form action="manageTags.php" method="POST">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
									<label>Category Name</label>
									<input class="text-input small-input" type="text" id="small-input" name="name" required/> <!--<span class="input-notification error png_bg">Error message</span>-->
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
