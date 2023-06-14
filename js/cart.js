//var host = window.location.protocol + "//" + window.location.host;

document.addEventListener("DOMContentLoaded", updateCart);

async function removeItemToCart(id, idTalla, cantidad = 1){
	
	// const top_panelboxData = document.querySelector('.top_panel.boxData')
	// const titleBoxData = document.querySelector('#titleBoxData')
	// const contentBoxData = document.querySelector('.contentBoxData')
	
	await(await fetch(`${host}/removeToCart.php`, {
		
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id, cantidad, idTalla })
			})).json()
			
	
	//top_panelboxData.classList.add('show')
	
	//titleBoxData.innerHTML = `1 producto agregado al carrito`
	
	// let block = `<div class="row">
	//                 <div class="col-md-7">
	//                     <div class="item_panel">
	//                         <figure>
	//                             <img src="${host}/items/${data.foto}" data-src="${host}/items/${data.foto}" class="lazy" alt="">
	//                         </figure>
	//                         <h4>${data.nombre_es}</h4>
							
	//                        `
						   
	// 		 if(data.descuento > 0){
	// 						block += `<div class="price_panel"><span class="new_price">${data.precioFWithDescount} ${data.moneda}<span class="percentage">-${data.descuentoF}%</span></span>
	// 						<span class="old_price">${data.precio} ${data.moneda}</span></div>`
	// 				}else{
						
	// 						block += `<div class="price_panel"><span class="new_price">${data.precio} ${data.moneda}</span></div>`
	// 				}
	// 			block +=` </div>
	//                 </div>
	//                 <div class="col-md-5 btn_panel">
	//                     <a href="${host}/cart" class="btn_1 outline">Ver carrito</a> <a href="${host}/checkout" class="btn_1">Crear pedido v&iacute;a WhatsApp</a>
	//                 </div>
	//             </div>`					   
	
	
	// contentBoxData.innerHTML = block
	updateCart()
} 

async function addItemToCart(id, idTalla, cantidad = 1){
	
	const top_panelboxData = document.querySelector('.top_panel.boxData')
	const titleBoxData = document.querySelector('#titleBoxData')
	const contentBoxData = document.querySelector('.contentBoxData')
	
	const data = await(await fetch(`${host}/addToCart.php`, {
		
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id, cantidad, idTalla })
			})).json()
			
	
	top_panelboxData.classList.add('show')
	
	titleBoxData.innerHTML = `1 producto agregado al carrito`
	
	let block = `<div class="row">
	                <div class="col-md-7">
	                    <div class="item_panel">
	                        <figure>
	                            <img src="${host}/items/${data.foto}" data-src="${host}/items/${data.foto}" class="lazy" alt="">
	                        </figure>
	                        <h4>${data.nombre_es}</h4>
							
	                       `
						   
			 if(data.descuento > 0){
							block += `<div class="price_panel"><span class="new_price">${data.precioFWithDescount} ${data.moneda}<span class="percentage">-${data.descuentoF}%</span></span>
							<span class="old_price">${data.precio} ${data.moneda}</span></div>`
					}else{
						
							block += `<div class="price_panel"><span class="new_price">${data.precio} ${data.moneda}</span></div>`
					}
				block +=` </div>
	                </div>
	                <div class="col-md-5 btn_panel">
	                    <a href="${host}/cart" class="btn_1 outline">Ver carrito</a> <a href="${host}/checkout" class="btn_1">Crear pedido v&iacute;a WhatsApp</a>
	                </div>
	            </div>`					   
	
	
	contentBoxData.innerHTML = block
	updateCart()
} 

/*

const addToCart = document.querySelector('.addToCart')
	
addToCart.addEventListener('click', async (e) => {
	
	const payload = e.target.parentElement.rel.split("-")
	
	const id = payload[0]
	const idTalla = payload[1]
			
})	

*/

