/* Wow Js */
new WOW().init();

//Loader
jQuery(document).ready(function() {
    $('.loader').fadeOut("slow");
});


// email subscribe model
$(window).on('load', function() {
    let cookie = getCookie("close_newsletter");
    if(!cookie){
        $('#emailSubscribe').modal('show');
    }
});

$(document).on('click','.ring-size-filter',function(){
    let size = $(this).data('size');
    $('#size-chart').text(size)
})


// Admin Panel sidebar
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('cat|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('cat-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('cat-sidenav-toggled');
            localStorage.setItem('cat|sidebar-toggle', document.body.classList.contains('cat-sidenav-toggled'));
        });
    }
});

$(document).on('click','#acceptCookiePolicy',function(){
    setCookie('cookie_accept',1,7);
})

$(document).on('click','#close-newsletter',function(){
    setCookie('close_newsletter',1,7);
})


function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}