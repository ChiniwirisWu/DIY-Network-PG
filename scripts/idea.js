// html elements that are going to be used by the class instance.
const tabsBttn = document.getElementById("add-tab");
const tabsContainer = document.getElementById("tabs-container");

// class declaration: the idea is to keep all the info inside a class instance.
class Idea{
  constructor(){
    this.maxTabs = 8;
    this.nTabs = 1; // counter of the current amount of tabs.
    this.page = 1; // current page.
    this.materials = {} // {1: [], 2: [], ... n: []}
    this.instructions = {} // {1: "", 2: "", ... n: ""}  
    this.tabs = []; // {html1, thtml2} list of the html objects so I can destroy them.

    this.tabs[0] = document.querySelectorAll(".tab")[0]; // initialization of the first tab.
  }

  addTab() {
    // cancelar si se alcanzo el maximo de tabs.
    if(this.nTabs + 1 > this.maxTabs) {
      alert(`Limite de instrucciones alcanzado ${this.maxTabs}`);
      return;
    };
    
    // agregar en el html
    const button = document.createElement("button");
    button.classList.add("tab");
    button.textContent = `Tab ${this.nTabs}`;

    tabsContainer.appendChild(button);

    // agregar en la estructura de datos de la clase.
    this.nTabs++;
    this.page++;
    this.tabs.push(button);
  }

  addMaterial(){

  }
}



// event listeners

window.onload = ()=> {
  const idea = new Idea();

  tabsBttn.addEventListener("click", ()=> idea.addTab());
}

