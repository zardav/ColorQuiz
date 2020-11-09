function randHex() {
  let s = (Math.random() * 256 * 256 * 256).toString(16);
  s = "00000" + s;
  s = s.substring(s.length - 6);
  return s;
}

function createColorsPair() {
  let color1 = randHex();
  let color2 = randHex();
  return [color1, color2];
}
/*
 * generate amount pairs of colors and return array of pairs
 */
function createColorsArray(seed, amount) {
  return Array.from({ length: amount }, createColorsPair);
}
