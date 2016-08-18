$(function() {

    $(document).ready(function() {
        $('#login-form').submit(submitLoginForm);
        $('#lost-form').submit(submitLostForm);
        $('#register-form').submit(submitRegistrationForm);
    });

    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

    $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
    $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });
    $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
    $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
    $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
    $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });

    function submitLoginForm(e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: $this.serialize(),
            dataType: "html",
            success: function (data) {
                if ($(data).find('.error').length) {
                    msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "Ошибка авторизации");
                } else {
                    msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "glyphicon-ok", "Вход на сайт произведен");
                    window.location.reload();
                }
            },
            error: function (data) {
                alert('Error');
            }
        })
    }

    function submitLostForm(e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: $this.serialize(),
            dataType: "html",
            success: function (data) {
                if ($(data).find('.send-email').length) {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Письмо отправлено Вам на почту");
                    setTimeout("$('span.glyphicon-remove').click()", 3000);
                } else if ($(data).find('.send-email-already').length) {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Письмо уже было отправлено на почту");
                } else  {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Ошибка, проверьте вводимые данные");
                }
            },
            error: function (data) {
                alert('Error');
            }
        })
    }

    function submitRegistrationForm(e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: $this.serialize(),
            dataType: "html",
            success: function (data) {
                var $error = $(data).find('li').text();
                if ($error.length) {
                    $('li', $(data)).each(function () {
                        var $error = ($(this).text());
                        switch ($error) {
                            case ' fos_user.email.invalid' :
                                msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Некорректно введен E-mail");
                                break;
                            case ' fos_user.username.already_used' :
                                msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Указанный логин уже занят");
                                break;
                            case ' fos_user.email.already_used' :
                                msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Указанный E-mail уже занят");
                                break;
                            case ' fos_user.username.short' :
                                msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Логин слишком короткий");
                                break;
                            case ' fos_user.password.mismatch' :
                                msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Пароли не совпадают");
                                break;
                            case ' fos_user.password.short' :
                                msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Пароль слишком короткий");
                                break;
                        }
                    });
                } else if ($(data).find('p.registration-confirmed').length) {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Регистрация завершена");
                    setTimeout("$('span.glyphicon-remove').click()", 3000);
                    window.location.reload();
                } else {
                    alert("Error");
                }
            },
            error: function (data) {
                alert('Error');
            }
        })
    }

    function modalAnimate ($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function(){
            $divForms.animate({height: $newH}, $modalAnimateTime, function(){
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }

    function msgFade ($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function() {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }

    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function() {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("glyphicon-chevron-right");
            $iconTag.removeClass($iconClass + " " + $divClass);
        }, $msgShowTime);
    }
});
