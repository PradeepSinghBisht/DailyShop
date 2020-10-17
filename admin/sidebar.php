<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->

    <?php $filename = basename($_SERVER['REQUEST_URI']);
            //echo $filename;
            $productmenu = array('addProduct.php','manageProduct.php','manageCategories.php','manageTags.php','manageColors.php');
            $usermenu = array('addUser.php','manageUser.php');
    ?>
			
    <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
    
    <!-- Logo (221px wide) -->
    <a href="#"><img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" /></a>
    
    <!-- Sidebar Profile links -->
    <div id="profile-links">
        Hello, <a href="#" title="Edit your profile">John Doe</a>, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a><br />
        <br />
        <a href="#" title="View the Site">View the Site</a> | <a href="#" title="Sign Out">Sign Out</a>
    </div>        
    
    <ul id="main-nav">  <!-- Accordion Menu -->
        
        <li>
            <a href="http://www.google.com/" class="nav-top-item no-submenu"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
                Dashboard
            </a>       
        </li>
        
        <li> 
            <a href="#" class="nav-top-item <?php if (in_array($filename, $productmenu)): ?> current <?php endif; ?> "> <!-- Add the class "current" to current menu item -->
            Products
            </a>
            <ul>
                <li><a <?php if($filename == 'addProduct.php'):?> class="current" <?php endif; ?> href="addProduct.php">Add Product</a></li>
                <li><a <?php if($filename == 'manageProduct.php'):?> class="current" <?php endif; ?> href="manageProduct.php">Manage Product</a></li> <!-- Add class "current" to sub menu items also -->
                <li><a <?php if($filename == 'manageCategories.php'):?> class="current" <?php endif; ?> href="manageCategories.php">Manage Categories</a></li>
                <li><a <?php if($filename == 'manageTags.php'):?> class="current" <?php endif; ?> href="manageTags.php">Manage Tags</a></li>
                <li><a <?php if($filename == 'manageColors.php'):?> class="current" <?php endif; ?> href="manageColors.php">Manage Colors</a></li>    
            </ul>
        </li>
        
        <li>
            <a href="#" class="nav-top-item <?php if(in_array($filename, $usermenu)):?> current <?php endif; ?>">
                Users
            </a>
            <ul>
                <li><a <?php if($filename == 'addUser.php'):?> class="current" <?php endif; ?> href="addUser.php">Add User</a></li>
                <li><a <?php if($filename == 'manageUser.php'):?> class="current" <?php endif; ?> href="manageUser.php">Manage User</a></li>
            </ul>
        </li>
        
        <li>
            <a href="#" class="nav-top-item <?php if($filename == 'manageOrder.php'):?> current <?php endif; ?>">
                Orders
            </a>
            <ul>    
                <li><a <?php if($filename == 'manageOrder.php'):?> class="current" <?php endif; ?> href="manageOrder.php">Manage Order</a></li>
            </ul>
        </li>

        <li>
            <a href="#" class="nav-top-item <?php if($filename == 'general.php'):?> current <?php endif; ?>">
                Settings
            </a>
            <ul>
                <li><a <?php if($filename == 'general.php'):?> class="current" <?php endif; ?> href="general.php">General</a></li>
            </ul>
        </li>      
        
    </ul> <!-- End #main-nav -->
    
    <div id="messages" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
        
        <h3>3 Messages</h3>
        
        <p>
            <strong>17th May 2009</strong> by Admin<br />
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
            <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
        </p>
        
        <p>
            <strong>2nd May 2009</strong> by Jane Doe<br />
            Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.
            <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
        </p>
        
        <p>
            <strong>25th April 2009</strong> by Admin<br />
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
            <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
        </p>
        
        <form action="#" method="post">
            
            <h4>New Message</h4>
            
            <fieldset>
                <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
            </fieldset>
            
            <fieldset>
            
                <select name="dropdown" class="small-input">
                    <option value="option1">Send to...</option>
                    <option value="option2">Everyone</option>
                    <option value="option3">Admin</option>
                    <option value="option4">Jane Doe</option>
                </select>
                
                <input class="button" type="submit" value="Send" />
                
            </fieldset>
            
        </form>
        
    </div> <!-- End #messages -->
        
    </div></div> <!-- End #sidebar -->