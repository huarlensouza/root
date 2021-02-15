function changeColor() {
    let price = document.getElementsByClassName('preco');
    if(price[0].style.backgroundColor != 'red'){
    for(var i = 0; i < price.length; i++){
        price[i].style.backgroundColor = "red";
        price[i].style.color = "white";
    } 
} else{
    for(var i = 0; i < price.length; i++){
        price[i].style.backgroundColor = "";
        price[i].style.color = "";
    } 
}
}

let change = setInterval(changeColor, 10000);