/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

(function ($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (
            location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top - 200,
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $(".js-scroll-trigger").click(function () {
        $(".navbar-collapse").collapse("hide");
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $("body").scrollspy({
        target: "#mainNav",
        offset: 74,
    });

    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
})(jQuery); // End of use strict

// Traitememnt du formulaire de conatct
var res_form = document.querySelector(".res-form");
var form = document.querySelector("#contactForm");
form.addEventListener("submit", function(e){
    e.preventDefault();
    var data = new FormData(form);
    var xhr = new XMLHttpRequest();
    var element_champs_error = document.querySelectorAll('.has-error');
    console.log(element_champs_error);
    for (let j = 0; j < element_champs_error.length; j++) {
        element_champs_error[j].classList.remove('has-error');
        var span = element_champs_error[j].querySelector('.alert-danger')
        if(span){
             span.parentNode.removeChild(span);
        }
    }
    var element_champs_success = document.querySelectorAll('.has-success');
    for (let j = 0; j < element_champs_success.length; j++) {
        element_champs_success[j].classList.remove('has-success');
        var span = element_champs_success[j].querySelector('.alert-success')
        if(span){
            span.parentNode.removeChild(span);
        }
    }
    
    xhr.onreadystatechange = function () {
       if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            var res  = JSON.parse(this.responseText);
            if(res.success){
                console.log(res.success);
                var champs = form.querySelectorAll('textarea , input')
                
                var paragraphe = document.createElement('div');
                
                paragraphe.className = 'alert alert-success';
                paragraphe.innerHTML = 'Votre message a été bien envoyé .';
                res_form.classList.add('has-success');
                res_form.appendChild(paragraphe);
                for (let i = 0; i < champs.length; i++) {
                    champs[i].value = "";
                    
                }
            } else {
                
                var paragraphe = document.createElement('div');
                
                paragraphe.className = 'alert alert-danger';
                paragraphe.innerHTML = res.msg;
                res_form.parentNode.classList.add('has-error');
                res_form.appendChild(paragraphe);
                
            }
       } 
        // else if(this.readyState == 4) {
        //     alert('une erreur est survenue ...')
        // }
    };
    xhr.open("POST", "/pages/contact.php", true);
    // xhr.responseType = "json";
    xhr.setRequestHeader("X-Requested-With", "xmlhttprequest")
    xhr.send(data);
    return false;
});

// Animation de la page html
const ratio = 0.1;
const options = {
    root: null,
    rootMargin: '0px',
    threshold: ratio
     
}; 
const callback = function(entries, observer){
    entries.forEach(function(entry){
        if (entry.intersectionRatio > ratio) {
            entry.target.classList.add('reveal-visible');
           observer.unobserve(entry.target)
        } 
        
    });
};
document.documentElement.classList.add('reveal-loaded')
    // 
    window.addEventListener('DOMContentLoaded', function () {
    const observer = new IntersectionObserver(callback, options);
    (document.querySelectorAll('.reveal')).forEach(function(r){
    observer.observe(r)
    }); 
})
