// VARIABILE GLOBALE
let books = []
let requests = [
    {id:1, book:"Povestile lui Ilie", date:'12-03-2020', status:'pending', name:"Anfimov Vladimir", email:'vladimir@yahoo.com',address:'Dimitrie Dan 67c', phone:'073039302', term:'2 weeks'},
    {id:2, book:"Calea de aur", date:'11-11-2020', status:'declined', name:"Tania Miri", email:'Tania@yahoo.com',address:'Magrule 32c', phone:'072033443', term:'1 weeks'},
    {id:3, book:"La vanitr de mure", date:'11-11-2024', status:'pending', name:"Sarmua Lara", email:'Gigelia@yahoo.com',address:'Tiganai 23b', phone:'082222222', term:'1 weeks'}
]
let account = {
    name:"Anfimov Vladimir",
    email:"vladymir100@gmail.com",
    address: 'Dimitire Dan 67C'
}

// REQUESTS CLASS FOR GLOBAL DATA
class AjaxRequest {
    constructor(){
        this.url_books = './php/books/';
    }

    checkPass(){
        return 'parola';
    }

    setPass(pass){
        // TREBUIE VERIFICAT DACA NU E EROARE DE SERVER
        Swal.fire({
            icon: 'success',
            text: 'Password changed.',
            confirmButtonColor: "#643754"
          })
        console.log('PAROLA NOUA', pass)
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

    newBook(title, author, img, description){
        const formData = `title=${title}&author=${author}&img=${img}&description=${description}&ADD_BOOK=1`;
        // console.log(formData)
        fetch(this.url_books + 'inserareRequest.php', {
            method: 'POST',
            headers: {
                'Content-Type':'application/x-www-form-urlencoded'
            },
            body: formData
        }).then(response=>{
            return response.json()
        })
        .then(res=>{
            responseData.getBooks()
        })
        .catch(err=>{
            console.log(err)
        })
    }

    deleteBook(id){
        const formData = `id=${id}&DELETE_BOOK`;
        console.log(formData)
        fetch(this.url_books + 'deleteRequest.php', {
            method: 'POST',
            headers: {
                'Content-Type':'application/x-www-form-urlencoded'
            },
            body: formData
        }).then(response=>{
            return response.json()
        })
        .then(res=>{
            responseData.getBooks()
            Swal.fire({
                icon: 'success',
                text: 'Book deleted.',
                confirmButtonColor: "#643754"
              })
              .then(()=>{
                changeHref('#multiple-books-component');
              })
             

        })
        .catch(err=>{
            Swal.fire({
                icon: 'error',
                text: 'Book could not be deleted.',
                confirmButtonColor: "#643754"
              })
        })
    }

    editBook(id, title, author, img, description, available){
        // console.log(id, title, author, img, description)
        const formData = `id=${id}&title=${title}&author=${author}&img=${img}&description=${description}&available=${available}&UPDATE_BOOK=1`;
        fetch(this.url_books + 'editRequest.php', {
            method: 'POST',
            headers: {
                'Content-Type':'application/x-www-form-urlencoded'
            },
            body: formData
        }).then(response=>{
            return response.json()
        })
        .then(res=>{
            if(typeof(res.eroare) != 'undefined')
                throw new Error(`occured, book can't be edited`);
            responseData.getBooks()
            Swal.fire({
                icon: 'success',
                text: 'Book successfully edited.',
                confirmButtonColor: "#643754"
              })
              .then(()=>{
                changeHref(`single-book-component/${id}`);
                document.getElementById('title@ed').value = document.getElementById('author@ed').value = document.getElementById('img@ed').value = document.getElementById('descr@ed').value = '';
              })
        })
        .catch(err=>{
            Swal.fire({
                icon: 'error',
                text: err,
                confirmButtonColor: "#643754"
              })
        })
    }
}

const responseData = new AjaxRequest()

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
    // console.log(booksCpy.length)
    if(booksCpy.length == 0){
        output +=
        `<div class="bookUnselectedContainer text-center">
            <h2>There are no books.</h2>
        </div>`;
    } else {
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
    }
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
                <button class="btn-style" id="delete@book/${selectedBook.id}" onclick="deleteBookFunc(this.id)">Delete</button>
                <button class="btn-style" id="edit-book-btn/${selectedBook.id}" onclick="changeHref(this.id)">Edit</button>
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
    let output =
    `<div class="templateMiniContainer row">
        <div class="col-lg-6 col-sm-12 text-left">
            <div class="text-center text-lg-left">
                <img class="user-photo img-fluid" src="./images//user-photo.png" alt="userphoto"><br>
                    <button onclick="uploadAccountPhoto()" class="btn-style">Change photo</button>
            </div>
            <div class="m-3">
                <h3 class="">Name: <span class="d-block d-lg-inline">${account.name}</span></h3>
                <h3 class="">Email: <span class="d-block d-lg-inline">${account.email}</span></h3>
                <h3 class="">Address: <span class="d-block d-lg-inline">${account.address}</span></h3>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <button class="btn-style float-lg-right btn-style-width">Last requests</button><br/>
            <button onclick="changePass()" class="btn-style float-lg-right btn-style-width">Change password</button><br/>
        </div>
    </div>`;
    document.getElementById('account-component').innerHTML = output;
}

