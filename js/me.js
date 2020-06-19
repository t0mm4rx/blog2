const TYPING_MIN = 100;
const TYPING_MAX = 250;

const words = [
    "passionné",
    "créatif",
    "ambitieux",
    "ingénieux",
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
    "whoami",
    "Je suis né à Lyon en 2001, j'ai toujours été passionné par les nouvelles technologies et l'informatique. Je suis aussi très curieux et j'adore apprendre donc je m'intéresse à beaucoup de choses. J'aime mélanger technique et art. Je suis étudiant à l'école 42 de Paris.",
    "ps -A",
    "En plus de l'informatique, je suis passionné par le basket. J'en pratique en compétition depuis plus de 10 ans. Je fais également de la musique électronique.",
    "skill",
    "Web, PHP, Python, Machine Learning, Java, C, Ionic, Jeux vidéos, Unity, LibGDX, p5.js, MySQL, Linux, Photoshop, Sketch, Adobe XD",
    "ls * studies/",
    "BAC mention bien<br />MOOC AI Standford (2 mois)<br />*Student à 42 Paris<br />MOOC deeplearning.ai (4 mois)<br />MOOC Machine Learning for Trading (3 mois)<br /><br />*En cours"

];
const WAIT_AFTER_COMMAND = 4000;
var terminal_triggered = false;

function animate_terminal(id)
{
    setTimeout(function () {
        animate_command(id, 0);
    }, 1000);
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
        let result = document.createElement("p");
        result.className = "terminal-text-command";
        result.innerHTML += commands[index + 1];
        result.innerHTML += "\n";
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
            el.innerHTML += text[i];
        }, a);
    }
    setTimeout(callback, a);
}

document.querySelector("#content").addEventListener('scroll', function(e) {
    let scroll = document.querySelector("#content").scrollTop;
    if (document.querySelector("#terminal").getBoundingClientRect().top + 600 < window.innerHeight && !terminal_triggered)
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
