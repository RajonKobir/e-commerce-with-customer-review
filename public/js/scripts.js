// smooth sticky header
var element = document.querySelector('#main_navbar'); 
var isPositionSticky = (element.style.position == 'sticky');

window.addEventListener("scroll", function(e){ 
    e.preventDefault();

    if (document.documentElement.scrollTop > 200 && !isPositionSticky){ 
        element.classList.add("amimate_header");
        element.style.position = 'sticky';
        element.style.top = '0';
        element.style.zIndex = '999';
    }
    if (document.documentElement.scrollTop < 200 && isPositionSticky){
        element.classList.remove("amimate_header");
        element.style.position = 'static';
    } 
});