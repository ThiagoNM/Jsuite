export const creaHTMLFormulariAfegir = (llistaautors,llistaeditorials, llistageneres) => {
 
    let opcions='';
    let opcionsed='';
    let opcionsge='';
  
    // Creem les opcions del select, a partir de les dades
    for (let i of llistaautors.autors)  {
 
        opcions += "<option value='" + i.id_autor + "'>"+i.nom+" "+i.cognoms +"</option>"
    }
  
    for (let i of llistaeditorials.editorials)  {
  
        opcionsed += "<option value='" + i.id_editorial + "'>"+i.nom+"</option>"
    }
  
    for (let i of llistageneres.generes)  {
  
        opcionsge += "<option value='" + i.id_genere + "'>"+i.genere+"</option>"
    }
  
    let html=`
  
     <form class="row g-0">   
        <div class="col-md-12 mb-3" >
            <label for="titolllibre" class="form-label">Titol del llibre</label>
            <input type="text" class="form-control" id="titolllibre" placeholder="Títol del llibre">         
        </div>
        <div class="col-md-4" mb-3>
            <label for="autorllibre" class="form-label">Autor</label>
            <select id="autorllibre" class="form-select" name="autorllibre">
           
            ${ opcions }
           
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="editorialllibre" class="form-label">Editorial</label>
            <select id="editorialllibre" class="form-select" name="editorialllibre">
           
            ${ opcionsed }
           
            </select>
        </div>
  
        <div class="col-md-4 mb-3">
            <label for="generellibre" class="form-label">Gènere</label>
            <select id="generellibre" class="form-select" name="generellibre">
           
            ${ opcionsge }
           
            </select>
        </div>
  
        <div class="col-md-8 mb-3">
            <label for="imatgellibre" class="form-label">Imatge Portada</label>
            <input class="form-control" type="file" id="imatgellibre">
        </div>
        <div class="col-md-4 mb-3">
            <label for="isbnllibre" class="form-label">ISBN</label>
            <input class="form-control" type="text" id="isbnllibre">
       </div>
 
       <div class="col-md-4 mb-3">
       <label for="valoraciollibre" class="form-label">Valoració</label>
       <select class="form-select" id="valoraciollibre" aria-label="select example" >
           <option value="0">0 estrelles</option>
           <option value="2">1 estrella</option>
           <option value="4">2 estrelles</option>
           <option value="6">3 estrelles</option>
           <option value="8">4 estrelles</option>
           <option value="10">10 estrelles</option>
 
       </select>
       </div>
    
       <div class="col-md-8 mb-3">
           <label for="sinopsillibre" class="form-label">Sinopsi</label>
           <textarea class="form-control" id="sinopsillibre" rows="3"></textarea>
       </div>
      
     
       <div class="col-md-3 mb-3">
           <button id="enviarllibre" type="button" class="btn btn-warning">Enviar</button>
       </div>
 
 
   </form>
   `
  
   return html
}
