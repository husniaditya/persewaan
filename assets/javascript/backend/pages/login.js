/* ========================================================================
 * login.js
 * Page/renders: page-login.html
 * Plugins used: parsley
 * ======================================================================== */

'use strict';

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define([
            'parsley'
        ], factory);
    } else {
        factory();
    }
}(function () {

    $(function () {
        // Login form function
        // ================================
        var $form    = $('form[name=form-login]');

        // On button submit click
        $form.on('click', 'button[type=submit]', function (e) {
            e.preventDefault();
            const $this = $(this);
            
            if ($form.parsley().validate()) {
                $this.prop('disabled', true);
                NProgress.start();
        
                const username = $('#USERNAME').val();
                const password = $('#PASSWORD').val();
        
                $.ajax({
                    url: 'module/backend/loginprofil/login/t_login.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { username, password },
                    success: function (response) {
                        NProgress.done();
                        $this.prop('disabled', false);
        
                        if (response.status === 'success') {
                            window.location.href = response.redirect;
                        } else {
                            $('#error-container').removeClass('hidden').css('color', 'red').text(response.message);
                        }
                    },
                    error: function () {
                        NProgress.done();
                        $this.prop('disabled', false);
                        $('#error-container').removeClass('hidden').text('An unexpected error occurred.');
                    }
                });
            }
        });     
    });

}));