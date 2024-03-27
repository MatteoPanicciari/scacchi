function eye_pwd(){
    const togglePassword = document.querySelector('#pwd_eye')
    const password = document.querySelector('#pwd')

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password'
        password.setAttribute('type', type)
        // toggle the eye / eye slash icon
        this.classList.toggle('fa-eye-slash')
    });
}

function eye_two_pwd(){
    const togglePassword = document.querySelector('#pwd_eye')
    const password = document.querySelector('#pwd')
    const password2 = document.querySelector('#pwd2')

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password'
        password.setAttribute('type', type)
        password2.setAttribute('type', type)
        // toggle the eye / eye slash icon
        this.classList.toggle('fa-eye-slash')
        togglePassword.classList.toggle('fa-eye-slash')
    });
}