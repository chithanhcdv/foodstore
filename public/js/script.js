
$(document).ready(function(){
    // Chuyển slide sau mỗi 3 giây
    $('.carousel').carousel({
    interval: 3000
    });

    // Ẩn, hiện mật khẩu form đăng ký
    $('#register-show-password').click(function(){
        var passwordInput = $('#register-password');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
        $('#register-show-password').toggleClass('fa-eye fa-eye-slash');
    });

    $('#register-show-re_password').click(function(){
        var passwordInput = $('#register-re_password');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
        $('#register-show-re_password').toggleClass('fa-eye fa-eye-slash');
    });

    // Ẩn, hiện mật khẩu form đăng nhập
    $('#login-show-password').click(function(){
        var passwordInput = $('#login-password');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
        $('#login-show-password').toggleClass('fa-eye fa-eye-slash');
    });

    // Ẩn, hiện mật khẩu form đổi mật khẩu
    $('#change_pass-show-password').click(function(){
        console.log('a');
        var passwordInput = $('#change_pass-password');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
        $('#change_pass-show-password').toggleClass('fa-eye fa-eye-slash');
    });

    $('#change_pass-show-new_password').click(function(){
        console.log('a');
        var passwordInput = $('#change_pass-new_password');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
        $('#change_pass-show-new_password').toggleClass('fa-eye fa-eye-slash');
    });

    $('#change_pass-show-renew_password').click(function(){
        console.log('a');
        var passwordInput = $('#change_pass-renew_password');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
        $('#change_pass-show-renew_password').toggleClass('fa-eye fa-eye-slash');
    });
    

    // hiện lỗi khi nhập không đúng yêu cầu của form
    var usernameInput = $('input[name="username"]');
    var passwordInput = $('input[name="password"]');
    var re_passwordInput  = $('input[name="re_password"]');
    var new_passwordInput  = $('input[name="new_password"]');
    var renew_passwordInput  = $('input[name="renew_password"]');
    var usernameError = $('.username-error');
    var passwordError = $('.password-error');
    var re_passwordError = $('.re_password-error');
    var new_passwordError = $('.new_password-error');
    var renew_passwordError = $('.renew_password-error');

    usernameInput.on('input', function () {
        validateInput(usernameInput, usernameError, 'Tên tài khoản phải chứa từ 3 đến 20 ký tự và chỉ bao gồm chữ cái và số');
    });

    passwordInput.on('input', function () {
        validateInput(passwordInput, passwordError, 'Mật khẩu phải chứa từ 6 đến 20 ký tự');
    });

    re_passwordInput.on('input', function () {
        validateInput(re_passwordInput, re_passwordError, 'Mật khẩu phải chứa từ 6 đến 20 ký tự');  
    });

    new_passwordInput.on('input', function () {
        validateInput(new_passwordInput, new_passwordError, 'Mật khẩu phải chứa từ 6 đến 20 ký tự');  
    });

    renew_passwordInput.on('input', function () {
        validateInput(renew_passwordInput, renew_passwordError, 'Mật khẩu phải chứa từ 6 đến 20 ký tự');  
    });

    function validateInput(input, errorElement, errorMessage) {
        var isValid = input[0].checkValidity();

        if (!isValid) {
            errorElement.text(errorMessage);
            errorElement.css('color', 'red');
            $('.show-password').css('top', '20px');
        } else {
            errorElement.text('');
        }
    }


    /* scroll */
    var scroll = $('.scroll');
    var sticky = scroll.offset().top;

    $(window).scroll(function(){
        if(window.pageYOffset > sticky){
            scroll.addClass("fixed");
        } else{
            scroll.removeClass("fixed");
        }
    });
});




