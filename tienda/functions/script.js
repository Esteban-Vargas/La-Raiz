

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

document.getElementById('news-link').addEventListener('click', function () {
  showSection('news-section');
});

document.getElementById('contact-link').addEventListener('click', function () {
  showSection('contact-section');
});

document.getElementById('store-link').addEventListener('click', function () {
  showSection('store-section');
  fetchAndDisplayProducts(1);
});
document.getElementById('login-link').addEventListener('click', function () {
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
document.addEventListener("DOMContentLoaded", function () {
  showSection('store-section');
});

$(document).on('click', '.btn-success', function () {
  var productId = $(this).data('product-id');

  // Realiza una solicitud AJAX para obtener detalles del producto desde el servidor
  $.ajax({
    url: 'obtener_detalles_producto.php',
    type: 'GET',
    data: { productId: productId },
    dataType: 'json',
    success: function (data) {
      // Actualizar el contenido de la modal con los detalles del producto
      $('#modalProducto .modal-body').html(
        '<h5>' + data.Nombre + '</h5>' +
        '<p>Disponibles: ' + data.Cantidad + '</p>' +
        '<p>' + data.Descripcion + '</p>' +
        '<p>Precio: $' + data.Precio + '</p>'
      );

      // Mostrar la modal
      $('#modalProducto').modal('show');
    },
    error: function (error) {
      console.error('Error al obtener detalles del producto:', error);
    }
  });
});

//------------------- mostrar catalogo ----------------------------


// // Function to fetch and display products from the database
// function fetchAndDisplayProducts(pageNumber) {
//   const productsArea = document.getElementById('products-area');

//   // Make an AJAX request to the server-side script
//   fetch('fetch_products.php?pageNumber=' + pageNumber,{
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//     },
//   })
//     .then(response => response.json())
//     .then(data => {
//       // Clear existing content
//       productsArea.innerHTML = '';

//       // Display products
//       data.forEach(product => {
//         const productElement = document.createElement('div');
//         productElement.className = 'product';
//         productElement.innerHTML = `
//           <img src="${product.imagen}" alt="${product.nombre}">
//           <h3>${product.nombre}</h3>
//           <p>${product.descripcion}</p>
//           <button>Agregar al carro</button>
//         `;
//         productsArea.appendChild(productElement);
//       });

//       const paginationContainer = document.getElementById('pagination-container');
//       paginationContainer.innerHTML = `<div>Página ${pageNumber}</div>`;
//     })
//     .catch(error => {
//       console.error('Error fetching products:', error);
//     });
// }
