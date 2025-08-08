
    
    const normalizePath =(path) => {
        //remove query and hash
        path = path.split('?')[0].split('#')[0];

        //remove trailing slash
        path = path.replace(/\/$/, '');

        return path === '' ? '/' : path;

    }

    const currentPath = normalizePath(window.location.pathname);

    
    const navLinks = document.querySelectorAll("#navLinks a");
    console.log(navLinks,"***************")

    
    navLinks.forEach(link => {
        const linkPath = normalizePath(link.pathname);
        console.log("Checking...", { currentPath, linkPath, classes: [...link.classList] });

        if (linkPath === currentPath) {
            link.classList.add('active');
        }
    });



// // get current url without domain

// const currentPath = window.location.pathname;

// //get all links

// const navLinks = document.querySelectorAll("#navLinks a");

// navLinks.forEach(link => {

//     console.log("Am here....",currentPath,link.classList)
//     if(link.getAttribute('href') === currentPath) {
//         link.classList.add('active')
//     }
// })


