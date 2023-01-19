/* canvas.addEventListener('click', function() { }, false); */
//stackoverflow.com/questions/9880279/how-do-i-add-a-simple-onclick-event-handler-to-a-canvas-element

window.onload = function(){
    let canvas = document.getElementById('favoritirepris');
    var ctx = canvas.getContext('2d');
    var w = window.innerWidth;
    var h = window.innerHeight;
    canvas.width = w;
    canvas.height = h;
    var mp = 45;
    var particles = [];

    for(var i = 0; i < mp; i++){
        particles.push({
            x: Math.random()*w,
            y: Math.random()*h,
            r: Math.random()*4+1,
            d: Math.random()*mp
        })
    }

    function draw(){
        ctx.clearRect(0, 0, w, h);
        ctx.fillStyle = "white";
        ctx.beginPath();
        for(var i = 0; i < mp; i++){
            var p = particles[i];
            ctx.moveTo(p.x, p.y);
            ctx.arc(p.x, p.y, p.r, 0, Math.PI*2, true);
        }
        ctx.fill();
        update();
    }
var angle = 0;

//snowflakes move
function update(){
    angle += 0.01;
    for(var i = 0; i < mp; i++){
        var p = particles[i];
        p.y += Math.cos(angle+p.d) + 1 + p.r/2;
        p.x += Math.sin(angle) *2;
        if(p.x > w+5 || p.x < -5 || p.y > h){
            if(i%3 > 0){
                particles[i] = {x: Math.random() * w, y: -10, r: p.r, d: p.d}
            }else{
                if(Math.sin(angle) > 0){
                    particles[i] = {x: -5, y: Math.random()*w, y: -10, r: p.r, d: p.d}
                }else{
                    particles[i] = {x: w+5, y: Math.random()*h, r: p.r, d: p.d}
                }
            }
        }
    }
}
setInterval(draw, 33);
}