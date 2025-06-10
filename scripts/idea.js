// html elements that are going to be used by the class instance.
const addTabsBttn = document.getElementById("add-tab");
const rmTabBttn = document.getElementById("remove-tab");
const tabsContainer = document.getElementById("tabs-container");
const textarea = document.getElementById("content-textarea");

// class declaration: the idea is to keep all the info inside a class instance.
class Idea{
  constructor(){
    this.maxTabs = 8;
    this.nTabs = 1; // counter of the current amount of tabs.
    this.page = 1; // current page.
    this.materials = {} // {1: [], 2: [], ... n: []}
    this.instructions = [] // {1: "", 2: "", ... n: ""}  
    this.tabs = []; // {html1, thtml2} list of the html objects so I can destroy them.

    this.tabs[0] = document.querySelectorAll(".tab")[0]; // initialization of the first tab.
    this.tabs[0].addEventListener("click", ()=> this.setCurrentPage());
  }
  // PAGE MANAGEMENT
  fillContentPerPage(){
    textarea.textContent = this.instructions[this.page] || "";
    textarea.value = this.instructions[this.page] || "";
    console.log(this.page);
    console.log(this.instructions[this.page] || "");
  }

  setCurrentPage(page = 1){
    this.page = page;
    this.setSelectedVisual();
    this.fillContentPerPage();
  }

  // INSTRUCTIONS MANAGEMENTS 
  addInstructions(text){
    this.instructions[this.page] = text;
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

      this.tabs.splice(this.page - 1, 1);
      this.instructions.splice(this.page - 1, 1);
      console.log(this.instructions)
      this.nTabs--;

      // reposiciona la pagina si se elimina la ultima.
      if(this.page > this.tabs.length){
        this.page = this.tabs.length - 1;
      }

      this.tabs.forEach((el, index)=>{
        console.log(el);
        el.setAttribute("id", index + 1);
        el.textContent = `Tab ${index + 1}`;
        el.addEventListener("click", ()=> this.setCurrentPage(index + 1));
      })

      this.setCurrentPage();
      console.log("removed");
    } else {
      alert("Debe contener mínimo una instrucción.");
    } 
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
}


