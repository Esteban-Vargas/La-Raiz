const buttons = document.querySelectorAll("[data-carousel-button]")

buttons.forEach(button => {
  button.addEventListener("click", () => {
    const offset = button.dataset.carouselButton === "next" ? 1 : -1
    const slides = button
      .closest("[data-carousel]")
      .querySelector("[data-slides]")

    const activeSlide = slides.querySelector("[data-active]")
    let newIndex = [...slides.children].indexOf(activeSlide) + offset
    if (newIndex < 0) newIndex = slides.children.length - 1
    if (newIndex >= slides.children.length) newIndex = 0

    slides.children[newIndex].dataset.active = true
    delete activeSlide.dataset.active
  })
})

let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.removeAttribute('data-active');
        if (i === index) {
            slide.setAttribute('data-active', '');
        }
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    showSlide(currentSlide);
}

// Set up automatic slide transition (change slide every 3000 milliseconds)
setInterval(nextSlide, 5000);

// Toggle sidebar visibility
function toggleSidebar() {
  var sidebar = document.getElementById('sidebar');
  sidebar.style.display = (sidebar.style.display === 'none' || sidebar.style.display === '') ? 'block' : 'none';
}

// Login function (you can implement your own logic)
function login() {
  // Add your login logic here
}

document.getElementById('news-link').addEventListener('click', function() {
  showSection('news-section');
});

document.getElementById('contact-link').addEventListener('click', function() {
  showSection('contact-section');
});

document.getElementById('store-link').addEventListener('click', function() {
  showSection('store-section');
});
document.getElementById('login-link').addEventListener('click', function() {
  showSection('login-section');
});

function showSection(sectionId) {
  // Hide all sections
  var sections = document.getElementsByClassName('content-section');
  for (var i = 0; i < sections.length; i++) {
      sections[i].style.display = 'none';
  }

  // Show the selected section
  var selectedSection = document.getElementById(sectionId);
  if (selectedSection) {
      selectedSection.style.display = 'block';
  }
}
// document.addEventListener('DOMContentLoaded', function() {
//   showSection('news-section');
// });
window.addEventListener("load",function(){
  showSection('login-section');
});