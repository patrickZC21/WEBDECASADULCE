
function guardarFavorito(product) {
  let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
  
  const foundValor = favoritos.find( p => p.id === product.id);

  if (!foundValor) {
    favoritos.push(product);
    localStorage.setItem("favoritos", JSON.stringify(favoritos));
    listarFavoritos();
  }
}

function checkIfFavorite(id){
    let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];

    return  favoritos.find( p => p.id === id) === undefined ? false : true;
}

function eliminarFavorito(id) {
  let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
  favoritos = favoritos.filter((favorito) => favorito.id !== id);
  localStorage.setItem("favoritos", JSON.stringify(favoritos));
  listarFavoritos();
}

function listarFavoritos() {
  const favoritosDiv = document.getElementById("tbodyCartFav");
  favoritosDiv.innerHTML = "";
  const favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
  favoritos.forEach((favorito) => {
    const productoTr = document.createElement("tr");

    productoTr.innerHTML = `

      <td>
          <div class="thumb_cart">
              <img src="${favorito.image}" data-src="${favorito.image}" class="lazy" alt="Image">
          </div>
          <span class="item_cart">${favorito.nombre_es}</span>
      </td>
      <td><b>${favorito.precio}</b></td>
      
      <td class="options">
          <a onClick="addItemToCart(${favorito.id},${favorito.id_talla})" rel="${favorito.id}-${favorito.id_talla}" href="#"
          
          class="tooltip-1 addToCart"  data-toggle="tooltip" data-placement="left" title="Add to cart"
          ><i class="ti-shopping-cart"></i></a>


          <a onclick="eliminarFavorito(${favorito.id})" href="#"><i class="ti-trash"></i></a>
      </td>
 
      `;
    favoritosDiv.appendChild(productoTr);
  });
}

listarFavoritos();
