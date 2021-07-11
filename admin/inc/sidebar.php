<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">

                <li><a class="menuitem">User Option</a>
                    <ul class="submenu">
                        <li><a href="useradd.php">Add User</a> </li>
                        <li><a href="userlist.php">User List</a> </li>
                    </ul>
                </li>

                <li><a class="menuitem">Message Option</a>
                    <ul class="submenu">
                        <li><a href="message_contact.php">Message
                            <?php
                                $contactmassage = $cmr->contactmassage();
                                if ($contactmassage) {
                                   $count = mysqli_num_rows($contactmassage);
                                    echo "(".$count.")";
                                    }else{
                                echo "(0)";
                                } 
                            ?>
                        </a> </li>
                        <li><a href="#">Seen Message</a> </li>
                        <li><a href="#">Save Message</a> </li>
                    </ul>
                </li>

               <li><a class="menuitem">Site Option</a>
                    <ul class="submenu">
                        <li><a href="titleslogan.php">Title & Slogan</a></li>
                        <li><a href="social.php">Social Media</a></li>
                        <li><a href="copyright.php">Copyright</a></li>
                        
                    </ul>
                </li>
				
                 <li><a class="menuitem">Update Pages</a>
                    <ul class="submenu">
                        <li><a>About Us</a></li>
                        <li><a>Contact Us</a></li>
                    </ul>
                </li>
				<li><a class="menuitem">Slider Option</a>
                    <ul class="submenu">
                        <li><a href="slideradd.php">Add Slider</a> </li>
                        <li><a href="sliderlist.php">Slider List</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Category Option</a>
                    <ul class="submenu">
                        <li><a href="catadd.php">Add Category</a> </li>
                        <li><a href="catlist.php">Category List</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Brand Option</a>
                    <ul class="submenu">
                        <li><a href="brandadd.php">Add Brand</a> </li>
                        <li><a href="brandlist.php">Brand List</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Product Option</a>
                    <ul class="submenu">
                        <li><a href="productadd.php">Add Product</a> </li>
                        <li><a href="productlist.php">Product List</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>