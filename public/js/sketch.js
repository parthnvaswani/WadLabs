let symmetry = 6;
let angle = 360 / symmetry;
let saveButton;
let clearButton;
let filename;
let slider;
let xoff = 0;

function setup() {
  filename = createInput()
    .attribute("placeholder", "enter file name")
    .attribute("style", "position:absolute;top:28%;left:0;");
  saveButton = createButton("save").attribute(
    "style",
    "position:absolute;top:31%;left:0;"
  );
  saveButton.mousePressed(saveSnowflake);
  clearButton = createButton("clear canvas").attribute(
    "style",
    "position:absolute;top:20%;left:0;"
  );
  clearButton.mousePressed(clearCanvas);
  createP("Width");
  slider = createSlider(1, 32, 4, 0.1).attribute(
    "style",
    "position:absolute;top:15%;left:0;"
  );
  createCanvas(800, 800).attribute(
    "style",
    "position:absolute;top:10%;left:15%;height:800px;width:800px;"
  );
  angleMode(DEGREES);
  background(127);
}

function saveSnowflake() {
  let name = filename.value();
  if (name == "") {
    alert("enter a file name first before saving!!!");
  } else {
    save(name + ".png");
  }
}

function clearCanvas() {
  background(127);
}

function draw() {
  translate(width / 2, height / 2);

  if (mouseX > 0 && mouseX < width && mouseY > 0 && mouseY < height) {
    let mx = mouseX - width / 2;
    let my = mouseY - height / 2;
    let pmx = pmouseX - width / 2;
    let pmy = pmouseY - height / 2;

    if (mouseIsPressed) {
      let hu = map(sin(xoff), -1, 1, 0, 255);
      xoff += 1;
      stroke(hu, 100);
      let angle = 360 / symmetry;
      for (let i = 0; i < symmetry; i++) {
        rotate(angle);
        let sw = slider.value();
        strokeWeight(sw);
        line(mx, my, pmx, pmy);
        push();
        scale(1, -1);
        line(mx, my, pmx, pmy);
        pop();
      }
    }
  }
}
