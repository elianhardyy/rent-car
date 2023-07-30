@extends('layouts.layoutclient')

@section('title', 'Katalog')

@section('content')

    <div class ="row">
        <div class ="col-12 col-sm-100">

        </div>

        <div class ="col-12 col-sm-6">
            <div class="input-group mb-3">
                <input >
            </div>
        </div>
    </div>

    
<div class="my-5 container active">
    <form action="" method="get">
    <div class ="row">
        <div class ="col-24 col-sm-5">
            <select name="category" id="category" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <div class ="col-24 col-sm-5">
            <div class="input-group mb-3">
                <input type="text" name="nama_mobil" class="form-control" placeholder="Search nama mobil">
                
            </div>
        </div>
        <div class ="col-24 col-sm-2"> <div class="input-group mb-3"><button class="btn btn-primary" type="submit">Search</button></div></div>
    </div>
    
</form>
    <div class="row katalog">
        @foreach ($katalog as $item)
        <div class="col-lg-4 col-md-5 col-sm-6 mb-3 katalog-card">
            <div class="card">
                <img class="card-img" src="{{asset('storage/cover/'.$item->cover)}}"
                draggable="false" width="200px" height="200px" id="card-img-id">
                <div class="card-body">
                    <p class="card-mobil-id" hidden>{{ $item->id }}</p>
                    <p  class="card-user-id" hidden>{{ auth()->user()->id }}</p>
                    <h5 class="card-title">{{$item->nama_mobil}}</h5>
                    <p class="card-text">Nopol: {{$item->nopol}}</p>
                    <span class="fw-bold">Harga Sewa : Rp</span><span class="card-price fw-bold currency">{{$item->harga}}</span><span>/ Hari</span>
                    <p class="card-status text-end fw-bold {{ $item->status == 'Tersedia' ? 'text-success' 
                        : 'text-danger'}}"> {{$item->status}} </p>
                    <a href="/sewa?mobil={{ $item->slug }}" class="{{ $item->status == 'Tersedia' ? 'btn btn-primary' : 'btn btn-primary disabled' }} center">Sewa Mobil</a>
                    <button type="button" class="btn btn-secondary add-cart">Tambah</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
</div>
<div class="listPeminjaman">
    <form action="/rent-add-multi" method="post">
    @csrf
    <div class="cart-rent">
    @foreach ($katalog as $k )
                
                
    @endforeach
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>                    
        <br>
        <div class="cart">
            <div class="total">0</div>
            <div class="closePeminjaman"><i class="fa-solid fa-xmark"></i></div>
        </div>
    </div>
<script>
    var numFormat = new Intl.NumberFormat("id-ID",{style:"currency",currency:"IDR"});
    
//Variable
var openPeminjaman = document.querySelector(".peminjaman");
var closePeminjaman = document.querySelector(".closePeminjaman");
var childListPeminjaman = document.querySelector(".childlistPeminjaman");
var container = document.querySelector(".container");
var total = document.getElementsByClassName("total")[0].innerHTML;
var quantity = document.querySelector(".quantity");
var katalog = document.querySelectorAll(".katalog");
var cartContent = document.getElementsByClassName('cart-content');
var listPeminjaman = document.querySelector(".listPeminjaman");
var addCart = document.getElementsByClassName("add-cart");
var peminjamanbtn = document.getElementById("peminjaman-btn");

var cartPrice = document.getElementsByClassName("cart-price")[0];

var cartCloseBtn = document.getElementsByClassName("cart-close-btn");

var totalCount = 0;

