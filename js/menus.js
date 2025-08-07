// get current url without domain

const currentPath = window.location.pathname;

//get all links

const navLinks = document.querySelectorAll("#navLinks a");

navLinks.forEach(link => {

    console.log(currentPath)
    if(link.getAttribute('href') === currentPath) {
        link.classList.add('active')
    }
})


