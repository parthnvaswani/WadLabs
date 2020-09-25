let current = [],
  previous = [],
  damping = 0.99;

function setup() {
  pixelDensity(1);
  createCanvas(500, 500);
  current = new Array(width).fill(0).map((n) => new Array(height).fill(0));
  previous = new Array(width).fill(0).map((n) => new Array(height).fill(0));
}

function mouseDragged() {
  previous[mouseX][mouseY] = 500;
}

function draw() {
  background(0);
  loadPixels();
  for (x = 1; x < width - 1; x++) {
    for (y = 1; y < height - 1; y++) {
      current[x][y] =
        (previous[x - 1][y] +
          previous[x + 1][y] +
          previous[x][y - 1] +
          previous[x][y + 1]) /
          2 -
        current[x][y];
      current[x][y] *= damping;
      let index = (x + y * width) * 4;
      pixels[index + 0] = pixels[index + 1] = pixels[index + 2] = current[x][y];
    }
  }

  updatePixels();
  let arr = previous;
  previous = current;
  current = arr;
}
