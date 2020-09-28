let cart = {};

function enable(e, tab, tab2) {
  document.querySelector(`.${tab}`).style.display = "block";
  document.querySelector(`.${tab2}`).style.display = "none";
}
window.onload = () => {
  load();
};
async function load() {
  let res = await fetch("../index.php?act=getItems");
  let json = await res.json();
  let itemsPane = document.querySelector(".items .pane");
  let html = "";
  json.forEach((e) => {
    html += `<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="${e["image"]}" onclick="zoomImg(event)">
  <div class="card-body">
    <h5 class="card-title">${e["name"]}</h5>
    <p class="card-text">INR <span>${e["price"]}</span></p>
    <input type="number" value=0 /><br/><br/>
    <a href="#" class="btn btn-primary" onclick="add(event,'${e["image"]}','${e["name"]}',${e["price"]},${e["id"]})">Add to cart</a>
  </div>
</div>`;
  });
  itemsPane.innerHTML = html;
}
function add(e, img, name, price, id) {
  if (cart[id]) {
    alert("this item is already in cart");
    return;
  }
  let units = parseInt(e.target.parentElement.querySelector("input").value);
  if (units <= 0) {
    alert("add more than 0 items!");
    return;
  }
  cart[id] = true;
  let cartPane = document.querySelector(".cart .pane");
  cartPane.innerHTML += `<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="${img}" onclick="zoomImg(event)">
  <div class="card-body">
    <h5 class="card-title">${name}</h5>
    <p class="card-text">INR <span>${price}</span></p>
    <input type="number" value=${units} /><br/><br/>
    <a href="#" class="btn btn-primary" onclick="remove(event,${id})">Remove</a>
  </div>
</div>`;
  alert("item added");
}
function remove(e, id) {
  delete cart[id];
  e.target.parentElement.parentElement.remove();
}
function checkout() {
  let itemPrices = 0;
  document.querySelectorAll(".cart .pane .card-text span").forEach((e) => {
    let units = parseInt(
      e.parentElement.parentElement.querySelector("input").value
    );
    itemPrices += parseInt(e.textContent) * units;
  });
  document.querySelector(".checkoutamt").innerText = itemPrices;
}

function save() {
  if (document.querySelector(".checkoutamt").innerText == 0) {
    alert("no item in cart");
    return;
  }
  if (document.querySelector("#address").value == "") {
    alert("address required");
    return;
  }
  document.querySelector(".cart .pane").innerHTML = "";
  let amt = document.querySelector(".checkoutamt").innerText;
  let address = document.querySelector("#address").value;
  document.querySelector(".checkoutamt").innerText = "0";
  document.querySelector("#address").value = "";
  saveOrder(amt, address);
}
async function saveOrder(amt, address) {
  let res = await fetch(
    "../index.php?act=saveOrder&amt=" + amt + "&address=" + address
  );
  alert("order successful");
}

function zoomImg(e) {
  let clone = e.target.cloneNode();
  clone.classList.remove("card-img-top");

  let lb = document.getElementById("lb-img");
  lb.innerHTML = "";
  lb.appendChild(clone);

  lb = document.getElementById("lb-back");
  lb.classList.add("show");
}

window.addEventListener("load", function () {
  document.getElementById("lb-back").addEventListener("click", function () {
    this.classList.remove("show");
  });
});
