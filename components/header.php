<?php if (isset($_SESSION['error']) && $_SESSION['error'] != null) { ?>
    <div style="background-color: #F8D7DA; color: #721c24;  padding: 10px 15px; text-align: center;"><?php echo $_SESSION['error']; ?></div>
    <?php $_SESSION['error'] = null; ?>
<?php } ?>
<?php if (isset($_SESSION['message']) && $_SESSION['message'] != null) { ?>
    <div style="background-color: #d4edda; color: #155724;  padding: 10px 15px; text-align: center;"><?php echo $_SESSION['message']; ?></div>
    <?php $_SESSION['message'] = null;?>
<?php } ?>
<div class="head">
    <p id="address"><i class="fas fa-map-marker-alt"></i> &nbsp; 500 Terry Francois Street San Francisco, CA 94158
    </p>
    <p id="number"><i class="fas fa-phone-alt "></i>&nbsp; Tel:012 345 678</p>
</div>
<div class="header">
    <img class="header-img" src="photos/logo.png" alt=""/>
    <ul class="header-ul">
        <li><a href="/medical-clinic"><i class="fas fa-home"></i> HOME</a></li>
        <li><a href="/medical-clinic/about.php"><i class="fas fa-address-card"></i> ABOUT US</a></li>
        <li><a href="/medical-clinic/departments.php"><i class="fas fa-building"></i> DEPARTMENTS</a></li>
        <li><a href="/medical-clinic/contact.php"><i class="fas fa-id-badge"></i> CONTACT</a></li>
        <li><a href="/medical-clinic/admin"><i class="fas fa-user-alt"></i> Admin</a></li>

        <?php if (!isset($_SESSION['email'])) { ?>
            <li><a onclick="document.getElementById('id01').style.display='block'" href="#" class="login-button"><i
                        class="fas fa-sign-in-alt"></i> Login</a></li>
        <?php } else { ?>
            <li><a href="#"> <?php echo $_SESSION['name'] ?></a> * <a href="/medical-clinic/logout.php">Log out</a> </li>
        <?php } ?>
    </ul>


    <div id="id01" class="modal">
        <div class="modal-content animate" >
            <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close"
                  title="Close Modal">&times;</span>
                <img src="photos/logo.png" alt="Avatar" class="avatar">
            </div>
            <div class="link-container">
                <button type="button" id="firstA" href="#" onclick="changeForm(0)">Login</button>
                <button type="button" href="#" onclick="changeForm(1)">Register</button>
            </div>
            <div class="container forms form-style">
                <form action="/medical-clinic/login.php" method="post" >
                    <label><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="email" required>

                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                    <button name="submit" type="submit" id="login">Login</button>
                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                class="cancelbtn">Cancel
                        </button>
                        <span class="psw"><a href="#">Forgot password?</a></span>

                    </div>
                </form>
            </div>
            <div class="register forms hidden">
                <form  action="/medical-clinic/register.php" method="post">
                    <label><b>Name</b></label>
                    <input type="text" placeholder="Enter name" name="name" required>
                    <label><b>Surname</b></label>
                    <input type="text" placeholder="Enter surname" name="surname" required>
                    <label><b>Email</b></label>
                    <input type="email" placeholder="Enter Email Address" name="email" required>
                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    <label><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat Password" name="rp_password" required>
                    <label>
                        <button id="submit" type="submit" name='register' class="input submit" value="">Register
                        </button>
                </form>

            </div>


        </div>
    </div>
    <script src="/medical-clinic/javascript/login.js"></script>

</div>
