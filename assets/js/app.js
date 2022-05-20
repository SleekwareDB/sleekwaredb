const $ = require('jquery')
require('popper.js')
require('bootstrap')
const Swal = require('sweetalert2')
const { base_url, make_alert } = require('./helpers/app')
if (document.querySelector('.main-header')) {
    require('./components/customized')
}
require('./components/teamMember')
require('admin-lte')

$.noConflict();
(function ($) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    // SignUp Process
    $(document).on('submit', '#signUpForm', function (e) {
        e.preventDefault()
        var formData = $(this).serializeArray()
        $.post(base_url('ajax/auth/create_account'), formData)
            .done(function (response) {
                Toast.fire({
                    icon: response.type,
                    title: response.msg
                }).then(function () {
                    window.location.href = base_url('auth_signin')
                })
                console.log(response)
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                let response = jqXHR.responseJSON
                Toast.fire({
                    icon: response.type,
                    title: response.msg
                })
                console.log(jqXHR.responseJSON)
            })
        return false
    })

    // Singin Process
    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault()
        var formData = $(this).serializeArray()
        $.post(base_url('ajax/auth/sign_in'), formData)
            .done(function (response) {
                Toast.fire({
                    icon: response.type,
                    title: response.msg
                }).then(function () {
                    window.location.href = base_url('dashboard')
                })
                console.log(response)
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                let response = jqXHR.responseJSON
                Toast.fire({
                    icon: response.type,
                    title: response.msg
                })
                console.log(jqXHR.responseJSON)
            })
        return false
    })

    // Logout Process
    $(document).on('click', '#logoutButton', function (e) {
        e.preventDefault()
        // SweetAlert Confirm Alert
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Logout!'
        }).then((result) => {
            if (result.value) {
                $.post(base_url('ajax/auth/logout'))
                    .done(function (response) {
                        Toast.fire({
                            icon: response.type,
                            title: response.msg
                        }).then(function () {
                            window.location.href = base_url()
                        })
                        console.log(response)
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        let response = jqXHR.responseJSON
                        Toast.fire({
                            icon: response.type,
                            title: response.msg
                        })
                        console.log(jqXHR.responseJSON)
                    })
            }
        })
        return false
    })

    // Install form Process
    $(document).on('submit', '#installForm', function (e) {
        e.preventDefault();
        var form = $(this)[0]
        if (form.checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
        } else {
            var formData = $(this).serializeArray()
            $.post(base_url('ajax/auth/install'), formData)
                .done(function (response) {
                    Toast.fire({
                        icon: response.type,
                        title: response.msg
                    }).then(function () {
                        window.location.href = base_url()
                    })
                    console.log(response)
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    let response = jqXHR.responseJSON
                    Toast.fire({
                        icon: response.type,
                        title: response.msg
                    })
                    console.log(jqXHR.responseJSON)
                })
        }
        form.classList.add('was-validated');
        return false
    })

})($)

