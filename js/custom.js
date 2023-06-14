//document.addEventListener("DOMContentLoaded", getMenu);


async function getMenu(){
	
	
	const myUL = document.querySelector(`#menu`)
	
	const result = await fetch(`getCat.php`, {
		method: 'GET',
		headers: { 'Content-Type': 'application/json' }
	});
	
	const json = await result.json();
	
	let menuP = `<ul>`;
	
	
	const getM = async (i) => {
		let m = ``
		const data = await(await fetch(`getSubs.php`, {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify({id: i.id})
				})).json()
				
		if(data.length === 0 ){
		
				m += `<li><a href="#0">${i.nombre}</a></li>` 
				
			}else{
				m += `<li><span><a href="#0">${i.nombre}</a></span><ul>` 
				
					  const mlevel = await getSubs(data)
					  m += mlevel
					  
				m += `</ul></li>` 
			}		
			
		
		return m
	 }
	
	for (i of json) {
		
		const m = await getM(i)	
		menuP += m
		
	}
	
	menuP += `</ul>`
	
	myUL.innerHTML = menuP
	
}

	

async function getSubs(data) {
	
	let menu = ``
	
	  for (sub of data){
	
		const subs = JSON.parse(sub.subcategorias)
		
		if(typeof subs.hijos !== "undefined"){
			
			menu += `<li><span><a href="">${subs.padre}</a></span><ul>`
				const levelm = await ifChildrens(subs)
				menu += levelm
			menu += `</ul></li>`
			
		}else{
			menu += `<li><a href="">${subs.padre}</a></li>`
		}
		
	}
	
	return menu
		
	 
}

 function ifChildrens(j){
	 
	 let menu = ``
		
		for(items of j.hijos){
		 //j.hijos.forEach(  items => { // A B C
		
			if(typeof items.hijos !== "undefined"){
				
				menu += `<li><span><a href="">${items.nombre}</a></span><ul>`
					 const levelm = ifChildrens(items, menu)
					 menu += levelm
				menu += `</ul></li>`
			}else{
				
				menu += `<li><a href="">${items.nombre}</a></li>`
				
			}	
			
		}
		
		return menu
	}
	
