
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


$(form).submit(function(e) {
            

    e.preventDefault(); 
    
    var formData = new FormData(form)
    for(var pair of formData.entries()){
        console.log(pair[0] + ': ' + pair[1])

    }

    if (!validateInputs()) {
        return; 
    }

    $.ajax({
        url: 'FormEdit.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            if( response.success){
                setSuccess(username);
                form.reset();
                setNeutral();
                alert(response.message);
                uploadImage(formData);
            }else{
                setError(username,"Username already Exists");
            }
        },
        error: function() {
            alert("An error occurred while processing your request.");
        }
    });

    

});

function uploadImage(formData) {
    $.ajax({
        url: 'Upload.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            if(response.success) {
                alert("Image: [" + response.queryString + "] Uploaded Successfully");
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert("An error occurred while processing your request.");
        }
    });
}


$(".api-check").click(function() {

    var date = document.getElementById("birthdate");
    var selectedDate = new Date(date.value);
    var day = selectedDate.getDate();
    var month = selectedDate.getMonth() + 1;

    $.ajax({
        url: "API_Ops.php",
        type: "POST",
        dataType: "json",
        data:{
            month: month,
            day: day
        },
        success: function(response) {
            var actorNamesHtml = "";
  
            for (var i = 0; i < response.length; i += 4) {

              var group = response.slice(i, i + 4);
              actorNamesHtml += "<p>" + group.join(" - ") + "</p>";

            }
          
            $(".popup-text").html(actorNamesHtml);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Status: " + textStatus);
            console.log("Error: " + errorThrown);
            console.log("Response Text: " + jqXHR.responseText)
        }
      });

    });


// form.addEventListener('submit', e => {
    
//     var xhr = new XMLHttpRequest();
//     if(!validateInputs()){
//         e.preventDefault();
        
//     }else{
//         xhr.open("POST", "FormEdit.php", true); 
//     }
// });



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

function setNeutral(){
    $('.form-group').removeClass('success');
    image.style.color = 'light-dark(rgb(118, 118, 118), rgb(133, 133, 133))'
}

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const isValidPassword = password =>{
    const re = /^(?=.*[0-9])(?=.*[!@#$%^&*_])[a-zA-Z0-9!@#$%^&*_]{8,}$/
    return re.test(password)
}

//checks when submit
const validateInputs = () => {
    var check = true
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
        check = false
    }else{
        setSuccess(fullname)
    }


    if(usernameValue === '') {
        setError(username, 'Username is required')
        check = false;
    }else {
        setSuccess(username)
    }


    if(phonenumValue ===''){
        setError(phonenum,"Phone Number is required")
        check = false;
    }


    if(passwordValue === '') {
        setError(password, 'Password is required')
        check = false;
    } else if (!isValidPassword(passwordValue)) {
        setError(password, 'Password must be at least 8 characters long\nand include at least one number and one special character')      
        check = false; 
    } else {
        setSuccess(password)
        if (password2Value !== passwordValue) {
            setError(password2, "Passwords doesn't match")
            check = false;
        }else{
            setSuccess(password2)
        }
    }


    if(password2Value === '') {
        setError(password2, 'Please confirm your password')
        check = false;
    }


    if(emailValue === '') {
        setError(email, 'Email is required')
        check = false;
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address')
        check = false;
    } else {
        setSuccess(email)
    }
    

    if(addressValue === ''){
        setError(address, 'Address is required')
        check = false;
    }else{
        setSuccess(address)
    }


    if(birthdateValue === '') {
        setError(birthdate.parentElement, 'Birthdate is required')
        check = false;
    } else {
        setSuccess(birthdate.parentElement)
    }


    if(imageValue === ''){
        setError(image, 'Profile Photo is Required')
        check = false;
        image.style.color = '#0d2fb5'
    }else{
        setSuccess(image)
        image.style.color = '#09c372'
    }

    return check



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



