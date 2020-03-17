// LOGIN SUBMIT FORM
document.getElementById('loginForm').addEventListener('submit', (e)=>{
    e.preventDefault()
    const href = window.location.href;
    const words = href.split('#');
    console.log(words[1])
})
