
const form = document.getElementById('form')
const fullname = document.getElementById('full-name')
const username = document.getElementById('user-name')
const phonenum = document.getElementById('phone-num')
const password = document.getElementById('password')
const password2 = document.getElementById('confirm-password')
const email = document.getElementById('email')
const address = document.getElementById('address')
const birthdate = document.getElementById('birthdate')
const image = document.getElementById('image-upload')



// client side validation part

form.addEventListener('submit', e => {
    e.preventDefault()

    if(validateInputs()){
        // call an ajax function to send data to php
    }
});



const setError = (element, message) => {
    const parent = element.parentElement;
    const errorDisplay = parent.querySelector('.error');

    errorDisplay.innerText = message;
    parent.classList.add('error');
    parent.classList.remove('success')
}

const setSuccess = element => {
    const parent = element.parentElement;
    const errorDisplay = parent.querySelector('.error');

    errorDisplay.innerText = '';
    parent.classList.add('success');
    parent.classList.remove('error');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const isValidPassword = password =>{
    const re = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/
    return re.test(password)
}

//checks when submit
const validateInputs = () => {
    const fullnameValue = fullname.value.trim()
    const usernameValue = username.value.trim()
    const phonenumValue = phonenum.value
    const emailValue = email.value.trim()
    const passwordValue = password.value
    const password2Value = password2.value
    const addressValue = address.value.trim()
    const birthdateValue = birthdate.value
    const imageValue = image.value

    if(fullnameValue ===''){
        setError(fullname, 'Fullname is required')
    }else{
        setSuccess(fullname)
    }


    if(usernameValue === '') {
        setError(username, 'Username is required')
    }else {
        setSuccess(username)
    }


    if(phonenumValue ===''){
        setError(phonenum,"Phone Number is required")
    }


    if(passwordValue === '') {
        setError(password, 'Password is required')
    } else if (!isValidPassword(passwordValue)) {
        setError(password, 'Password must be at least 8 characters long\nand include at least one number and one special character')       
    } else {
        setSuccess(password)
        if (password2Value !== passwordValue) {
            setError(password2, "Passwords doesn't match")
        }else{
            setSuccess(password2)
        }
    }


    if(password2Value === '') {
        setError(password2, 'Please confirm your password')
    }


    if(emailValue === '') {
        setError(email, 'Email is required')
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address')
    } else {
        setSuccess(email)
    }
    

    if(addressValue === ''){
        setError(address, 'Address is required')
    }else{
        setSuccess(address)
    }


    if(birthdateValue === '') {
        setError(birthdate.parentElement, 'Birthdate is required')
    } else {
        setSuccess(birthdate.parentElement)
    }


    if(imageValue === ''){
        setError(image, 'Profile Photo is Required')
        image.style.color = '#0d2fb5'
    }else{
        setSuccess(image)
        image.style.color = '#09c372'
    }

};

//only allows numbers in the phone input, enforces 11 digit length, and formats it into 000-0000-0000 pattern
phonenum.addEventListener('input', e =>{
    let input = phonenum.value.replace(/\D/g, '')

    if (!/^[0-9-]+$/.test(phonenum.value)) {
        phonenum.value = phonenum.value.slice(0, -1)
        setError(phonenum, 'Please Enter a Number')
    }
    
    if (input.length != 11) {
        input = input.slice(0, 11);
        setError(phonenum, 'Phone Number must be 11 digit Number')
    }

    
    let formatted = ''
        for (let i = 0; i < input.length; i++) {
            if (i === 3 || i === 7) {
                formatted += '-'
            }
            formatted += input[i]
            }
        phonenum.value = formatted
    
    if(input.length == 11){
        setSuccess(phonenum)
    }
})



