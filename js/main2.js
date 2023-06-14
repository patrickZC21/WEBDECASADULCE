var host = window.location.protocol + "//" + window.location.host;

async function showSubCategory2(categoria, id_subcategoria, idInside) {
	
	const selected = document.querySelector('#nameFilter')
	
	const r = await fetch(`${host}/admin/getSingle.php`, {
		
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id:id_subcategoria})
			})
			
			let data = await r.json()
			
			data = JSON.parse(data)
			
			
			selected.innerHTML = `${data.padre} > `
				
			
				
				if(typeof data.hijos !=="undefined"){
					let contador = new Array()
					buscar(data, contador)
				}
				
			
			function buscar(items, contador){
				items.hijos.forEach(h => {

					contador.push(h.nombre)
					
					if(contador.length == idInside){
						
						selected.innerHTML += h.nombre
						
					}	
					
					if(typeof h.hijos !=="undefined")
					{
						buscar(h, contador)
					}
					
				})
			}
	
	
}


const btn_filter = document.querySelector('.btn_filter')

btn_filter.addEventListener('click', async (e) => {
	
	const top_panel = document.querySelector('.top_panel.filterProducts')
	
	top_panel.classList.add('show')
	
	const categoria = document.getElementById('id_categoria').value
	
	const showData = document.querySelector('#show-data')
	
	showData.innerHTML = "<center><h3 >...</h3></center>"
	
	const id_subcategoria = document.getElementById('id_subcategoria')
	
	const idInside = document.getElementById('idInside')
	
	showSubCategory2(categoria, id_subcategoria.value, idInside.value)
	
	
	const data = await(await fetch(`${host}/getAllProductsById.php`, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({idCategoria: categoria, idSubCategoria:id_subcategoria.value, idInside:idInside.value})
			})).json()
			
	console.log('info', data)
		

	const count = data.length	

   if(count>0){
	   
	   let block = `<div class="col-lg-12">
					<div class="row small-gutters">`
	   
		for(i of data){
		   
			block += `<div class="col-6 col-md-2">
							<div class="grid_item">
						<figure>`
						
			if(i.descuento > 0){
				
				block += `<span class="ribbon off">-${i.descuentoF}%</span>`
			}	
			 
				
				block += `<a href="${i.link}">
								<img class="img-fluid lazy" src="${host}/items/${i.foto}" data-src="${host}/items/${i.foto}" alt="" width="400" height="400">
							</a>`
				
			 if(i.descuento > 0){
				block += ``
			}

				block += `</figure>`


				block += `<a href="${i.link}">
							<h3>${i.nombre_es}</h3>
						</a>
						<div class="price_box">`


				 if(i.descuento > 0){
							block += `<span class="new_price">${i.precioFWithDescount} ${i.moneda}</span>
							<span class="old_price">${i.precio} ${i.moneda}</span>`
					}else{
						
							block += `<span class="new_price">${i.precio} ${i.moneda}</span>`
					}

				block += `<div>Tasa: 1.USD: ${i.dolar} ${i.moneda}</div>`	

				block += `</div></div>
				
				</div>
						`
		
						
		}
		
		block += `</div>`
		
		showData.innerHTML = block		
   }else{
	   showData.innerHTML = "<center><h3 >No existen productos para la categoria seleccionada</h3></center>"
   }	
	
	
})



const id_categoria = document.querySelector('#id_categoria')

id_categoria.addEventListener('change', async () => {
	
	const json = await(await fetch(`${host}/admin/getSubInput.php?id=${id_categoria.value}`)).json()
	
	console.log('json',json)
	
	const j = json
	
	let data =``;
	
	
var i = 0 ;
j.forEach( sub => {
		
		const subs = JSON.parse(sub.subcategorias)
		
		let acum = new Array();
		
		if(typeof subs.hijos !=="undefined"){ 
			
			data += `<li><span class="jscaret" onClick="select(${sub.id}, '${subs.padre}-0')">${subs.padre} ></span><ul class="jsnested">`
			
			ifChildrens(subs, sub.id, acum )
			
			data += `</ul></li>`
		}else{
			data += `<li><a onClick="select(${sub.id}, '${subs.padre}-0')">${subs.padre}</a></li>`
		}
		
		
	i++;	
	})
		

function ifChildrens(j, id, acum  ){
	 
		j.hijos.forEach( items => {  // <- (iterador)  HIJOS DIRECTOS A B C || AA BB JJ
		
		
		acum.push(items.nombre)
			
			if(typeof items.hijos !== "undefined"){
				
				
				
				data += `<li><span class="jscaret" onClick="select(${id}, '${items.nombre}-${acum.length}')">${items.nombre}</span><ul class="jsnested">`
				
					ifChildrens(items, id, acum )
					
				data += `</ul></li>`
					
			}else{
				
				data += `<li><a onClick="select(${id}, '${items.nombre}-${acum.length}')">${items.nombre}</a> </li>`	
	
			}
			
		})
		
		
	}
	
	
myUL.innerHTML = data

var toggler = document.getElementsByClassName("jscaret");
	var i;
for (i = 0; i < toggler.length; i++) {
	  toggler[i].addEventListener("click", function() {
		this.parentElement.querySelector(".jsnested").classList.toggle("jsactive");
		this.classList.toggle("jscaret-down");
	  });
}
	
}) 

async function select(id,item){
	
	const subcategorias = document.getElementById('subcategorias')
	
	const id_subcategoria = document.getElementById('id_subcategoria')
	const idInside = document.getElementById('idInside')
	
	const split = item.split("-")
	
	item = split[0]
	
	let mark = split[1]
	
	if(mark == 0 ){
		
		selected.innerHTML = item.toString()
		id_subcategoria.value = id
		idInside.value = mark
		
	}else{
		
		const r = await fetch(`${host}/admin/getSingle.php`, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id})
			})
			
			let data = await r.json()
			
			data = JSON.parse(data)
			
			console.log(id,item.toString())
			
			console.log('mark',mark)
			
			console.log('dataaaa', data)
			
			let contador = new Array()
			
			if(typeof data.hijos !=="undefined"){
					buscar(data, contador)
			}
			
			function buscar(items, contador){
				items.hijos.forEach(h => {
					
					contador.push(h.nombre)
					
					if(contador.length == mark){
						
						showSubCategory(id, mark)
						id_subcategoria.value = id
						idInside.value = mark
						
					}	
					
					if(typeof h.hijos !=="undefined")
					{
						buscar(h, contador)
					}
					
				})
			}
	}
}


async function showSubCategory(id_subcategoria, idInside) {
	
	const selected = document.querySelector('#selected')
	
	const r = await fetch(`${host}/admin/getSingle.php`, {
		
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id:id_subcategoria})
			})
			
			let data = await r.json()
			
			data = JSON.parse(data)
			
			console.log('idInside',idInside)
			
			console.log('Data', data)
			
			console.log('PADRE', data.padre)
			
			
			selected.innerHTML = `${data.padre} > `
				
			
				
				if(typeof data.hijos !=="undefined"){
					let contador = new Array()
					buscar(data, contador)
				}
				
			
			function buscar(items, contador){
				items.hijos.forEach(h => {

					
					contador.push(h.nombre)
					
					if(contador.length == idInside){
						
						selected.innerHTML += h.nombre
						
					}	
					
					if(typeof h.hijos !=="undefined")
					{
						buscar(h, contador)
					}
					
				})
			}
	
	
}

const id_subcategoria = document.getElementById('id_subcategoria')
const idInside = document.getElementById('idInside')
showSubCategory(id_subcategoria.value, idInside.value)