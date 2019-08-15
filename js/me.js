const TYPING_MIN = 60;
const TYPING_MAX = 250;

const words = [
    "passionné",
    "créatif",
    "ambitieux",
    "moteur",
    "concepteur",
    "rigoureux",
    "fou?"
];
var current = 0;

function type(el, text, callback)
{
    let a = 0;
    let index = 0;
    for (let i = 0; i < text.length; i++)
    {
        setTimeout(function () {
            el.innerText += text[index++];
        }, a);
        a += (Math.random() * TYPING_MAX) + TYPING_MIN;
    }
    setTimeout(callback, a);
}

function type_clear(el, callback)
{
    let a = 0;
    for (let i = 0; i < el.innerText.length; i++)
    {
        setTimeout(function () {
            el.innerText = el.innerText.substring(0, el.innerText.length - 1);
        }, a);
        a += (Math.random() * TYPING_MAX) + TYPING_MIN;
    }
    setTimeout(callback, a);
}

function next()
{
    type(document.querySelector("#completion-box"), words[current], function () {
        setTimeout(function () {
            type_clear(document.querySelector("#completion-box"), function () {
                setTimeout(function ()  {
                    current++;
                    if (current >= words.length)
                        current = 0;
                    next();
                }, 500);
            });
        }, 2000);
    });
}

document.querySelector("#completion-box").innerText = "";
next();


var commands = [
    "listknowledges",
    "AI, Web, Photoshop, Sketch, MySQL",
    "listexperience",
    "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "whoami",
    "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "whoami",
    "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
];
const WAIT_AFTER_COMMAND = 4000;
var terminal_triggered = false;

function animate_terminal(id)
{
    animate_command(id, 0);
}

function animate_command(id, index)
{
    let el = document.getElementById(id);
    let p = el.querySelector(".terminal-text > p");
    let new_line = document.createElement("span");
    new_line.className = "terminal-text-typing";
    new_line.innerText = "~/> ";
    p.append(new_line);
    document.getElementById(id).querySelector(".terminal-text").scrollTop = document.getElementById(id).querySelector(".terminal-text").scrollHeight;
    typing_animation(new_line, commands[index], () => {
        let result = document.createElement("span");
        result.className = "terminal-text-command";
        result.innerText += commands[index + 1];
        result.innerText += "\n";
        document.getElementById(id).querySelector(".terminal-text > p").append(result);
        document.getElementById(id).querySelector(".terminal-text").scrollTop = document.getElementById(id).querySelector(".terminal-text").scrollHeight;
        setTimeout(() => {
            if (index + 2 < commands.length)
                animate_command(id, index + 2);
        }, WAIT_AFTER_COMMAND);
    });
}

function typing_animation(el, text, callback)
{
    let a = 0;
    text += "\n";
    for (let i = 0; i < text.length; i++)
    {
        a += Math.floor(Math.random() * TYPING_MAX) + TYPING_MIN;
        setTimeout(() => {
            el.innerText += text[i];
        }, a);
    }
    setTimeout(callback, a);
}

document.querySelector("#content").addEventListener('scroll', function(e) {
    let scroll = document.querySelector("#content").scrollTop;
    if (document.querySelector("#terminal").getBoundingClientRect().top + 100 < window.innerHeight && !terminal_triggered)
    {
        terminal_triggered = true;
        animate_terminal("terminal");
    }
}, false);
document.querySelector("#content").dispatchEvent(new CustomEvent('scroll'));

var canvas_anim = document.getElementById("title-animation");
var ctx2 = canvas_anim.getContext("2d");
ctx2.canvas.width = canvas_anim.getBoundingClientRect().width;
ctx2.canvas.height = canvas_anim.getBoundingClientRect().height;

var pts = [];
for (let i = 0; i < 20; i++)
{
    let connections = [];
    for (let j = 0; j < 20; j++)
    {
        if (Math.random() > .8)
            connections.push(j);
    }
    pts.push({
        x: Math.random() * ctx2.canvas.width,
        y: Math.random() * ctx2.canvas.height,
        vx: (Math.random() - .5),
        vy: (Math.random() - .5),
        connections: connections
    });
}

function draw2() {
    ctx2.fillStyle = "#0B0C10";
    ctx2.fillRect(0, 0, ctx2.canvas.width, ctx2.canvas.height);
    for (let pt of pts)
    {
        for (let con of pt.connections)
        {
            ctx2.strokeStyle = "#2f3a49";
            ctx2.beginPath();
            ctx2.moveTo(pt.x, pt.y);
            ctx2.lineTo(pts[con].x, pts[con].y);
            ctx2.stroke();
        }

        ctx2.fillStyle = "#c1c1c1";
        ctx2.beginPath();
        ctx2.arc(pt.x, pt.y, 5, 0, 2 * Math.PI);
        ctx2.fill();

        pt.x += pt.vx;
        pt.y += pt.vy;
        if (pt.x > ctx2.canvas.width || pt.x < 0)
            pt.vx *= -1;
        if (pt.y > ctx2.canvas.height || pt.y < 0)
            pt.vy *= -1;
    }
}

setInterval(draw2, 1000 / 25);