async function updateCart(){
	
	const countCart = document.querySelector('#countCart')
	const cartList = document.querySelector('#cartList')
	const totalCart = document.querySelector('#totalCart')
	
	const data = await(await fetch(`${host}/getAllItemsFromCart.php`)).json()
	
	const count = data.length

	
	countCart.innerHTML = count === 0 ? 0 : count - 1;
	
	let block = ``
	
	for(var i = 0; i < count-1 ; i++){
		
		block += `<li>
		
		<a href="${data[i].link}"> 
		
		<figure><img src="${host}/items/${data[i].foto}" data-src="${host}/items/${data[i].foto}" alt="" width="50" height="50" class="lazy"></figure>
			<strong><span>${data[i].cantidad}x ${data[i].nombre_es}</span>${data[i].costo} ${data[i].moneda}</strong>
		
		</a>
		
		</li>`
		
	}
	
	
	cartList.innerHTML = block
	totalCart.innerHTML = `${data[count-1].total} ${data[0].moneda}`
}


async function deleteCart(id){
	
	const tbodyCart = document.querySelector('#tbodyCart')
	const totalCart = document.querySelector('.totalCart')
	const totalSubCart = document.querySelector('.totalSubCart')
	
	if(confirm('Estas seguro de eliminar el producto del carrito?')){
		
		const data = await(await fetch(`${host}/deleteItemFromCart.php`, {
			method: 'post',
			headers: {
				'content-Type' : 'application/json'
			},
			body: JSON.stringify({id})
		})).json()
		
		
		const count = data.length
		
		
		let block = ``
		
		for(var i = 0; i < count-1 ; i++){
			
			block += `<tr>
			<td>
			<div class="thumb_cart">
											<img src="${host}/items/${data[i].foto}" data-src="${host}/items/${data[i].foto}" class="lazy" alt="Image">
										</div>
										<span class="item_cart">${data[i].nombre_es}</span>
			</td>
			
			<td>
										<strong>${data[i].costo} ${data[i].moneda}</strong>
									</td>
									
									<td>
										
 <input onKeyDown="updateCartItem(${data[i].id}, this.value)" onKeyUp="updateCartItem(${data[i].id}, this.value)"  onChange="updateCartItem(${data[i].id}, this.value)" type="number" min="1" value="${data[i].cantidad}"  class="" name="quantity_1">
										
									</td>
									
									<td>
										<strong>${data[i].costoXcantidad}</strong>
									</td>
									<td class="options">
										<a onClick="deleteCart(${data[i].id})" href="#"><i class="ti-trash"></i></a>
									</td>
			
			
			</tr>`
			
		}
		
		
		tbodyCart.innerHTML = block
		totalCart.innerHTML = `${data[count-1].total} ${data[0].moneda}`
		totalSubCart.innerHTML = `${data[count-1].total} ${data[0].moneda}`
		updateCart()
	}
	
}


async function updateCartItem(id, cantidad = 1) {
	
	if(cantidad < 0 ) { alert('Introduzca una cantidad mayor a Cero')}else{
	
	const tbodyCart = document.querySelector('#tbodyCart')
	const totalCart = document.querySelector('.totalCart')
	const totalSubCart = document.querySelector('.totalSubCart')
	
	
	const data = await(await fetch(`${host}/updateItemFromCart.php`, {
			method: 'post',
			headers: {
				'content-Type' : 'application/json'
			},
			body: JSON.stringify({id, cantidad})
		})).json()
		
		
		const count = data.length
		
		
		let block = ``
		
		for(var i = 0; i < count-1 ; i++){
			
			block += `<tr>
			<td>
			<div class="thumb_cart">
											<img src="${host}/items/${data[i].foto}" data-src="${host}/items/${data[i].foto}" class="lazy" alt="Image">
										</div>
										<span class="item_cart">${data[i].nombre_es}</span>
			</td>
			
			<td>
										<strong>${data[i].costo} ${data[i].moneda}</strong>
									</td>
									
									<td>
										
 <input  onKeyDown="updateCartItem(${data[i].id}, this.value)" onKeyUp="updateCartItem(${data[i].id}, this.value)"  onChange="updateCartItem(${data[i].id}, this.value)" type="number" min="1" value="${data[i].cantidad}"  class="" name="quantity_1">
										
									</td>
									
									<td>
										<strong>${data[i].costoXcantidad}</strong>
									</td>
									<td class="options">
										<a onClick="deleteCart(${data[i].id})" href="#"><i class="ti-trash"></i></a>
									</td>
			
			
			</tr>`
			
		}
		
		
		tbodyCart.innerHTML = block
		totalCart.innerHTML = `${data[count-1].total} ${data[0].moneda}`
		totalSubCart.innerHTML = `${data[count-1].total} ${data[0].moneda}`
		updateCart()
	}
	
}



	
	
 