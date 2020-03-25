document.getElementById('recoverySubmit').addEventListener('submit', (e)=>{
    e.preventDefault()
    const email = document.getElementById('emailRecovery').value;
    console.log(email)
})