// INCARCAM TAMPLATE-UL PENTRU EDIT BOOK (edit-book-component)
const editBookComponentDOM =(id)=>{
    const edited_book = books.filter(book=>book.id == id)
    let output = '';
    if(typeof(edited_book[0])=='undefined')
    output =`<div class="templateMiniContainer text-center"><h2>This book doesn't exist.</h2></div>`;
    else {
        // console.log(edited_book[0].available)
        output =`<div class="templateMiniContainer">
                    <h1>Edit book</h1>
                    <form id="editBook${id}" onsubmit="editBookSumbit(this.id)">
                        <h4>Title</h4>
                        <input id="title@ed" value="${edited_book[0].title}" type="text" required><br />
                        <h4>Author</h4>
                        <input id="author@ed" value="${edited_book[0].author}" type="text" required><br />
                        <h4>Image source</h4>
                        <input id="img@ed" type="text" value="${edited_book[0].img}" required><br />
                        <h4>Description</h4>
                        <textarea id="descr@ed" type="text" required rows="4" cols="50" >
                            ${edited_book[0].description}
                        </textarea>
                        <h4>Available</h4>
                        <select id="available@ed" required>
                            <option value="1" ${edited_book[0].available == 0 ? ('selected="selected"') : ('')} >Yes</option>
                            <option value="0" ${edited_book[0].available == 0 ? ('selected="selected"') : ('')}>No</option>
                        </select
                        <br /><br />
                        <button class="btn-style">Edit book</button>
                    </form>
                </div>`;
        }
    document.getElementById('edit-book-component').innerHTML = output;
}

// INCARCAM TAMPLATE-UL PENTRU REQUESTS (requests-component)
const requestsComponentDOM = () => {

    let output = '';
    requests.forEach(req=>{
            output += 
           `<div style="margin:8px 0">
           <div onclick="slideFunc(${req.id})" class="requestsList-item" id="req${req.id}">
                <div>Book: ${req.book}</div>
                <div>Date: ${req.date}</div>
                <div>Status: ${req.status}</div>
            </div>
                <div id="slide${req.id}" style="display:none" class="requestsList-item">
                    <div>
                        <p>Name: ${req.name}</p>
                        <p>Email: ${req.email}</p>
                        <p>Address: ${req.address} </p>
                    </div>
                    <div>
                        <p>Phone: ${req.phone}</p>
                        <p>Term: ${req.term} </p>
                    </div>
                    <div>
                        <button onclick="acceptRequest(${req.id})" ${req.status != 'pending' ? ('style="display:none"'): ('')}>Accept</button><br />
                        <button onclick="declineRequest(${req.id})" ${req.status != 'pending' ? ('style="display:none"'): ('')}>Decline</button>
                    </div>
                </div>
            </div>`;
    })
    
    document.getElementById('requestsList').innerHTML = output;
}

// ACCEPT REQUEST FUNCTION
function acceptRequest(id){
    Swal.fire({
        text: "Are you sure you want to accept this request?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#643754',
        cancelButtonColor: '#904e79',
        confirmButtonText: 'Yes, accept it!'
      }).then((result) => {
        if (result.value) {
            console.log('accept', id)
        }
      })
}

