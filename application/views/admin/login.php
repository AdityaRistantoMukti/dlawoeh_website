<body style="background: #b80d0d; 
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;  
    margin: 0;">

<div class="wrapper ">
    <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "gagal") {
                echo "<div class='alert alert-danger'>Login gagal! Username dan password salah.</div>";
            } else if ($_GET['pesan'] == "logout") {
                echo "<div class='alert alert-info'>Anda telah logout.</div>";
            } else if ($_GET['pesan'] == "belumlogin") {
                echo "<div class='alert alert-warning text-center'>Silahkan login dulu.</div>";
            }
        }
        ?>
        <div class="logo">
            <img src="<?php echo base_url().'assets/logo/Logo.png' ?>" alt="">
        </div>
        <div class="text-center mt-4 name ">
            Admin
        </div>
        <form class="p-3 mt-3" method="post" action="<?php echo site_url('auth/login_admin') ?>">
        <div class="d-flex">
            <span class="far fa-user mt-3 " style="margin-right: -23px; z-index:1000;"></span>
            <div class="form-field align-items-center">
                    <input type="text" name="username" id="username" placeholder="Username" style="padding-left:30px">
                </div>
        </div>
        <div class="d-flex">
                <span class="fas fa-key mt-3 " style="margin-right: -23px; z-index:1000; color: #555;"></span>
                <div class="form-field align-items-center " style="padding-left:20px">
                     <input type="password" name="password" id="password" placeholder="Password">
                </div>
        </div>
        
        
            <button class="btn mt-3">Login</button>
        </form>
        <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="#">Sign up</a>
        </div>
    </div>    
</body>
 
