sconst menubtn = document.getElementById("menu-btn");
const navlinks = document.getElementById("nav-links");
const menuBtnIcon  = menubtn.querySelector("i"); 

menubtn.addEventListener("click", (e) => {
    navlinks.classList.toggle("open");

    const isOpen = navlinks.classList.contains("open");
    menuBtnIcon.className =isOpen ?  "ri-close-line" : "ri-menu-line";
});

navlinks.addEventListener("click", (e) => {
    if (e.target.tagname === "A") {
    navlinks.classList.remove("open");
    menuBtnIcon.className = "ri-menu-line"; }
});

const scrollRevealOption = {
    origin: "bottom",
    distance: "50px",
    duration: 1000,
};

ScrollReveal().reveal(".header_image img", {
    ...scrollRevealOption,
    origin: "right",
});
sSrollReveal().reveal(".header_content h1", {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal(".header_content h2", {
    ...scrollRevealOption,
    delay: 1000,
});
ScrollReveal().reveal(".header_content p", {
    ...scrollRevealOption,
    delay: 1500,
});
ScrollReveal().reveal(".header_btn", {
    ...scrollRevealOption,
    delay: 2000,
});

ScrollReveal().reveal(".about_image img", {
    ...scrollRevealOption,
    origin: "left",
});
ScrollReveal().reveal(".about_content .section_header", {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal(".about_content p", {
    ...scrollRevealOption,
    delay: 1000,
});
ScrollReveal().reveal(".about_btn", {
    ...scrollRevealOption,
    delay: 1500,
});
ScrollReveal().reveal(".service_card", {
    ...scrollRevealOption,
 interval: 500,
});

ScrollReveal().reveal(".facility_content .section_header", {
    ...scrollRevealOption,
});
ScrollReveal().reveal(".facility_content p", {
    ...scrollRevealOption,
    delay: 500,
});

ScrollReveal().reveal(".mentor_card", {
    ...scrollRevealOption,
    interval: 500,
});

ScrollReveal().reveal(".banner_content h2", {
    ...scrollRevealOption,
});
ScrollReveal().reveal(".banner_content p", {
    ...scrollRevealOption,
    delay: 500,
});

const form = document.getElementById('registerForm'); // assume you have a form with this ID
form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const name = form.querySelector('[name="name"]').value;
    const email = form.querySelector('[name="email"]').value;
    const password = form.querySelector('[name="password"]').value;

    const response = await fetch('http://localhost:3000/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, email, password })
    });

    const data = await response.json();
    console.log(data.message); // handle response
});