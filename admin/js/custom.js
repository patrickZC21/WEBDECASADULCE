async function editChildren(id, item){
	
	const split = item.split("-")
	
	item = split[0]
	
	let mark = split[1]
	
	if(confirm('Estas seguro de editar esta categoria?')){
		
		var newSubcategory = prompt("Introduzca el nuevo valor");
		
		  if (newSubcategory != null) {
			  
				const response = await(await fetch('editChildren.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id, newSubcategory, item, mark})
			})).json()
			
				setTimeout( () => { alert(response);
				location.reload(); },2000)	

			 
		  }
		
	}
}


async function editNewSub(idsub,id){
	
	if(confirm('Estas seguro de editar esta categoria?')){
		
		var newSubcategory = prompt("Introduzca el nuevo valor");
		
		  if (newSubcategory != null) {
			  
			  const response = await(await fetch('editSubcategoria.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id:idsub, newSubcategory})
			})).json()
			
				setTimeout( () => { alert(response);
				location.reload(); },2000)	
		  }
		
	}
}


async function delNewSub(idsub,id){
	
	if(confirm('Estas seguro de eliminar esta categoria y todas sus subcategorias anidadas?')){
		
		const response = await(await fetch('deleteSubcategoria.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id:idsub})
			})).json()
			
		setTimeout( () => { alert('Se ha eliminado correctamente.');
		location.reload(); },200)	
		
	}
}

function newSub(id) {
	
	const container = document.querySelector(`#container${id}`);
	
	const txt_subcategoria = document.querySelector(`#txt_subcategoria${id}`)
	
	const btnSubmit = document.querySelector(`#submit${id}`)
	
	container.style.display = 'block'
	
	txt_subcategoria.focus()
	
	btnSubmit.addEventListener('click', async (e) => {
		e.preventDefault()
		
		if(txt_subcategoria.value===""){
			alert('Debe agregar la nueva sub categoria para proceder')
			txt_subcategoria.focus()
		}else{
			
			container.innerHTML = '<b>Creando...</b>'
			
			const result = await fetch('newSub.php', {
				method: 'POST',
				headers: {
					'Content-Type':'application/json'
				},
				body : JSON.stringify({id, subcategoria: txt_subcategoria.value})
			})
			
			const json = await result.json()
			
			console.log(json)
			
			container.innerHTML = 'Creado correctamente la nueva subcategoria'
			
			setTimeout(()=>{
				location.reload();
			},2000)
		}
	})
}


function addNewSub(idsub,id){
	
	const container = document.querySelector(`#containerAdd${id}`);
	
	const txt_subcategoria = document.querySelector(`#txt_subcategoriaAdd${id}`)
	
	const btnSubmit = document.querySelector(`#submitAdd${id}`)
	
	container.style.display = 'block'
	
	txt_subcategoria.focus()
	
	btnSubmit.addEventListener('click', async (e) => {
		e.preventDefault()
		
		if(txt_subcategoria.value===""){
			alert('Debe agregar la nueva sub categoria para proceder')
			txt_subcategoria.focus()
		}else{
			
			container.innerHTML = '<b>Creando...</b>'
			
			
			const r = await fetch('getSingle.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id:idsub})
			})
			
			let data = await r.json()
			
			data = JSON.parse(data)
			
			console.log('dddd', data)
			
			if(typeof data.hijos !== "undefined"){
				
				data.hijos.push({"nombre": txt_subcategoria.value})
				
			}else{
				
				data.hijos = [{"nombre": txt_subcategoria.value}]
				
			}
			
			console.log(data)
			
			
			
			const result = await fetch('newSubAdd.php', {
				method: 'POST',
				headers: {
					'Content-Type':'application/json'
				},
				body : JSON.stringify({ id:idsub, object: data })
			})
			
			const json = await result.json()
			
			console.log(json)
			
			container.innerHTML = json.success
			
			//container.innerHTML = 'Creado correctamente la nueva subcategoria'
			
			setTimeout(()=>{
				location.reload();
			},2000)
		}
	})
}



