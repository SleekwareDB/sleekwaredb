$(document).ready(function() {
    // Load the app personalize
    const appPersonalize = {
        configure: function() {
            this.darkMode();
            this.layoutNavbarFixed();
            this.dropdownLegacyOffset();
            this.noBorder();
            this.sidebarCollapse();
            this.layoutFixed();
            this.sidebarMini();
            this.sidebarMiniMD();
            this.sidebarMiniXS();
            this.navFlat();
            this.navLegacy();
            this.navCompact();
            this.navChildIndent();
            this.navChildHide();
            this.navNoExpand();
            this.layoutFooterFixed();
            this.textSmBody();
            this.textSmHeader();
            this.textSmBrand();
            this.textSmSidebar();
            this.textSmFooter();
            this.navbarVariant();
            this.AccentColorVariants();
            this.DarkSidebarVariants();
            this.LightSidebarVariants();
            this.logoSkin();
        },
        darkMode: function () {
            if (localStorage.getItem('darkMode') === 'true') {
                $('body').addClass('dark-mode');
            } else {
                $('body').removeClass('dark-mode');
            }
        },
        layoutNavbarFixed: function () {
            if (localStorage.getItem('layoutNavbarFixed') === 'true') {
                $('body').addClass('layout-navbar-fixed');
            } else {
                $('body').removeClass('layout-navbar-fixed');
            }
        },
        dropdownLegacyOffset: function () {
            if (localStorage.getItem('dropdownLegacyOffset') === 'true') {
                $('.main-header').addClass('dropdown-legacy-offset');
            } else {
                $('.main-header').removeClass('dropdown-legacy-offset');
            }
        },
        noBorder: function () {
            if (localStorage.getItem('noBorder') === 'true') {
                $('.main-header').addClass('no-border');
            } else {
                $('.main-header').removeClass('no-border');
            }
        },
        sidebarCollapse: function () {
            if (localStorage.getItem('sidebarCollapse') === 'true') {
                $('body').addClass('sidebar-collapse');
            } else {
                $('body').removeClass('sidebar-collapse');
            }
        },
        layoutFixed: function () {
            if (localStorage.getItem('layoutFixed') === 'true') {
                $('body').addClass('layout-fixed');
            } else {
                $('body').removeClass('layout-fixed');
            }
        },
        sidebarMini: function () {
            if (localStorage.getItem('sidebarMini') === 'true') {
                $('body').addClass('sidebar-mini');
            } else {
                $('body').removeClass('sidebar-mini');
            }
        },
        sidebarMiniMD: function () {
            if (localStorage.getItem('sidebarMiniMD') === 'true') {
                $('body').addClass('sidebar-mini-md');
            } else {
                $('body').removeClass('sidebar-mini-md');
            }
        },
        sidebarMiniXS: function () {
            if (localStorage.getItem('sidebarMiniXS') === 'true') {
                $('body').addClass('sidebar-mini-xs');
            } else {
                $('body').removeClass('sidebar-mini-xs');
            }
        },
        navFlat: function () {
            if (localStorage.getItem('navFlat') === 'true') {
                $('.nav-sidebar').addClass('nav-flat');
            } else {
                $('.nav-sidebar').removeClass('nav-flat');
            }
        },
        navLegacy: function () {
            if (localStorage.getItem('navLegacy') === 'true') {
                $('.nav-sidebar').addClass('nav-legacy');
            } else {
                $('.nav-sidebar').removeClass('nav-legacy');
            }
        },
        navCompact: function () {
            if (localStorage.getItem('navCompact') === 'true') {
                $('.nav-sidebar').addClass('nav-compact');
            } else {
                $('.nav-sidebar').removeClass('nav-compact');
            }
        },
        navChildIndent: function () {
            if (localStorage.getItem('navChildIndent') === 'true') {
                $('.nav-sidebar').addClass('nav-child-indent');
            } else {
                $('.nav-sidebar').removeClass('nav-child-indent');
            }
        },
        navChildHide: function () {
            if (localStorage.getItem('navChildHide') === 'true') {
                $('.nav-sidebar').addClass('nav-collapse-hide-child');
            } else {
                $('.nav-sidebar').removeClass('nav-collapse-hide-child');
            }
        },
        navNoExpand: function () {
            if (localStorage.getItem('navNoExpand') === 'true') {
                $('.main-sidebar').addClass('sidebar-no-expand');
            } else {
                $('.main-sidebar').removeClass('sidebar-no-expand');
            }
        },
        layoutFooterFixed: function () {
            if (localStorage.getItem('layoutFooterFixed') === 'true') {
                $('body').addClass('layout-footer-fixed');
            } else {
                $('body').removeClass('layout-footer-fixed');
            }
        },
        textSmBody: function () {
            if (localStorage.getItem('textSmBody') === 'true') {
                $('body').addClass('text-sm');
            } else {
                $('body').removeClass('text-sm');
            }
        },
        textSmHeader: function () {
            if (localStorage.getItem('textSmHeader') === 'true') {
                $('.main-header').addClass('text-sm');
            } else {
                $('.main-header').removeClass('text-sm');
            }
        },
        textSmBrand: function () {
            if (localStorage.getItem('textSmBrand') === 'true') {
                $('.brand-link').addClass('text-sm');
            } else {
                $('.brand-link').removeClass('text-sm');
            }
        },
        textSmSidebar: function () {
            if (localStorage.getItem('textSmSidebar') === 'true') {
                $('.nav-sidebar').addClass('text-sm');
            } else {
                $('.nav-sidebar').removeClass('text-sm');
            }
        },
        textSmFooter: function () {
            if (localStorage.getItem('textSmFooter') === 'true') {
                $('.main-footer').addClass('text-sm');
            } else {
                $('.main-footer').removeClass('text-sm');
            }
        },
        navbarVariant: function () {
            var color = localStorage.getItem('navbarVariant');
            if (color != null) {
                $('.main-header').addClass(color);
            }
        },
        AccentColorVariants: function () {
            var color = localStorage.getItem('AccentColorVariants');
            if (color != null) {
                var accent_color_class = color.replace('bg-', 'accent-')
                $('body').addClass(accent_color_class);
            }
        },
        DarkSidebarVariants: function () {
            var color = localStorage.getItem('DarkSidebarVariants');
            if (color != null) {
                var sidebar_class = 'sidebar-dark-' + color.replace('bg-', '')
                $('.main-sidebar').addClass(sidebar_class);
            }
        },
        LightSidebarVariants: function () {
            var color = localStorage.getItem('LightSidebarVariants');
            if (color != null) {
                var sidebar_class = 'sidebar-light-' + color.replace('bg-', '')
                $('.main-sidebar').addClass(sidebar_class);
            }
        },
        logoSkin: function () {
            var color = localStorage.getItem('logoSkin');
            if (color != null) {
                $('.brand-link').addClass(color);
            }
        }
    };

    appPersonalize.configure();

    // SignUp Process
    $(document).on('submit', '#signUpForm', function (e) {
        e.preventDefault()
        var formData = $(this).serializeArray()
        $.post(base_url('ajax/auth/create_account'), formData)
        .done(function(response) {
            Toast.fire({
                icon: response.type,
                title: response.msg
            }).then(function() {
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
        .done(function(response) {
            Toast.fire({
                icon: response.type,
                title: response.msg
            }).then(function() {
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
                .done(function(response) {
                    Toast.fire({
                        icon: response.type,
                        title: response.msg
                    }).then(function() {
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
            }
        })
        return false
    })
});
