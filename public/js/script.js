let openPeminjaman = document.querySelector(".peminjaman");
let closePeminjaman = document.querySelector(".closePeminjaman");
let childListPeminjaman = document.querySelector(".childlistPeminjaman");
let container = document.querySelector(".container");
let total = document.querySelector(".total");
let quantity = document.querySelector(".quantity");
let katalog = document.querySelectorAll(".katalog");
let listPeminjaman = document.querySelector("listPeminjaman");
let peminjamanbtn = document.getElementById("peminjaman-btn");
openPeminjaman.addEventListener('click',()=>{
    container.classList.add('active');
});
closePeminjaman.addEventListener('click',()=>{
    container.classList.remove('active');
});
peminjamanbtn.addEventListener('click',function(){
    listPeminjaman.classList.add('active');
});
let listPems = [];

function addToList(key){
    if (katalog[key] == null ) {
        katalog[key].quantity = 1;
    }
    reloadList();
}
function reloadList(){
    childListPeminjaman.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    katalog.forEach((value,key)=>{
      
    });
}