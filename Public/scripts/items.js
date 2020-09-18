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
  <img class="card-img-top" src="${e["image"]}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">${e["name"]}</h5>
    <p class="card-text">${e["price"]}</p>
    <a href="#" class="btn btn-primary" onclick="add('${e["image"]}','${e["name"]}',${e["price"]})">Add to cart</a>
  </div>
</div>`;
  });
  itemsPane.innerHTML = html;
}

function add(img, name, price) {
  let cartPane = document.querySelector(".cart .pane");
  cartPane.innerHTML += `<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="${img}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">${name}</h5>
    <p class="card-text">${price}</p>
    <a href="#" class="btn btn-primary" onclick="remove(event)">Add to cart</a>
  </div>
</div>`;
}
function remove(e) {
  e.target.parentElement.parentElement.remove();
}
function checkout() {
  let itemPrices = 0;
  document.querySelectorAll(".cart .pane .card-text").forEach((e) => {
    itemPrices += +e.textContent;
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
