const $ = require('jquery')
const Swal = require('sweetalert2')
const dt = require('datatables.net')(window, $)
require('datatables.net-bs4')(window, $)
window.DataTable = dt
const toastr = require('toastr')

$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

const helper = {
    make_alert: function (type, message, position = 'top', timeOut = 2500) {
        const Toast = Swal.mixin({
            toast: true,
            position: position,
            showConfirmButton: false,
            timer: timeOut,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: type,
            title: message
        })
    },
    printMessage: function (data) {
        console.log(data)
    },
    base_url: function (pathUri) {
        return window.location.protocol + '//' + window.location.hostname + '/' + ((pathUri) ? pathUri.replace(/^\/|\/$/g, '') : '');
    },
    xRequest: function (url, method = 'GET', data = null, dataType = 'json') {
        var theResponse = null;
        var method = method.toUpperCase();
        switch (method) {
            case 'GET':
                $.ajax({
                    url: url,
                    type: method,
                    dataType: dataType,
                    async: false,
                    success: function (responseText) {
                        theResponse = responseText;
                    }
                });
                break;
            case 'POST':
                $.ajax({
                    url: url,
                    type: method,
                    dataType: dataType,
                    data: data,
                    async: false,
                    success: function (responseText) {
                        theResponse = responseText;
                    }
                });
                break;
        }
        return theResponse;
    },
    set_modal_size: function (instance, modal_size) {
        switch (modal_size) {
            case 'modal-xl':
                instance.find('.modal-dialog').removeClass('modal-sm');
                instance.find('.modal-dialog').removeClass('modal-md');
                instance.find('.modal-dialog').removeClass('modal-lg');
                instance.find('.modal-dialog').addClass('modal-xl');
                break;
            case 'modal-lg':
                instance.find('.modal-dialog').removeClass('modal-sm');
                instance.find('.modal-dialog').removeClass('modal-md');
                instance.find('.modal-dialog').removeClass('modal-xl');
                instance.find('.modal-dialog').addClass('modal-lg');
                break;
            case 'modal-md':
                instance.find('.modal-dialog').removeClass('modal-sm');
                instance.find('.modal-dialog').removeClass('modal-lg');
                instance.find('.modal-dialog').removeClass('modal-xl');
                instance.find('.modal-dialog').addClass('modal-md');
                break;
            case 'modal-sm':
                instance.find('.modal-dialog').removeClass('modal-md');
                instance.find('.modal-dialog').removeClass('modal-lg');
                instance.find('.modal-dialog').removeClass('modal-xl');
                instance.find('.modal-dialog').addClass('modal-sm');
                break;
        }
    },
    set_modal_title: function (instance, text) {
        instance.find('.modal-title').text(text);
    },
    set_modal_body: function (instance, template) {
        instance.find('.modal-body').html(template);
    },
    set_modal_footer: function (instance, buttonCancelText = 'Batal', buttonSubmitText = 'Simpan', buttonCenter = false, btnSubmitClass = null, template = null, hide_footer = false) {
        if (hide_footer == false) {
            if (buttonCenter == false) {
                instance.find('.modal-footer').removeClass('d-flex align-items-center justify-content-center');
            }

            if (template == null) {
                instance.find('.modal-footer').removeClass('d-none').html(`
            <button type="button" class="btn btn-secondary" data-dismiss="modal">${buttonCancelText}</button>
            <button type="submit" class="btn ${(btnSubmitClass == null) ? 'btn-primary' : btnSubmitClass}">${buttonSubmitText}</button>
            `);
            } else {
                instance.find('.modal-footer').removeClass('d-none').html(template);
            }
        } else {
            instance.find('.modal-footer').removeClass('d-flex align-items-center justify-content-center').addClass('d-none');
        }
    },
    set_modal_display: function (instance, mode, closeOnclickOutside = false) {
        if (mode == 'show' && closeOnclickOutside == false) {
            instance.modal({
                backdrop: 'static',
                keyboard: false
            });
        }
        instance.modal(mode);
        $('#form-data').removeClass('was-validated');
    },
    autoSaveIndicator: function() {
        $('.autoSaveIndicator').removeClass('badge badge-danger').addClass('badge badge-success').html("Data saved")
        setTimeout(function () {
            $('.autoSaveIndicator').removeClass('badge badge-success').addClass('badge badge-danger').html("Data not saved")
        }, 10000)
    }
}
module.exports = helper
