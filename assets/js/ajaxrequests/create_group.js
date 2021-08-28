
                var creategrp = document.querySelector("#create_grp");
                function disablecreatebutton() {
                creategrp.disabled = true;
                creategrp.style.backgroundColor = "grey";
                
                creategrp.value = 'Authenticationg...';
                }
                function enableSubmitButton() {
                    creategrp.disabled = false;
                    creategrp.style.backgroundColor = "rgb(250, 50, 50 )";
                    creategrp.value = 'Update...';
                    creategrp.classList.remove("avoidclicks");
                }

                function displayErrors(errors) {
                    const ul = document.createElement('ul');
                   
                    for (var i = 0; i < errors.length; i++) {
                        let li = document.createElement("li");
                        li.append(errors[i]);
                        ul.appendChild(li);
                    }
                  
                    const Toast = Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error Creating Group',
                    html: ul,
                    showConfirmButton: false,
                    timerProgressBar:true,
                    timer: 2500
                    
                    })
                }
                function created_successfully() {
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
                        title: 'Group Created Successfully'
                        }).then(function() {
                            window.location = "chat.php";
                        });
                    
                }

                function creategroup() {
                disablecreatebutton();
                var form = document.querySelector("#create_group");
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
                        displayErrors(json.Errors);
                        enableSubmitButton();
                        
                    } else{
                            enableSubmitButton();     
                            created_successfully()
                        }
                    }
                };
                xhr.send(form_data);
                }

                    creategrp.addEventListener("click", function(event) {
                    event.preventDefault();
                    creategroup();
                    });

function changetheme() {
        var form = document.querySelector("#change_theme_form");
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
                displayErrors(json.Errors);
                enableSubmitButton();
                
            } else{
                    enableSubmitButton();     
                    created_successfully()
                }
            }
        };
        xhr.send(form_data);
        }

            creategrp.addEventListener("click", function(event) {
            event.preventDefault();
            creategroup();
 });
        