async function getSubs(id) {
	
	const myUL = document.querySelector(`#myUL${id}`)
	
	const result = await fetch(`getSubs.php`, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({id})
	});
	
	const json = await result.json();
	const j = json 
	
	let data =``;
	
	j.forEach( sub => {
		
		const subs = JSON.parse(sub.subcategorias)
		
		
		if(typeof subs.hijos !=="undefined"){
			
			acum  = new Array()
		
			data += `<li><span class="jscaret">${subs.padre} <a onClick="addNewSub(${sub.id},${id})" title="agregar subcategoria"><i class="ti-plus"></i></a>
			
			<a style="color:yellow" onClick="editNewSub(${sub.id},${id})" title="Editar esta categoria "><i class="ti-pencil"></i></a>
			
			<a style="color:red" onClick="delNewSub(${sub.id},${id})" title="Eliminar esta categoria y todas las subcategorias"><i class="ti-minus"></i></a>
			
			</span><ul class="jsnested">`
			ifChildrens(subs, sub.id, acum)
			data += `</ul></li>`
		}else{
			data += `<li>${subs.padre} <a onClick="addNewSub(${sub.id},${id})" title="agregar subcategoria"><i class="ti-plus"></i></a>
			
			<a style="color:yellow" onClick="editNewSub(${sub.id},${id})" title="Editar esta categoria "><i class="ti-pencil"></i></a>
			
			<a style="color:red"  onClick="delNewSub(${sub.id},${id})" title="Eliminar esta categoria y todas las subcategorias"><i class="ti-minus"></i></a>
			</li>`
		}
		
	})
	
	function ifChildrens(j, id, acum  ){
		j.hijos.forEach( items => { // A B C
		
		acum.push(items.nombre)
		
			if(typeof items.hijos !== "undefined"){
				
				data += `<li><span class="jscaret">${items.nombre}

<a style="cursor:pointer;color:green;font-size:12px" onClick="addChildren(${id},'${items.nombre}-${acum.length}')" title="agregar subcategoria"><i class="ti-plus"></i></a>

<a style="cursor:pointer;color:yellow;font-size:12px" onClick="editChildren(${id},'${items.nombre}-${acum.length}')" title="Editar esta categoria "><i class="ti-pencil"></i></a>

				<a style="cursor:pointer;color:red;font-size:12px" onClick="removeChildren(${id},'${items.nombre}-${acum.length}' )" title="eliminar subcategoria"><i class="ti-minus"></i></a></span><ul class="jsnested">`
					ifChildrens(items, id, acum)
					data += `</ul></li>`
			}else{
				
				
				data += `<li>${items.nombre} 
				
<a style="cursor:pointer;color:green;font-size:12px" onClick="addChildren(${id},'${items.nombre}-${acum.length}' )" title="agregar subcategoria"><i class="ti-plus"></i></a>


<a style="cursor:pointer;color:yellow;font-size:12px" onClick="editChildren(${id},'${items.nombre}-${acum.length}')" title="Editar esta categoria "><i class="ti-pencil"></i></a>

 <a style="cursor:pointer;color:red;font-size:12px" onClick="removeChildren(${id},'${items.nombre}-${acum.length}' )" title="eliminar subcategoria"><i class="ti-minus"></i></a></li>`
					
				
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
}


async function removeChildren(id, item ){
	
	const split = item.split("-")
	
	item = split[0]
	
	let mark = split[1]
	
	
		
	if(!confirm('Estas seguro de eliminar la subcategoria?')){
			
			
	}else{
			
			const r = await fetch('getSingle.php', {
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
			
			//console.log(data)
			
			
			let contador = new Array()
			
			if(typeof data.hijos !=="undefined"){
					buscar(data, contador)
			}
			
			function buscar(items, contador){
				items.hijos.forEach(h => {
					
					contador.push(h.nombre)
					
					if(contador.length == mark){
						
						delete h.nombre
						
					}
						
					
					if(typeof h.hijos !=="undefined")
					{
						buscar(h, contador)
					}
					
				})
			}
			console.log('new data: ',data)
			
			

					const Add = await(await fetch('addNewChild.php', {
						method : 'POST',
						headers: {
							'Content-Type': 'application/json'
						},
						body: JSON.stringify({id,data})
					})).json()
			
					
					console.log(Add)

			
			
		}  // fin 
	
}

function addChildren(id, item ){
	
	const split = item.split("-")
	
	item = split[0]
	
	let mark = split[1]
	
	const children = document.getElementById('children')
	
	$('#inverse-modal').modal('show');
	
	children.focus()
	
	document.querySelector('#subc').style.color= "red"
	document.querySelector('#subc').innerHTML = item.toString()
	
	const btn_children = document.querySelector('#btn_children')
	
	
	
	btn_children.addEventListener('click', async(e) => {
		
		e.preventDefault()
		
		if(children.value === ""){
			alert('Introduzca la subcategoria')
			children.focus()
		}
		else{
			
			console.log(children.value)
			
			const r = await fetch('getSingle.php', {
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
			
			//console.log(data)
			
			
			let contador = new Array()
			
			if(typeof data.hijos !=="undefined"){
					buscar(data, contador)
			}
			
			function buscar(items, contador){
				items.hijos.forEach(h => {
					
					contador.push(h.nombre)
					
					if(contador.length == mark){
						
						if(typeof h.hijos !== "undefined"){
							h.hijos.push({"nombre": children.value})
						}else{
							
							h.hijos = [{"nombre": children.value}]
						}
						
					}
						
					
					if(typeof h.hijos !=="undefined")
					{
						buscar(h, contador)
					}
					
				})
			}
			console.log('new data: ',data)
			
			
			const Add = await(await fetch('addNewChild.php', {
				method : 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({id, data, mark})
			})).json()
	
			
			console.log(Add)
			
			
			document.querySelector('#resultBody').innerHTML = `<h2 style="padding:10px"><b>${Add}</b></h2>`
			
			
		}  // fin else pregunta si esta vacio el campo
	})
}








