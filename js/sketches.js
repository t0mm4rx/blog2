var modal = document.querySelector("#modal");
var iframe = modal.querySelector("iframe");

function open_modal(url)
{
    modal.classList.add("open");
    iframe.src = url;
}

function close_modal()
{
    modal.classList.remove("open");
}

function refresh_modal()
{
    iframe.src = iframe.src;
}
