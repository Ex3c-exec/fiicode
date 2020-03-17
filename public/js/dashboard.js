// COMPONENT SHOW SYSTEM // AFISARE TABURI
function componentSelector(componentID){
    const components = ['single-book-component', 'multiple-books-component'];
    
    componentID = componentID.replace('btn','component')
    console.log(componentID)
    components.forEach(component=>{
        if(component == componentID)
            document.getElementById(component).style.display = 'block';
        else
            document.getElementById(component).style.display = 'none';
    })
    }
    document.addEventListener('DOMContentLoaded', componentSelector('multiple-books-component'));