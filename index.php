<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="Header.css">

</head>
<body>     
    <?php include 'header.php'; ?>

    <div id="blur">
        <div class="registeration-container">
            <div class="header">Registration Form</div>
            <form  id="form" class="form" method="POST" enctype="multipart/form-data">
                <div class="input-container">
                    <div class="form-group">
                        <label for="full-name">Full Name <span>*</span></label><br>
                        <input type="text" id="full-name" name="full-name" placeholder="Enter Full Name">
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="user-name">Username <span>*</span></label><br>
                        <input type="text" id="user-name" name="user-name" placeholder="Enter Username">
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone-num">Phone Number <span>*</span></label><br>
                        <input type="tel" id="phone-num" name="phone-num" placeholder="Enter Phone Number">
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password <span>*</span></label><br>
                        <input type="password" id="password" name="password" placeholder="Enter Password">
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password <span>*</span></label><br>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email <span>*</span></label><br>
                        <input type="text" id="email" name="email" placeholder="Enter Email">
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address <span>*</span></label><br>
                        <input type="text" id="address" name="address" placeholder="Enter Address">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Birthdate <span>*</span></label><br>
                        <div class="birth-date">
                            <input type="date" id="birthdate" name="birthdate" placeholder="Enter Birthdate">
                            <button type="button" class="api-check" onclick="toggle()" >Check</button>
                            <div class="error"></div>
                        </div>
                    </div>                

                    <div class="form-group image">
                        <label for="image-upload">Upload Profile Photo <span>*</span></label><br>
                        <input type="file" id="image-upload" name="image-upload" style = " border: none;" accept="image/jpeg, image/png, image/jpg">
                        <div class="error" style="margin-left: 15px;"></div>
                    </div>

                </div>     
                <div class="submit">
                    <input type="submit" value="Register">
                </div>

            </form>
        </div>
    </div>
    <div class="popup-container">
        <div class="close-btn" onclick="toggle()">&times;</div>
        <h1>Actors With the Same Age as You</h1>
        <div class="popup-text">
        </div>
    </div>


    <?php include 'footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="form.js"></script>
    <script>
        
        function toggle() {
           document.getElementById("blur").classList.toggle("active")
           document.querySelector(".popup-container").classList.toggle("popup-container-show")
        }

        window.addEventListener('scroll', function () {
            let header = document.querySelector('nav');
            let windowPosition = window.scrollY > 0;
            header.classList.toggle('scrolled-nav', windowPosition);
        })
    </script>

  

</body>
</html>
