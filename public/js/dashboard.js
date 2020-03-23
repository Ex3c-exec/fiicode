// VARIABILE GLOBALE
let books = []

// REQUESTS CLASS FOR GLOBAL DATA
class AjaxRequest {
    constructor(){
        this.url_books = './php/books/';
    }

    getBooks(){
        const type = 'ALL_BOOKS';
        fetch(this.url_books + 'returnRequest.php?' + type)
        .then(response=>{
            return response.json()
        })
        .then(res=>{
            books = res;
            multipleBooksComponentDOM()
        })
        .catch(err=>{
            console.log(err)
        })
    }
}

const responseData = new AjaxRequest()

//  SCHIMBAM HREF-UL
const changeHref = (href)=>{
    window.location.replace('#' + href)
}

// ONLOAD SET VARIBLES
document.addEventListener('DOMContentLoaded', ()=>{
    responseData.getBooks()
});

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
                    <img src="${book.img}" alt="book" class="img-thumbnail">
                </div>
                <div class="col-lg-9 col-sm-9">
                    <h2>Title:“${book.title}”</h2>
                    <h4>Author:${book.author}</h4>
                    <h4>Description:</h4>
                    <h4 class="descriptionLimited">${book.description}</h4>
                    <button class="btn-style" id="single-book-component/${book.id}" onclick="changeHref(this.id)">More</button>
                </div>
                <div class="col-lg-1 col-sm-3">
                    <button class="btn-like hideOnSmall"><img src="./images/heart.png" alt="heart"><p>${book.likes}</p></button>
                </div>
            </div>`;
    })
    window.scrollTo(0, 0);
    document.getElementById('all-books-component').innerHTML = output;
}

// INCARCAM TAMPLATE-UL PENTRU CARTE (single-book-component)
const singleBookComponentDOM = (bookId) => {
    // CAUTAREA CARTII IN OBIECTUL CARTI
    let selectedBook = books.find(book=>book.id == bookId);
    let output = '';
    if(typeof(selectedBook) == "undefined")
    {
    output = 
    `<div class="bookUnselectedContainer text-center">
        <h2>This book doesn't exist.</h2>
    </div>`;
    } else {
        output = 
        `<div class="row bookUnselectedContainer">
            <div class="col-lg-2 col-sm-12">
                <img src="${selectedBook.img}" alt="book" class="img-thumbnail-unic">
            </div>
            <div class="col-lg-9 col-sm-9">
                <h2>Title: “${selectedBook.title}”</h2>
                <h4>Author: ${selectedBook.author}</h4>
                <h4>Description:</h4>
                <h4>${selectedBook.description}</h4>
                <button class="btn-style" id="multiple-books-btn" onclick="changeHref(this.id)">Back</button>
                <button class="btn-style" id="req${selectedBook.id}" onclick="requestBookMiddleware(this.id)">
                    ${selectedBook.available == 1 ? ('Request') : ('Not available')}
                </button>
            </div>
            <div class="col-lg-1 col-sm-3">
                <button class="btn-like hideOnSmall"><img src="./images/heart.png" alt="heart"><p>${selectedBook.likes}</p></button>
            </div>
        </div>`;
    }
    window.scrollTo(0, 0);
    document.getElementById('single-book-component').innerHTML = output;
}

function requestBookMiddleware(id){
    id = id.slice(3);
    // console.log(id)
    const new_book = books.find(book=> book.id == id)
    if(new_book.available == 1)
        changeHref(`request-component/${id}`)
    else {
        Swal.fire({
            icon: 'info',
            text: 'Book is not available now.',
            confirmButtonColor: "#643754"
          })
    }
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
            <button class="btn-style float-lg-right btn-style-width">Last requests</button><br/>
            <button class="btn-style float-lg-right btn-style-width">Change password</button><br/>
        </div>
    </div>`;
    document.getElementById('account-component').innerHTML = output;
}


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

// COMPONENT SHOW SYSTEM // AFISARE COMPONENTA 
function componentSelector(componentID){
    const components = ['single-book-component', 'multiple-books-component', 'request-component', 'account-component'];
    
    componentID = componentID.replace('btn','component')
    components.forEach(component=>{
        if(componentID.includes(component)) {
            document.getElementById(component).style.display = 'block';
            window.location.replace('#' + componentID);
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

// SEARCH BAR PENTRU CARTI (multiple-books-component)
document.getElementById('search-val').addEventListener('input', ()=>{
    const search = document.getElementById('search-val').value;
    let booksCpy;
    if(search == '')
        booksCpy = null;
    else
        booksCpy = books.filter(book=> book.title.toLowerCase().startsWith(search.toLowerCase()))

    multipleBooksComponentDOM(booksCpy)
})
