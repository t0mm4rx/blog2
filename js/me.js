const TYPING_MIN = 60;
const TYPING_MAX = 250;

const words = [
    "passionné",
    "créatif",
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

next();
