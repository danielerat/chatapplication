       // Ajac Script To Update User in the Database
       var update = document.querySelector("#signin");
       function disableSubmitButton() {
       update.disabled = true;
       update.style.backgroundColor = "grey";
       update.value = 'Authenticationg...';
       }
       function enableSubmitButton() {
           update.disabled = false;
           update.style.backgroundColor = "rgb(250, 50, 50 )";
           update.value = 'Update..';
           update.classList.remove("avoidclicks");
       }

       function displayEditErrors(errors) {
           const ul = document.createElement('ul');
          
           for (var i = 0; i < errors.length; i++) {
               let li = document.createElement("li");
               li.append(errors[i]);
               ul.appendChild(li);
           }
         
           const Toast = Swal.fire({
           position: 'top-end',
           icon: 'error',
           title: 'Error Updating Profile',
           html: ul,
           showConfirmButton: false,
           timerProgressBar:true,
           timer: 2500
           
           })
       }
       function successupdate() {
           const Toast = Swal.mixin({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 1000,
               timerProgressBar: true,
               didOpen: (toast) => {
                   toast.addEventListener('mouseenter', Swal.stopTimer)
                   toast.addEventListener('mouseleave', Swal.resumeTimer)
               }
            })
               Toast.fire({
               icon: 'success',
               title: 'User Updated Successfully'
               }).then(function() {
                   window.location = "chat.php";
               });
       }

       


       function update_admin() {
       disableSubmitButton();
       var form = document.querySelector("#update_form");
       var action = form.getAttribute("action");
       // gather form data
       var form_data = new FormData(form);
       var xhr = new XMLHttpRequest();
       xhr.open('POST', action, true);
       xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
       xhr.onreadystatechange = function () {
           if(xhr.readyState == 4 && xhr.status == 200) {
           var result = xhr.responseText;
               console.log("Here Are The result Down");
               console.log('Result: ' + result);
           var json = JSON.parse(result);
           if(json.hasOwnProperty('Errors') && json.Errors.length > 0) {
               displayEditErrors(json.Errors);
               enableSubmitButton();
               
           } else{
                   enableSubmitButton();     
                   successupdate();
               }
           }
       };
       xhr.send(form_data);
       }

           update.addEventListener("click", function(event) {
           event.preventDefault();
           update_admin();
           });