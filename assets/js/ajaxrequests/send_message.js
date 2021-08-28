var button = document.querySelector(".send_message");
                    // SweetAlert Error To be Displayed When Chat is not found
                    function displayErrors(errors) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            showCloseButton: true,
                            showConfirmButton: false,
                            
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                            })
                            Toast.fire({
                            icon: 'error',
                            title: 'Unknown Chat Id'
                            })
                    }

                    function sendmessage() {
                    var form = document.querySelector("#sendMessageForm");
                    var action = form.getAttribute("action");
                    // gather form data
                    var form_data = new FormData(form);
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', action, true);
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.onreadystatechange = function () {
                        if(xhr.readyState == 4 && xhr.status == 200) {
                        var result = xhr.responseText;
                            console.log('Result: ' + result);
                        var json = JSON.parse(result);
                        if(json.hasOwnProperty('Errors') && json.Errors.length > 0) {
                            displayErrors(json.Errors);
                        } else{ 
                            // Clean The Text Message 
                            document.querySelector(".textmessage").value="";
                            scrollToBottom();
                            }
                        }
                    };
                    xhr.send(form_data);
                    }

                    button.addEventListener("click", function(event) {
                    event.preventDefault();
                    sendmessage();
                    });
                        