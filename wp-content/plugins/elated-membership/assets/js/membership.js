(function ($) {
    "use strict";

    var socialLogin = {};
    if ( typeof eltdf !== 'undefined' ) {
        eltdf.modules.socialLogin = socialLogin;
    }

    socialLogin.eltdfUserLogin = eltdfUserLogin;
    socialLogin.eltdfUserRegister = eltdfUserRegister;
    socialLogin.eltdfUserLostPassword = eltdfUserLostPassword;
    socialLogin.eltdfInitLoginWidgetModal = eltdfInitLoginWidgetModal;
    socialLogin.eltdfUpdateUserProfile = eltdfUpdateUserProfile;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitLoginWidgetModal();
        eltdfUserLogin();
        eltdfUserRegister();
        eltdfUserLostPassword();
        eltdfUpdateUserProfile();
    }

    /**
     * All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function eltdfOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
    }

    /**
     * Initialize login widget modal
     */
    function eltdfInitLoginWidgetModal() {

        var modalOpener = $('.eltdf-login-opener'),
            modalHolder = $('.eltdf-login-register-holder');

        if (modalOpener) {
            var tabsHolder = $('.eltdf-login-register-content');

            //Init opening login modal
            modalOpener.click(function (e) {
                e.preventDefault();
                modalHolder.fadeIn(300);
                modalHolder.addClass('opened');
            });

            //Init closing login modal
            modalHolder.click(function (e) {
                if (modalHolder.hasClass('opened')) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });
            $('.eltdf-login-register-content').click(function (e) {
                e.stopPropagation();
            });
            // on esc too
            $(window).on('keyup', function (e) {
                if (modalHolder.hasClass('opened') && e.keyCode == 27) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });

            //Init tabs
            tabsHolder.tabs();
        }
    }

    /**
     * Login user via Ajax
     */
    function eltdfUserLogin() {
        $('.eltdf-login-form').on('submit', function (e) {
            e.preventDefault();
            var ajaxData = {
                action: 'eltdf_membership_login_user',
                security: $(this).find('#eltdf-login-security').val(),
                login_data: $(this).serialize()
            };
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdfRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }

            });
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function eltdfUserRegister() {

        $('.eltdf-register-form').on('submit', function (e) {

            e.preventDefault();
            var ajaxData = {
                action: 'eltdf_membership_register_user',
                security: $(this).find('#eltdf-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdfRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

            return false;
        });
    }

    /**
     * Reset user password
     */
    function eltdfUserLostPassword() {

        var lostPassForm = $('.eltdf-reset-pass-form');
        lostPassForm.submit(function (e) {
            e.preventDefault();
            var data = {
                action: 'eltdf_membership_user_lost_password',
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: ElatedAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    eltdfRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Response notice for users
     * @param response
     */
    function eltdfRenderAjaxResponseMessage(response) {

        var responseHolder = $('.eltdf-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.eltdf-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'eltdf-membership-message-succes';
        } else {
            messageClass = 'eltdf-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);
    }

    /**
     * Update User Profile
     */
    function eltdfUpdateUserProfile() {
        var updateForm = $('#eltdf-membership-update-profile-form');
        if ( updateForm.length ) {
            var btnText = updateForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            updateForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'eltdf_membership_update_user_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: ElatedAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        eltdfRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                            window.location = response.redirect;
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

})(jQuery);