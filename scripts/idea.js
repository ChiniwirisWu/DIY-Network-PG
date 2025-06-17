// html elements that are going to be used by the class instance.
const addTabsBttn = document.getElementById("add-tab");
const rmTabBttn = document.getElementById("remove-tab");
const tabsContainer = document.getElementById("tabs-container");
const textarea = document.getElementById("content-textarea");
const urlInp = document.getElementById("url-inp");
const materialSelectBttn = document.getElementById("add-material-1");
const materialInpBttn = document.getElementById("add-material-2");
const titleInp = document.getElementById("title-inp");
const materialSelect = document.getElementById("material-select");
const materialInp = document.getElementById("material-input");
const coverInp = document.getElementById("cover-inp");

const materialList = document.getElementById("materials-list");

const form = document.getElementById("form");
const postTitle = document.getElementById("post-titulo");
const postInstructions = document.getElementById("post-instrucciones");
const postMaterials = document.getElementById("post-materiales");
const postImages = document.getElementById("post-imagenes");
const postCover = document.getElementById("post-portada");


// class declaration: the idea is to keep all the info inside a class instance.
class Idea{
  constructor(){
    this.maxTabs = 8;
    this.nTabs = 1; // counter of the current amount of tabs.
    this.page = 1; // current page.
    this.materials = [] // {1: [], 2: [], ... n: []}
    this.instructions = [] // {1: "", 2: "", ... n: ""}  
    this.images = []
    this.tabs = []; // {html1, thtml2} list of the html objects so I can destroy them.
    this.title = "";
    this.cover = "";

    this.tabs[0] = document.querySelectorAll(".tab")[0]; // initialization of the first tab.
    this.tabs[0].addEventListener("click", ()=> this.setCurrentPage());
    this.createPageDataTemplate();
  }
  // POST MANAGEMENT
  fillFormInputs(){
    postTitle.value = this.title;
    postCover.value = this.cover;
    postInstructions.value = this.createPostStringSimple(this.instructions);
    postMaterials.value = this.createPostStringSimpleList(this.materials);
    postImages.value = this.createPostStringSimple(this.images);
  }

  fillListMemberFromString(field, text){
    if(text.length < 1) return;    

    m_content = [];
    // first: divide by pages. &
    pages = text.split("&");
    // second: divide by list element. ,
    pages.forEach((el, index)=>{
      elements = el.split(","); 
      m_content.push(elements);
    })
  }

  createPostStringSimple(field){
    let postString = "";

    field.forEach((el, index)=>{
      if(index == field.length - 1){
        postString += (el == "")? "vacío" : el;
      } else {
        postString += ((el == "")? "vacío" : el) + "&";
      }
    })

    return postString;
  }

  createPostStringSimpleList(field){
    let postString = "";

    field.forEach((page, index)=>{

      page.forEach((material, index2)=>{

        if(index2 != field[index].length - 1){
          postString += ((material == "") ? "vacío" : material) + ",";
        } else {
          postString += ((material == "") ? "vacío" : material);
        }

      }) 

      if(index != field.length - 1){
        postString += "&";
      }

    })

    return postString;
  }


  // PAGE MANAGEMENT
  fillContentPerPage(){
    this.fillElementContentSimple(textarea, this.instructions);
    this.fillElementContentSimple(urlInp, this.images);
    this.fillElementContentList(materialList, this.materials);

  }

  fillElementContentList(htmlElement, field){

    htmlElement.innerHTML = "";
    const df = document.createDocumentFragment();

    if(field[this.page - 1] == undefined) return;

    field[this.page - 1].forEach((el, index)=>{
     
      const div = document.createElement("div");
      const p = document.createElement("p");
      const button = document.createElement("button");
      const span = document.createElement("basura-icon");

      div.classList.add("material-item");
      p.classList.add("material-title");
      button.classList.add("delete-bttn");
      span.classList.add("basura-icon");

      p.textContent = el;

      div.appendChild(p);
      button.appendChild(span);
      div.appendChild(button);

      button.addEventListener("click", ()=>{
        htmlElement.removeChild(div); 
        field[this.page - 1].splice(index, 1);
        alert(`Material ${el} eliminado.`);
      })

      df.appendChild(div);
    })
    htmlElement.appendChild(df);
  }

  fillElementContentSimple(htmlElement, field){
    htmlElement.textContent = field[this.page - 1] || "";
    htmlElement.value = field[this.page - 1] || "";
  }

  setCurrentPage(page = 1){
    this.page = page;
    this.setSelectedVisual();
    this.fillContentPerPage();
  }

