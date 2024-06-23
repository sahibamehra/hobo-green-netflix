    <?php session_start(); ?>

    <!-- Header Logic goes here - Start -->
    <header>
        <div class="search-box">
            <form name="searchSeries" action="/green-netflix/views/serie/default.php" method="POST">
                <input type="text" name="keyword" placeholder="Search by title">
                <span class="search-icon" onClick="searchSeries.submit();">🔍</span>
            </form>
        </div>

        <div id="user_text" class="MyText">
            <div id="user_login_text" class="MyText">
                <span id="user_login_name" style="display:none"></span>
                <span id="user_login_link" style="display:none;cursor:pointer;" onclick="openOverlay();">
                    <button type="submit" style="background-color:#0dff00; color:black"><b>Login</b></button>
                </span>
                <span id="user_logout_link" style="display:none;cursor:pointer;" onclick="logout();">
                    <button type="submit" style="background-color: #ef312f;"><b>Logout</b></button>
                </span>
            </div>
        </div>


    </header>
    <!-- Header Logic goes here - End -->

    <div id="login_overlay" class="login_overlay" style="display:none">
        <div class="login_overlay-content" >
            <span class="login_close-btn" onclick="closeOverlay()">&times;</span>
            <h2 class="MyText">Login</h2>
            <form id="login_form" method="POST" >
                <label class="MyText2" for="username">Username:</label>
                <input class="login_input" type="text" id="username" name="username" value="josh@sdafsdf.com" required>
                <label class="MyText2" for="password">Password:</label>
                <input class="login_input" type="password" id="password" name="password" value="abc123" required>
                <button type="submit" style="background-color:#0dff00; color:black"><b>Login</b></button>
            </form>
        </div>
    </div>
    <div id="logout_overlay" class="login_overlay" style="display: none;">
        <div class="login_overlay-content">
        <span class="login_close-btn" onclick="sendToHome()">&times;</span>
            <p>You have successfully logged out.</p>
        </div>
    </div>    

    <div id="welcome_overlay" class="login_overlay" style="display: none;">
        <div class="login_overlay-content">
        <span class="login_close-btn" onclick="sendToHome()">&times;</span>
            <span id="welcome_overlay_login_name" style="display:none"></span>
            <p>Welcome to HOBO! <BR>You have successfully logged in.</p>
        </div>
    </div>    

    <script>

        function openOverlay() {
            document.getElementById('login_overlay').style.display = 'flex';
        }

        function closeOverlay() {
            document.getElementById('login_overlay').style.display = 'none';
            document.getElementById('logout_overlay').style.display = 'none';
        }

        function IsLoggedIn() {
            fetch('/green-netflix/views/login?action=getuser', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
            })
            .then( response => {
                    if (!response.ok) {
                        throw new Error(response)
                    }
                    return response.json()
                })
                .catch( err => {
                    console.log(err.message);
                })
            .then(data => {
                console.log(data);
                if (data.status === 'success') {

                    if (data.message === 'LoggedOut') {
                        document.getElementById('user_login_name').style.display = 'none';
                        document.getElementById('user_logout_link').style.display = 'none';
                        document.getElementById('user_login_link').style.display = 'flex';
                    }else{
                        str = "Welcome " + data.user;
                        document.getElementById('user_login_name').innerHTML = str;
                        document.getElementById('user_login_name').style.display = 'flex';
                        document.getElementById('user_logout_link').style.display = 'flex';
                        document.getElementById('user_login_link').style.display = 'none';
                    }

                } 
            });
        }
   
        function sendToHome() {
            closeOverlay();
            document.location.href = "/green-netflix";
        }

        function logout() {
            fetch('/green-netflix/views/login?action=logout', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
            })
            .then( response => {
                    if (!response.ok) {
                        throw new Error(response)
                    }
                    return response.json()
                })
                .catch( err => {
                    console.log(err.message);
                })
            .then(data => {
                document.getElementById('logout_overlay').style.display = 'flex';
            });

            IsLoggedIn();
        }
   
        

        document.getElementById('login_form').addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        formSpType="N";
        if(document.getElementById('login_form_adminForm')){
            formSpType="Y";
        }

        fetch('/green-netflix/views/login/default.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username: username, password: password, formSpType: formSpType })
        })
        .then( response => {
                if (!response.ok) {
                throw new Error(response)
                }
                return response.json()
            })
            .catch( err => {
                console.log(err.message);
            })
        .then(data => {
            console.log(data);
            if (data.status === 'success') {
                document.getElementById('login_overlay').style.display = 'none';
                //document.getElementById('welcome_overlay_login_name').innerHTML = str;
                document.getElementById('welcome_overlay').style.display = 'flex';
                //IsLoggedIn();
            } else {
                document.getElementById('login_error').innerText = data.message;
            }
        });
    });

    document.getElementById('welcome_overlay').style.display = 'none';
    IsLoggedIn();
    </script>