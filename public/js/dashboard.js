// COMPONENT SHOW SYSTEM // AFISARE COMPONENTA 
function componentSelector(componentID){
    const components = ['single-book-component', 'multiple-books-component', 'request-component', 'account-component'];
    
    componentID = componentID.replace('btn','component')
    components.forEach(component=>{
        if(component == componentID) {
            document.getElementById(component).style.display = 'block';
            window.location.replace('#' + component);
            // window.scrollTo(0, 0);
        }
        else
            document.getElementById(component).style.display = 'none';
    })
}
document.addEventListener('DOMContentLoaded', componentSelector('multiple-books-component'));

// VERIFICAM DACA HREF-UL S-A SCHIMBAT
window.addEventListener('hashchange', ()=>{
    let href = window.location.hash;
    if(href.charAt(0) == '#')
        href = href.substr(1);
    componentSelector(href)
})

//  SCHIMBAM HREF-UL
const changeHref = (href)=>{
    window.location.replace('#' + href)
}