totalCount = total + cartPrice;
total = totalCount;
//close cart
closePeminjaman.addEventListener('click',()=>{
    listPeminjaman.classList.remove('active');
    container.classList.remove('active');
});
//open cart
peminjamanbtn.addEventListener('click',function(){
    listPeminjaman.classList.add('active');
    container.classList.add('active')
});
//remove item
for (var i = 0; i < cartCloseBtn.length; i++) {
    var btnclose = cartCloseBtn[i];
    btnclose.addEventListener("click",removeItem);  
}
var quantity = document.getElementsByClassName("quantity")
for (let i = 0; i < quantity.length; i++) {
    var element = quantity[i];
    element.addEventListener("change",quantityChange);  
} 
for (let i = 0; i < addCart.length; i++) {
    var addCartElement = addCart[i];
    addCartElement.addEventListener("click",addCartClicked);
}
//change
function quantityChange(event){
    var quantityElement = event.target;
    if(isNaN(quantityElement.value)||quantityElement.value <= 0){
        quantityElement.value = 1
    }
    updatetotal();
}
function removeItem(event){
    var removeItemBtn = event.target;
    //console.log("remove");
    removeItemBtn.parentElement.remove();
    updatetotal();
}
var pmjQuantity = document.getElementsByClassName("pmj-quantity")[0];
for (let i = 0; i < cartContent.length; i++) {
    const element = cartContent[i];
    
}
//update total
function updatetotal(){
    var cartRent = document.getElementsByClassName('cart-rent')[0];
    var cartContent = document.getElementsByClassName('cart-content'); 
//     document.getElementsByClassName("minus-btn")[0].addEventListener("click",()=>{
// console.log("minus btn from update total")
//     });
    var total = 0;
    for (let i = 0; i < cartContent.length; i++) {
        var cartContentItem = cartContent[i]; //each object content
        var priceElement = cartContentItem.getElementsByClassName("cart-price")[0];
        var quantityElement = cartContentItem.getElementsByClassName("quantity")[0];
        var price = parseFloat(priceElement.innerHTML.replace("Rp",""));
        //console.log(cartContent.length);
        pmjQuantity.innerHTML = cartContent.length;
        if(cartContent.length == 0 && cartContent.length < 1){
            document.getElementsByClassName("pmj-quantity")[0].style.display = "none";
        }
        var quantity = quantityElement.value;
        total = total + (price * quantity);
        // var minusBtn = cartContentItem.getElementsByClassName("minus-btn")[0];
        // minusBtn.addEventListener("click",quantityBtnMinus(i));
        document.getElementsByClassName("total")[0].innerHTML = numFormat.format(total);
        
        //priceElement.nextElementSibling
    }
}

function addCartClicked(event){
    var addCartBtn = event.target;
    var products = addCartBtn.parentElement;
    var cardTitle = products.getElementsByClassName('card-title')[0].innerText;
    var cardText = products.getElementsByClassName("card-text")[0].innerText;
    var cardPrice = products.getElementsByClassName("card-price")[0].innerText;
    var cardMobilId = products.getElementsByClassName("card-mobil-id")[0].innerText;
    var cardUserId = products.getElementsByClassName("card-user-id")[0].innerText;
    //numFormat.format()
    //var mobilid
    //var authuserid
    //var cardImg = products.querySelectorAll(".card-img")[0].src;
    document.getElementsByClassName("pmj-quantity")[0].style.display = "flex";

    addToCart(cardTitle,cardText,cardPrice,cardMobilId,cardUserId);
    updatetotal();
}
function addToCart(title,text,price,mobil,user){
    var cartRentContent = document.createElement('div');
    cartRentContent.classList.add('cart-content');
    var cartRentMain = document.getElementsByClassName("cart-rent")[0];
    var cartItemTitle = document.getElementsByClassName("cart-title");
    var res = 0;
    for (let i = 0; i < cartItemTitle.length; i++) {
        if(cartItemTitle[i].innerText == title){
            alert("Item sudah dipilih");
            return;
        }
    }
    var createCartContent = `
                <img src="/" alt="po" class="img-katalog" width="50px" height="50px" class="cart-img">
                <div class="cart-detail">
                    <p class="cart-title">${title}</p>
                    <p class="cart-text">${text}</p>
                   <input type="hidden" value="${mobil}" name="mobil_id[]">
                   <input type="hidden"  value="${user}" name="user_id[]">
                    <div class="cart-nominal">
                        <button class="minus-btn" hidden><i class="fa-solid fa-minus"></i></button>
                        <input type="hidden" name="" id="" class="quantity" value="1">
                        <button class="plus-btn" hidden><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <div class="cart-detail-price">
                    <p class="cart-price">${price}</p>
                </div>
                </br>
                <div class="cart-close-btn">X</div>
        `;
    cartRentContent.innerHTML = createCartContent;
    cartRentMain.append(cartRentContent);
    cartRentContent.getElementsByClassName('cart-close-btn')[0].addEventListener("click",removeItem);
    cartRentContent.getElementsByClassName('quantity')[0].addEventListener("change",quantityChange);

    //cartRentContent.getElementsByClassName('cart-price')[0].innerText.replace("Rp","");
    // cartRentContent.getElementsByClassName('minus-btn')[0].addEventListener("click",()=>{
    //     console.log("minus");
    //     var minus = cartRentContent.getElementsByClassName("quantity")[0].value;
    //     minus = minus - 1

    // })
    
}

//error
//gambar
//id
</script>
@endsection