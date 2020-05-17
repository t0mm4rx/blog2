var modal = document.querySelector("#modal");
var iframe = modal.querySelector("iframe");

function open_modal(url)
{
    const modalSize = document.querySelector("#modal").getBoundingClientRect();
    modal.classList.add("open");
    iframe.src = url + `#${modalSize.width}x${modalSize.height}`;
}

function close_modal()
{
    modal.classList.remove("open");
}

function refresh_modal()
{
    iframe.src = iframe.src;
}
