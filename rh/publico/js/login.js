var formSignin = document.querySelector('#signin')
var formSignup = document.querySelector('#signup')
var btnColor = document.querySelector('.btnColor')
const modal = document.querySelector('dialog')
const btnConfirm = document.querySelector('#confirm')


document.querySelector('#btnSignin')
  .addEventListener('click', () => {
    formSignin.style.left = "25px"
    formSignup.style.left = "450px"
    btnColor.style.left = "0px"
    btnSignin.style.color = "white"
    btnSignup.style.color = "black"
    btnSignup.style.outline = "none"
    document.querySelector('.container').style.height = "400px"

    
})

document.querySelector('#btnSignup')
  .addEventListener('click', () => {
    formSignin.style.left = "-450px"
    formSignup.style.left = "25px"
    btnColor.style.left = "121px"
    btnSignup.style.color = "white"
    btnSignin.style.color = "black"
    btnSignin.style.outline = "none"
    document.querySelector('.container').style.height = "1000px"
})