  removePageData(){
    this.tabs.splice(this.page - 1, 1);
    this.instructions.splice(this.page - 1, 1);
    this.images.splice(this.page - 1, 1);
    this.materials.splice(this.page - 1, 1);
  }

  setSelectedVisual(){
    const tabs = document.querySelectorAll(".tab");
    tabs.forEach((el, index)=>{
      if(el.id == this.page){
        el.classList.add("tab-selected");
      } else {
        el.classList.remove("tab-selected");
      }
    })
  }

 

  // TABS MANAGEMENT
  addTab() {
    // cancelar si se alcanzo el maximo de tabs.
    if(this.nTabs + 1 > this.maxTabs) {
      alert(`Limite de instrucciones alcanzado ${this.maxTabs}`);
      return;
    };
    
    // agregar en el html
    const button = document.createElement("button");

    // metadatos del boton
    let pageIndex = this.nTabs + 1;
    button.classList.add("tab");
    button.setAttribute("id", pageIndex);
    button.textContent = `Tab ${pageIndex}`;

    button.addEventListener("click", ()=> this.setCurrentPage(pageIndex));

    tabsContainer.appendChild(button);

    // agregar en la estructura de datos de la clase.
    this.tabs.push(button);
    this.nTabs++;
    this.page = this.tabs.length;

    this.createPageDataTemplate();

    this.setSelectedVisual();
    this.setCurrentPage(pageIndex);
  }

  createPageDataTemplate(){
    this.images[this.page - 1] = [];
    this.materials[this.page - 1] = [];
    this.instructions[this.page - 1] = "";
  }

  removeTab(){
    if(this.nTabs > 1){

      tabsContainer.removeChild(this.tabs[this.page - 1]);

      this.nTabs--;
      this.removePageData();

      // reposiciona la pagina si se elimina la ultima.
      if(this.page > this.tabs.length){
        this.page = this.tabs.length - 1;
      }

      this.refreshTabs();

      this.setCurrentPage();

    } else {
      alert("Debe contener mínimo una instrucción.");
    } 
  }

  refreshTabs(){
    this.tabs.forEach((el, index)=>{
      el.setAttribute("id", index + 1);
      el.textContent = `Tab ${index + 1}`;
      el.addEventListener("click", ()=> this.setCurrentPage(index + 1));
    })
  }

  //MATERIALS MANAGEMENT
  addMaterial(title){
    if(title == "" || title == "Elija material"){
      alert("El nombre del material no puede estar vacío.");
      return;
    }

    if(this.materials[this.page - 1] == undefined){
      this.materials[this.page - 1] = []; 
    }

    if(this.materials[this.page - 1].includes(title)) {
      alert("Este material ya esta en la lista");
      return;
    }

    this.materials[this.page - 1].push(title);
    console.log(this.materials);
    this.fillContentPerPage();
    materialInp.value = "";
    materialSelect.value = "Elija material";
  }

 // STATES MANAGEMENTS 
  addInstructions(text){
    this.instructions[this.page - 1] = text;
  }

  addImage(url){
    this.images[this.page - 1] = url;
  }

  addTitle(title){
    this.title = title;
  }

  addCover(title){
    this.cover = title;
  }

  //GETTERS AND SETTERS
  getNTabs(){
    return this.nTabs;
  }

}



// event listeners

function validateFields(){
  const fields = [postTitle, postInstructions, postMaterials, postImages, postCover];
  let isValid = true;
  fields.forEach((el, ind)=>{
    console.log(el.value == "")
    if(el.value == "") {
      isValid = false;
    }
  })

  return isValid;
}

window.onload = ()=> {
  const idea = new Idea();

  addTabsBttn.addEventListener("click", ()=> idea.addTab());
  rmTabBttn.addEventListener("click", ()=> idea.removeTab());
  textarea.addEventListener("input", (e)=> idea.addInstructions(e.target.value));
  urlInp.addEventListener("input", (e)=> idea.addImage(e.target.value));
  materialInpBttn.addEventListener("click", ()=> idea.addMaterial(materialInp.value));
  materialSelectBttn.addEventListener("click", ()=> idea.addMaterial(materialSelect.value));
  titleInp.addEventListener("input", (e)=> idea.addTitle(e.target.value));
  coverInp.addEventListener("input", (e)=> idea.addCover(e.target.value));

  form.addEventListener("submit", (e)=>{
    e.preventDefault();
    idea.fillFormInputs();

    if(!validateFields()){
      alert("Debe de rellenar todos los campos requeridos.");
      return;
    }

    if(confirm("¿Está seguro de publicar? se borrarán los datos al publicar.")){
      form.submit();
    } 
  })
}


