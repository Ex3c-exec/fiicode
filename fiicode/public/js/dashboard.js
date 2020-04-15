// VARIABILE GLOBALE
let books = []
let requests = []
let account = {
    name:'',
    email:'',
    address: ''
}
let personalRequests = [];
let personalLikes = [];

// REQUESTS CLASS FOR GLOBAL DATA
class AjaxRequest {
    constructor(){
        this.url_books = './php/books/';
        this.url_account = './php/account/',
        this.url_requests = './php/requests/';
        this.url_likes = './php/likes/';
    }

    seePersonalLikes(){
        fetch(this.url_likes + 'likeRequest.php')
        .then(response=>{
            return response.json()
        })
        .then(res=>{
            if(typeof(res.eroare) != 'undefined')
                {
                    console.log(res)
                    throw new Error(`Page failed, please refresh (books...)`);
                }
            personalLikes = res;
            this.getBooks()
            console.log(personalLikes)
        })
        .catch(err=>{
            Swal.fire({
                icon: 'error',
                text: err,
                confirmButtonColor: "#643754"
              })
        })
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

    getAccount(){
        const type = 'ACCOUNT_REQUEST'
        fetch(this.url_account + 'contRequest.php?' + type)
        .then(response=>{
            return response.json()
        })
        .then(res=>{
            if(typeof(res.eroare) != 'undefined')
                {
                    console.log(res)
                    throw new Error(`occured, account can't be found`);
                }
            // console.log(res)
            account = {
                name: res.first + " " + res.last,
                email:res.email,
                address: res.address
            }
            accountComponentDOM()
        })
        .catch(err=>{
            Swal.fire({
                icon: 'error',
                text: err,
                confirmButtonColor: "#643754"
              })
        })
    }

    setPass(pass){
        const formData = `pass=${pass}&SET_PASS`;
        fetch(this.url_account + 'setPassRequest.php', {
            method:'POST',
            headers: {
                'Content-Type':'application/x-www-form-urlencoded'
            },
            body: formData
        })
        .then(response=>{
            return response.json()
        })
        .then(res=>{
            if(typeof(res.eroare) != 'undefined'){
                console.log(res)
                throw new Error(`occured, password can't be set`);
            }
            Swal.fire({
                icon: 'success',
                text: 'Password changed.',
                confirmButtonColor: "#643754"
          })
        })
        .catch(err=>{
            console.log(err)
            Swal.fire({
                icon: 'error',
                text: err,
                confirmButtonColor: "#643754"
              })
        })
    }

    createRequest(phone, term, id, email){
        const book = books.find(book=> book.id == id).title;
        const formData = `term=${term}&phone=${phone}&email=${email}&book=${book}&CREATE_REQUEST`;
        console.log(formData)
        fetch(this.url_requests + 'create.php', {
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
                    throw new Error(res.eroare);
                    Swal.fire({
                        icon: 'success',
                        text: 'Request successfully made.',
                        confirmButtonColor: "#643754"
                  }).then(()=>{
                    changeHref(`single-book-component/${id}`);
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

    getPersonalRequests(){
        // console.log(account.email)
        fetch(this.url_requests + `personalRequests.php?email=${account.email}&PERS_REQUESTS`)
        .then(response=>{
            return response.json()
        })
        .then(res=>{
            if(typeof(res.eroare) != 'undefined')
                    throw new Error(res.eroare);
            console.log(res)
            personalRequests = res;
        })
        .catch(err=>{
            Swal.fire({
                icon: 'error',
                text: err,
                confirmButtonColor: "#643754"
              })
        })
    }

    administrateReq(id, new_status){
        const formData = `id=${id}&${new_status}`;
        console.log(formData)
        fetch(this.url_requests + 'administration.php?', {
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
                    throw new Error(res.eroare);
            console.log(res)
            responseData.getRequests()
        })
        .catch(err=>{
            Swal.fire({
                icon: 'error',
                text: err,
                confirmButtonColor: "#643754"
              })
        })
    }
    administrateLikes(id){
        const formData = `bookid=${id}`;
        // console.log(formData)
        fetch(this.url_likes + 'administration.php', {
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
                    throw new Error(res.eroare);
            console.log(res)
            this.seePersonalLikes()
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
    responseData.seePersonalLikes()
    responseData.getAccount()
});

function listenToLike(id){
    const new_id = id.slice(4)
    responseData.administrateLikes(new_id) 
    const buttonlike = document.getElementById(id);
    const likesNr = buttonlike.lastChild.innerHTML;
    console.log(likesNr)
    if(buttonlike.classList[2] == `btn-like-added`) {
        buttonlike.classList.remove(`btn-like-added`);
        buttonlike.classList.add(`btn-like-nope`);
        buttonlike.lastChild.innerHTML = +likesNr -1;
    }
    else if(buttonlike.classList[2] == `btn-like-nope`){
        buttonlike.classList.remove(`btn-like-nope`);
        buttonlike.classList.add(`btn-like-added`); 
        buttonlike.lastChild.innerHTML = +likesNr + 1;   
    }
    else console.log(error)
}

function likeTemplate(id){
    const liked = personalLikes.find(prop=>prop.bookid == id)
    if(typeof(liked) != 'undefined'){
        console.log(id, `la asta ai dat like!`)
        return `btn-like-added`;
    }
    else 
        return `btn-like-nope`;
}

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
                <div class="col-lg-9 col-sm-12">
                    <h2>Title:“${book.title}”</h2>
                    <h4>Author:${book.author}</h4>
                    <h4>Description:</h4>
                    <h4 class="descriptionLimited">${book.description}</h4>
                    <button class="btn-style" id="single-book-component/${book.id}" onclick="changeHref(this.id)">More</button>
                </div>
                <div class="col-lg-1 col-sm-3">
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
            <div class="col-lg-9 col-sm-12">
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
                <button id="like${selectedBook.id}" onclick="listenToLike(this.id)" class="btn-like hideOnSmall ${likeTemplate(selectedBook.id)}"><img src="./images/heart.png" alt="heart"><p>${selectedBook.likes}</p></button>
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
    let output =
    `<div class="templateMiniContainer row">
        <div class="col-lg-6 col-sm-12 text-left">
            <div class="text-center text-lg-left">
                <img class="user-photo img-fluid" src="./images//user-photo.png" alt="userphoto"><br>
            </div>
            <div class="m-3">
                <h3 class="">Name: <span class="d-block d-lg-inline">${account.name}</span></h3>
                <h3 class="">Email: <span class="d-block d-lg-inline">${account.email}</span></h3>
                <h3 class="">Address: <span class="d-block d-lg-inline">${account.address}</span></h3>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <button onclick="showPersReq()" class="btn-style float-lg-right btn-style-width">Last requests</button><br/>
            <button onclick="changePass()" class="btn-style float-lg-right btn-style-width">Change password</button><br/>
        </div>
    </div>`;
    document.getElementById('account-component').innerHTML = output;
} 

const showStatus = (prop) =>{
    if(prop == 0)
        return '<span style="color:#904e79;">pending</span>';
    else if(prop == -1)
        return 'declined';
    else if(prop == 1)
        return  'accepted';
    else
        return 'error occured';
}

const showTerm = (prop) =>{
    // console.log(prop)
    if(prop == 0)
        return 'Less than a week';
    else if(prop == 1)
        return prop + ' week';
    else
        return prop + ' weeks';
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
        responseData.getPersonalRequests()
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

async function changePass() {
    Swal.fire({
        title: 'Enter your current password',
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Submit',
        confirmButtonColor: "#643754",
        showLoaderOnConfirm: true,
        cancelButtonColor: '#904e79',
        preConfirm: (pass) => {
          console.log(pass)
          return fetch(`./php/account/checkPassRequest.php`,{
              method: 'POST',
                headers: {
                    'Content-Type':'application/x-www-form-urlencoded'
                },
                body: `CHECK_PASS=1&pass=${pass}`
            })
            .then(response => {
              return response.json()
            })
            .then(async(res)=>{
                if (typeof(res.eroare) != 'undefined') {
                    throw new Error('not match pass');
                }
                const { value: pass } = await Swal.fire({
                    title: 'Enter your new password',
                    input: 'password',
                    inputPlaceholder: 'Enter new password',
                    confirmButtonColor: "#643754"
                  })
                  if (pass) 
                      responseData.setPass(pass)
            })
            .catch(error => {
              Swal.showValidationMessage(
                `Password doesn't match.`
              )
              console.log(error)
            })
        },
      })
}

document.getElementById('requestFormSubmit').addEventListener('submit', (e)=>{
    e.preventDefault()
    const dataReq = {
        phone: document.getElementById('phone!').value,
        term: document.getElementById('term!').value,
        id: window.location.hash.slice(19)
    }
    if(dataReq.phone.length != 10 || dataReq.phone[0] != 0 || dataReq.phone[1] != 7) {
        Swal.fire({
            icon: 'error',
            text: "Phone number is not valid",
            confirmButtonColor: "#643754"
          })
    }
    else
        responseData.createRequest(dataReq.phone, dataReq.term, dataReq.id, account.email)

})

function showPersReq(){
    Swal.fire({
        text:'Requests',
        confirmButtonColor: "#643754",
        html: personalRequests.length != 0 ? (personalRequests.map(req=>{
            return `<ul class="list-group">
            <li class="list-group-item">Book: ${req.book}</li>
            <li class="list-group-item">Term: `+ showTerm(req.termen) +`</li>
            <li class="list-group-item">Status: ` + showStatus(req.status) + `</li>
            <li class="list-group-item">Date: ${req.date}</li>
          </ul>`
        }) ) : (`<h4>Here are no requests</h4>`)
        })
}