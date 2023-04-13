let menuCat = document.querySelector("#menu_categoria");
let container = document.querySelector(".product-wrapper");
 
selectMenu.addEventListener("change", function(){
   let categoryName = this.value;
   category.innerHTML = this[this.selectedIndex].text;  
 
   let http = new XMLHttpRequest();
   // We are going to fetch the server's response later on.
 
   http.open('POST', "script.php", true);
   http.setRequestHeader("content-type", "application/x-www-form-urlencoded");
   http.send("category="+categoryName);
});