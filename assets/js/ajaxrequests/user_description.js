    // Ajax Request To find Contact Desctiption When a user is clicked 

    function user_description(l) {
        url="private/find_contact_description.php?idt="+l;
        let xhr= new XMLHttpRequest();
        xhr.open("GET",url,true);
        xhr.onreadystatechange= function (){ 
        if(xhr.readyState== 4 && xhr.status== 200){
            let result=xhr.responseText;
            let target=document.querySelector(".section_contact_desc");
            target.innerHTML=result;
        }
        }
    xhr.send();
    }


        // Ajax Request To find Contact Desctiption When a user is clicked 
        function group_description(l) {
            url="private/find_group_description.php?idt="+l;
            let xhr= new XMLHttpRequest();
            xhr.open("GET",url,true);
            xhr.onreadystatechange= function (){ 
            if(xhr.readyState== 4 && xhr.status== 200){
                let result=xhr.responseText;
                let target=document.querySelector(".section_contact_desc");
                target.innerHTML=result;
            }
            }
        xhr.send();
        }