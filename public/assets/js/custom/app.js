function onElementFocus(e) {
    e.parentElement.classList.contains("input-group") && e.parentElement.classList.add("focused")
    e.parentElement.classList.contains("input-group") && e.parentElement.classList.add("is-focused")
    e.getAttribute('data-placeholder') && e.setAttribute('placeholder', e.getAttribute('data-placeholder'));
}

function onElementDeFocused(e) {
    e.parentElement.classList.contains("input-group") && e.parentElement.classList.remove("focused")
    e.parentElement.classList.contains("input-group") && e.parentElement.classList.remove("is-focused")
    e.getAttribute('placeholder') && e.removeAttribute('placeholder');
}
