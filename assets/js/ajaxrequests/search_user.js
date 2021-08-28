    searchBar = document.querySelector(".seachform #form1")
    searchBar.onkeyup = ()=>{
        searchTerm=searchBar.value
        if(searchTerm != ""){
            searchBar.classList.add("active");
        }else{
            searchBar.classList.remove("active");
        }
        if(searchBar.value!=""){
            url = "private/search_contact.php?searchTerm="+searchBar.value;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        let result=xhr.responseText;
        let target=document.querySelector(".contacts_list");
        target.innerHTML=result;
    
    }
    }
xhr.send(); 
        }
}