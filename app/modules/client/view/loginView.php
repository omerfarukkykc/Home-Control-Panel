        <div class="login">
            <div class="login-header"> 
                <a href="login.php">
                    <strong>User Login</strong>
                </a>
            </div>    
            <form method="POST" action="">
                <div class="errorMessage">
                <span id="errorMessage"></span>
                </div>
                <label for="username"><b>Username</b></label>
                <div class="inputrow">
                    <i class="fas fa-user"></i>
                    <input id="username" type="text" name="username" placeholder="Username" required >
                </div>
                <label for="password"><b>Password</b></label>
                <div class="inputrow">
                    <i class="fas fa-key"></i>
                    <input id="password" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="submit-div" >
                    <button type="submit">Giriş</button>
                </div>
                <div class="social">
                    <a href="#" class="social"><i class="fa fa-facebook fa-lg"></i></a>
                    <a href="#" class="social"><i class="fa fa-instagram fa-lg"></i></a>
				    <a href="#" class="social"><i class="fa fa-linkedin fa-lg"></i></a>
                </div>
            </form>
        </div>        
        