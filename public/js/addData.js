async function addData(e) {
  e.preventDefault();
  let data = {
    name: document.querySelector("#name").value,
    email: document.querySelector("#email").value,
    address: document.querySelector("#address").value,
    age: document.querySelector("#age").value,
  };
  let res = await fetch("api/addData", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  });
  let json = await res.json();
  if (json.response === 1) {
    alert("insertion successful");
  } else {
    alert("insertion unsuccessful");
  }
}
