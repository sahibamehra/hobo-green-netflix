
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