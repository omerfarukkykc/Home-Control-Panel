/*Toast bildirimi için kullanılıyor*/
const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    /* Kapanır Sidebar animasyonu */

$('.menu-link-wrapper').on('click.mobileNav', function() {
    $('.sidebar').animate({ width: 'toggle' }, 120)
    $('.menu-link-wrapper .menu-link').toggleClass('menu-trigger-open');
    var sidebarStatus = $('#wrap').hasClass('sidebar-active');
    if (sidebarStatus) {
        $('#wrap').removeClass('sidebar-active')
        $('#wrap').addClass('sidebar-deactive')
    } else {
        $('#wrap').addClass('sidebar-active')
        $('#wrap').removeClass('sidebar-deactive')

    }
    Toast.fire({
        icon: 'success',
        title: 'Clicked Succesfuly'
    })
});


/*Ekran Uyumluluk Kodları*/
function menu() {
    if ($(window).width() > 1200) {
        $('.sidebar').show()
        $('#wrap').addClass('sidebar-active')
        $('#wrap').removeClass('sidebar-deactive')
        $('#hamburgerMenu').addClass('menu-trigger-open')
    } else {
        $('.sidebar').hide()
        $('#wrap').removeClass('sidebar-active')
        $('#wrap').addClass('sidebar-deactive')
        $('#hamburgerMenu').removeClass('menu-trigger-open')
    }
}

function header() {
    if ($(window).width() > 398) {
        $('.dropdown').removeClass('close')
    } else {
        $('.dropdown').addClass('close')
    }
}

function mini() {
    if ($(window).width() > 359) {
        $('.right').removeClass('close')
    } else {
        $('.right').addClass('close')
    }
}


$(document).ready(function() {
    menu()
    header()
    mini()

})
window.onresize = function(event) {
        menu()
        header()
        mini()

    }
    /*Accordion Menu mein*/



function changeValue(key, value) {
    $.ajax({
        url: "/client/centigrade",
        method: "POST",
        data: {
            "key": key,
            "value": value,
        },
        success: function(result) {
            if (key == "water") {
                $("#setWater").text(result);
            } else if (key == "heater") {
                $("#setTempature").text(result);
            }
            Toast.fire({
                icon: 'success',
                title: 'Arttırma başarılı'
            });
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            Toast.fire({
                icon: 'error',
                title: XMLHttpRequest.status + ' ' + errorThrown + '.'
            });
        }

    });

}

function GlobalMessage(message) {
    $('.global-message').html(message).fadeIn('show').delay('3000').fadeOut('slow');
}