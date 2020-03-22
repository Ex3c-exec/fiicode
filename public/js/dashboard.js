// VARIABILE GLOBALE
let books = [
    { id: 1, title:'Pagini alese', author:'George Cosbuc', likes:41, description:`Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.`  },
    { id: 2, title:'Elefantul verde', author:'Miralea Bade', likes:52, description:`Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.`  },
    { id: 3, title:'Mama pierduta', author:'Sisi Gegilica', likes:622, description:`Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.`  },
    { id: 4, title:'Martinel dupa droage', author:'Tigan prost', likes:222, description:`Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.`  }
]

// VERIFICAM CE OBIECT TREBUIE CERUT DE LA SERVER SI IL ACTUALIZAM PT AL AVEA IN MEMORIE
const checkObjectData = (component) => {
    if(component == 'multiple-books-component'){
        // FACEM CEREREA DE LA SERVER PT OBIECT
        multipleBooksComponentDOM();
    }
    else if(component.includes('single-book-component')){
        // PRELCUCRAM HASH-UL PT A SCOATE ID-UL
        let bookId = window.location.hash.slice(23); 
        singleBookComponentDOM(bookId);
    }
    else if(component == 'account-component'){
        accountComponentDOM();
    }
}

// INCARCAM TAMPLATE-UL PENTRU CARTI (multiple-books-component)
const multipleBooksComponentDOM = (booksCpy = books) =>{
    if(booksCpy === null)
        booksCpy = books;
    let output = '';
    let nr = 0;
    booksCpy.forEach(book=>{
        output +=
           `<div id="book${book.id}" class="row bookUnselectedContainer">
                <div class="col-lg-2 col-sm-12 hideOnSmall">
                    <img src="./images/testBOOK.jpg" alt="book" class="img-thumbnail">
                </div>
                <div class="col-lg-9 col-sm-9">
                    <h2>Title:“${book.title}”</h2>
                    <h4>Author:${book.author}</h4>
                    <h4>Description:</h4>
                    <h4>${book.description}</h4>
                    <button class="btn-style" id="single-book-component/${book.id}" onclick="changeHref(this.id)">More</button>
                </div>
                <div class="col-lg-1 col-sm-3">
                    <button class="btn-like hideOnSmall"><img src="./images/heart.png" alt="heart"><p>${book.likes}</p></button>
                </div>
            </div>`;
    })
    document.getElementById('all-books-component').innerHTML = output;
}

// INCARCAM TAMPLATE-UL PENTRU CARTE (single-book-component)
const singleBookComponentDOM = (bookId) => {
    // CAUTAREA CARTII IN OBIECTUL CARTI
    let selectedBook = books.find(book=>book.id == bookId);
    let output = 
    `<div class="row bookUnselectedContainer">
        <div class="col-lg-2 col-sm-12">
            <img src="./images/testBOOK.jpg" alt="book" class="img-thumbnail-unic">
        </div>
        <div class="col-lg-9 col-sm-9">
            <h2>Title: “${selectedBook.title}”</h2>
            <h4>Author: ${selectedBook.author}</h4>
            <h4>Description:</h4>
            <h4>${selectedBook.description}</h4>
            <button class="btn-style" id="multiple-books-btn" onclick="changeHref(this.id)">Back</button>
            <button class="btn-style" id="request-btn/${selectedBook.id}" onclick="changeHref(this.id)"> Request / Not available now</button>
        </div>
        <div class="col-lg-1 col-sm-3">
            <button class="btn-like hideOnSmall"><img src="./images/heart.png" alt="heart"><p>${selectedBook.likes}</p></button>
        </div>
    </div>`;
    
    document.getElementById('single-book-component').innerHTML = output;
}

// INCARCAM TAMPLATE-UL PENTRU ACCOUNT (account-component)
const accountComponentDOM =()=>{
    //TREBUIE LUAT DIN BAZA DE DATE !!!!!!!!!!!!!!!!!!!!!!!!!!
    let account = {lname:'Vladiddddmir', fname:'Anfimov', email:'vladimir@gm.com', address:'Dimitire Dan 67C'};
    let output =
    `<div class="templateMiniContainer row">
        <div class="col-lg-6 col-sm-12 text-left">
            <div class="text-center text-lg-left">
                <img class="user-photo img-fluid" src="./images//user-photo.png" alt="userphoto"><br>
                    <button class="btn-style">Change photo</button>
            </div>
            <div class="m-3">
                <h3 class="">Name: <span class="d-block d-lg-inline">${account.fname} ${account.lname}</span></h3>
                <h3 class="">Email: <span class="d-block d-lg-inline">${account.email}</span></h3>
                <h3 class="">Address: <span class="d-block d-lg-inline">${account.address}</span></h3>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <button class="btn-style float-lg-right btn-style-width">Change account info</button><br/>
            <button class="btn-style float-lg-right btn-style-width">Last requests</button><br/>
            <button class="btn-style float-lg-right btn-style-width">Change password</button><br/>
        </div>
    </div>`;
    document.getElementById('account-component').innerHTML = output;
}

// COMPONENT SHOW SYSTEM // AFISARE COMPONENTA 
function componentSelector(componentID){
    const components = ['single-book-component', 'multiple-books-component', 'request-component', 'account-component'];
    
    componentID = componentID.replace('btn','component')
    components.forEach(component=>{
        if(componentID.includes(component)) {
            document.getElementById(component).style.display = 'block';
            window.location.replace('#' + componentID);
            // window.scrollTo(0, 0);
            checkObjectData(component)
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

// SEACH BAR PENTRU CARTI (multiple-books-component)
document.getElementById('search-val').addEventListener('input', ()=>{
    const search = document.getElementById('search-val').value;
    let booksCpy;
    if(search == '')
        booksCpy = null;
    else
        booksCpy = books.filter(book=> book.title.toLowerCase().startsWith(search.toLowerCase()))

    multipleBooksComponentDOM(booksCpy)
})
