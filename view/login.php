<section id='login-box'>
    <i class ="fa fa-5x fa-user"></i><br>
    <b>Welcome</b>
    <br><br>
    <form action="login" method="post">
        <input type="email" name='email' placeholder="Email"><br>
        <input type="password" name='password' placeholder="Password" maxlength="20"><br>
        <?php
            if ($message != ""){
                echo "<span id='msg'>". $message ."</span><br>";
            }
        ?>
        <button>Login</button>
    </form>
</section>