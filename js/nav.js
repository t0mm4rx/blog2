document.querySelector("#menu-button").onclick = () => {
    document.querySelector("#content").classList.toggle("open");
    document.querySelector("#menu-button > i").classList.toggle("fa-bars");
    document.querySelector("#menu-button > i").classList.toggle("fa-times");
    document.querySelector("#menu-button").classList.toggle("rotated");
    if (document.querySelector("#content").classList.contains("open")) {
        interval = setInterval(draw, 1000 / 10);
    } else {
        clearInterval(interval);
    }
}

document.querySelector("#content").onclick = () => {
    if (document.querySelector("#content").classList.contains("open"))
        document.querySelector("#menu-button").click();
}

var canvas = document.getElementById("menu-animation");
var ctx = canvas.getContext("2d");
const speed = 1;
const blinking_time = 1000;
var time = 0;
var last = 0;
ctx.canvas.width = window.innerWidth;
ctx.canvas.height = window.innerHeight;

var interval = setInterval(draw, 1000 / 60);

var points = [];
for (let i = 0; i < 100; i++) {
    points.push({
        x: Math.random() * ctx.canvas.width,
        y: Math.random() * ctx.canvas.height,
        vx: (Math.random() - 0.5) * speed,
        vy: (Math.random() - 0.5) * speed,
        radius: Math.random() * 5
    });
}

function draw() {
    ctx.fillStyle = "#1F2833";
    ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);

    for (let point of points) {
        ctx.fillStyle = "#0B0C10";
        ctx.beginPath();
        ctx.arc(point.x, point.y, point.radius, 0, 2 * Math.PI);
        ctx.fill();

        point.x += point.vx;
        point.y += point.vy;

        if (point.x > ctx.canvas.width)
            point.x = 0
        if (point.x < 0)
            point.x = ctx.canvas.width
        if (point.y > ctx.canvas.height)
            point.y = 0
        if (point.y < 0)
            point.y = ctx.canvas.height
    }
    //let el = document.querySelector("#main-title");
    let el = document.querySelector("#blinking-thing");
    time += 1000 / 60;
    if (time > blinking_time) {
        time = 0;
        if (last == 0) {
            el.style.color = '#FFF';
            last = 1;
        } else {
            last = 0;
            el.style.color = '#1F2833';
        }
    }
}
