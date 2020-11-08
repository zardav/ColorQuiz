const mod = (x,y) => ((x%y)+y)%y;

function rand(upTo) {
    return Math.floor(Math.random()*upTo);
}
function randBetween(a,b) {
    return rand(a+b+1) - a;
}
function randRgb() {
    return [rand(256), rand(256), rand(256)];
}
function dist(x,y,z) {
    return x*x + y*y + z*z;
}

function nearColor(c, maxDist) {
    let r,g,b, d;
    const randLevel = l => randBetween(Math.max(l-maxDist, 0), Math.min(l+maxDist, 255));
    do{
        r = randLevel(c[0]);
        g = randLevel(c[1]);
        b = randLevel(c[2]);
        d = dist(r-c[0], g-c[1], b-c[2]);
    } while (d > maxDist*maxDist);
    return [r,g,b];
}

function genQ2(maxDist) {
    let color = randRgb();
    let c1 = nearColor(color, maxDist);
    let c2 = nearColor(color, maxDist);
    return [color, c1, c2];
}

function genQ2Arr(maxDist, amount) {
    var result = [];
    for(let i = 0; i < amount; i++) {
        result.push(genQ2(maxDist));
    }
    return result;
}