const TRIANGLES = 15;
const SIZE = 300;

var canvas = document.getElementById("contact-animation");
var ctx2 = canvas.getContext("2d");
ctx2.canvas.width = canvas.getBoundingClientRect().width;
ctx2.canvas.height = canvas.getBoundingClientRect().height;

var is_captcha_ok = false;

var triangles = [];
for (let i = 0; i < TRIANGLES; i++)
{
    let origin = [Math.random() * ctx2.canvas.width, Math.random() * ctx2.canvas.height];
    let p2 = [Math.random() * SIZE + origin[0], Math.random() * SIZE + origin[1]];
    let p3 = [Math.random() * SIZE + origin[0], Math.random() * SIZE + origin[1]];
    let color = [69, 162, 158];
    let scale = Math.random() * 2;
    color[0] *= scale;
    color[1] *= scale;
    color[2] *= scale;
    triangles.push({
        p1: origin,
        p2: p2,
        p3: p3,
        color: color,
        p1v: []
    });
}

function draw2()
{
    ctx2.fillStyle = "#1F2833";
    ctx2.fillRect(0, 0, ctx2.canvas.width, ctx2.canvas.height);

    for (let t of triangles)
    {
        ctx2.fillStyle = "rgb(" + t.color[0] + ", " + t.color[1] + ", " + t.color[2] + ")";
        ctx2.beginPath();
        ctx2.moveTo(t.p1[0], t.p1[1]);
        ctx2.lineTo(t.p2[0], t.p2[1]);
        ctx2.lineTo(t.p3[0], t.p3[1]);
        ctx2.fill();
    }
}

setInterval(draw2, 1000 / 60);

function validate_email(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function is_form_valid()
{
    let name = document.querySelector("[name='name']").value;
    let mail = document.querySelector("[name='mail']").value;
    let message = document.querySelector("[name='message']").value;
    if (name.length < 3 || mail.length < 3 || message.length < 3)
        return false;
    if (!validate_email(mail))
        return false;
    if (!is_captcha_ok)
        return false;
    return true;
}

function check_form()
{
    if (is_form_valid())
    {
        document.querySelector("#button_wrapper > button").disabled = false;
    } else {
        document.querySelector("#button_wrapper > button").disabled = true;
    }
}

function on_recaptcha_success(data)
{
    is_captcha_ok = true;
    check_form();
}