// DECLINE REQUEST FUNCTION
function declineRequest(id){
    Swal.fire({
        text: "Are you sure you want to decline this request?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#643754',
        cancelButtonColor: '#904e79',
        confirmButtonText: 'Yes, decline it!'
      }).then((result) => {
        if (result.value) {
            console.log('decline', id)
        }
      })
}

// SLIDE FUNC (ARATA DETALIILE REQUESTULUI CAND APESI PE REQ RESEPECTIV)
function slideFunc(id){
    const div = document.getElementById(`slide${id}`);
    if(div.style.display == 'flex')
        div.style.display = 'none';
    else
        div.style.display = 'flex';
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
    else if(component == 'requests-component'){
        requestsComponentDOM();
    }
    else if(component.includes('edit-book-component')){
        // PRELCUCRAM HASH-UL PT A SCOATE ID-UL
        let bookId = window.location.hash.slice(21); 
        editBookComponentDOM(bookId);
    }
}

// COMPONENT SHOW SYSTEM // AFISARE COMPONENTA 
function componentSelector(componentID){
    const components = ['single-book-component', 'multiple-books-component', 'request-component', 'account-component', 'newbook-component',
     'requests-component', 'edit-book-component'];
    
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

//  SCHIMBAM HREF-UL
const changeHref = (href)=>{
    window.location.replace('#' + href)
}

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

// LISTEN TO NEW BOOK SUBMIT
document.getElementById('newBookSubmit').addEventListener('submit',()=>{
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to add this book?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#643754',
        cancelButtonColor: '#904e79',
        confirmButtonText: 'Yes, add it!'
      }).then((result) => {
        if (result.value) {
            Swal.fire({
            icon: 'success',
            text: 'Book successfully added.',
            confirmButtonColor: "#643754"
            })
            const props = {
                title: document.getElementById('title@').value,
                author: document.getElementById('author@').value,
                img: document.getElementById('img@').value,
                descr: document.getElementById('descr@').value
            }
            responseData.newBook(props.title, props.author, props.img, props.descr)
            document.getElementById('title@').value = document.getElementById('author@').value = document.getElementById('img@').value = document.getElementById('descr@').value = '';
        }
      }) 
})

// MIDDLEWARE FOR DELETE
function deleteBookFunc(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#643754',
        cancelButtonColor: '#904e79',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
            const new_id = id.slice(12)
            responseData.deleteBook(new_id);
            // console.log(new_id)
        }
      })
    
}

function editBookSumbit(id){
    const new_id = id.slice(8)
    const props = {
        id: new_id,
        title: document.getElementById('title@ed').value,
        author: document.getElementById('author@ed').value,
        img: document.getElementById('img@ed').value,
        descr: document.getElementById('descr@ed').value,
        available: document.getElementById('available@ed').value
    }
    // console.log(props.available)
    responseData.editBook(props.id, props.title, props.author, props.img, props.descr, props.available) 
}

async function uploadAccountPhoto(){
    const { value: url } = await Swal.fire({
        input: 'url',
        inputPlaceholder: 'Enter the URL',
        confirmButtonColor: "#643754"
      })
      if (url) {
        Swal.fire({
            icon: 'success',
            text: 'Photo changed.',
            confirmButtonColor: "#643754"
          })
      }
}

async function changePass() {
    const { value: password } = await Swal.fire({
        title: 'Enter your current password',
        input: 'password',
        inputPlaceholder: 'Enter your password',
        confirmButtonColor: "#643754",
        inputAttributes: {
          maxlength: 20,
          autocapitalize: 'off',
          autocorrect: 'off'
        },
        inputValidator: (value) => {
            if (value !== responseData.checkPass()) {
              return `Password doesn't match!`
            }
          }
      })
      
      if (password) {
        const { value2: password2 } = Swal.fire({
            title: 'Enter your new password',
            input: 'password',
            inputPlaceholder: 'Enter your new password',
            confirmButtonColor: "#643754",
            inputAttributes: {
              maxlength: 20,
              autocapitalize: 'off',
              autocorrect: 'off'
            },
            inputValidator: (value2) => {
                if (value2 == responseData.checkPass()) {
                  return `New password can't pe the same!`;
                }
                else 
                    responseData.setPass(value2)
              }
          })
      }
}