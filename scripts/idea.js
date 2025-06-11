// html elements that are going to be used by the class instance.
const addTabsBttn = document.getElementById("add-tab");
const rmTabBttn = document.getElementById("remove-tab");
const tabsContainer = document.getElementById("tabs-container");
const textarea = document.getElementById("content-textarea");
const urlInp = document.getElementById("url-inp");
const materialSelectBttn = document.getElementById("add-material-1");
const materialInpBttn = document.getElementById("add-material-2");

const materialSelect = document.getElementById("material-select");
const materialInp = document.getElementById("material-input");

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

    this.tabs[0] = document.querySelectorAll(".tab")[0]; // initialization of the first tab.
    this.tabs[0].addEventListener("click", ()=> this.setCurrentPage());
  }
  // PAGE MANAGEMENT
  fillContentPerPage(){
    this.fillElementContent(textarea, this.instructions);
    this.fillElementContent(urlInp, this.images);
  }

  fillElementContent(htmlElement, field){
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
    this.setSelectedVisual();
    this.setCurrentPage(pageIndex);
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
    if(this.materials[this.page - 1] == undefined){
      this.materials[this.page - 1] = []; 
    }

    if(this.materials[this.page - 1].includes(title)) {
      alert("Este material ya esta en la lista");
      return;
    }

    this.materials[this.page - 1].push(title);
    console.log(this.materials);
  }

 // STATES MANAGEMENTS 
  addInstructions(text){
    this.instructions[this.page - 1] = text;
  }

  addImage(url){
    this.images[this.page - 1] = url;
  }

  //GETTERS AND SETTERS
  getNTabs(){
    return this.nTabs;
  }

}



// event listeners

window.onload = ()=> {
  const idea = new Idea();

  addTabsBttn.addEventListener("click", ()=> idea.addTab());
  rmTabBttn.addEventListener("click", ()=> idea.removeTab());
  textarea.addEventListener("input", (e)=> idea.addInstructions(e.target.value));
  urlInp.addEventListener("input", (e)=> idea.addImage(e.target.value));
  materialInpBttn.addEventListener("click", ()=> idea.addMaterial(materialInp.value));
  materialSelectBttn.addEventListener("click", ()=> idea.addMaterial(materialSelect.value));
}


