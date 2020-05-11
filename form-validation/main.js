let attempts = 0;

document.querySelector('form').addEventListener('submit',e => {
    if (attempts > 0) {
        document.querySelectorAll('.error').forEach(element => {
            element.remove();
        });
        document.querySelectorAll('.errorHighlight').forEach(element => {
            element.classList.remove('errorHighlight');
        });
    }

    if (requiredCheck()) {
        e.preventDefault();
    }

    if (maxCharLength8Check()) {
        e.preventDefault();
    }

    if (charLength10to25Check()) {
        e.preventDefault();
    }

    if (lettersCheck()) {
        e.preventDefault();
    }

    if (emailCheck()) {
        e.preventDefault()
    }

    attempts++;
});

function requiredCheck() {
    const cy = document.querySelector('#radioCheckYes');
    const cn = document.querySelector('#radioCheckNo');
    const rc = document.querySelector("#requiredCheck");
    let check = false;

    if (cy.checked) {
        rc.classList.add("required");
    } else if (cn.checked) {
        const rClass = ["required", "errorHighlight"];
        rc.classList.remove(...rClass);
    }
    const r = document.querySelectorAll('.required');

    r.forEach((input) => {
        if (input.value === "") {
            check = true;
            highlightError(input, 'This field is required');

        }
    });

    return check;
}

function maxCharLength8Check() {
    let check = false;

    document.querySelectorAll('.char8').forEach((input) => {
        if (input.value.length > 8) {
            check = true;
            highlightError(input, 'Only a maximum of 8 characters please');
        }
    });

    return check;
}

function charLength10to25Check() {
    let check = false;

    document.querySelectorAll('.char1025').forEach((input) => {
        if ((input.value.length > 25) || (input.value.length < 10) && (input.value !== '')) {
            check = true;
            highlightError(input, 'Must have between 10 and 25 characters');
        }
    });

    return check;
}

function lettersCheck() {
    const letters=/^[A-Za-z ]+$/;
    let check = false;

    document.querySelectorAll('.lettOnly').forEach((input) => {
        if  ((!input.value.match(letters)) && (input.value !== '')) {
            check = true;
            highlightError(input, 'Must only contain letters');
        }

    });

    return check;
}

function emailCheck() {
    const validEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const e = document.querySelector('#email');
    let check = false;

    if ((!validEmail.test(e.value)) && (e.value !== '')) {
        check = true;
        highlightError(e, 'Please enter a valid e-mail');
    }

    return check;
}


function highlightError(selectedElement, errorMsg){
    selectedElement.classList.add("errorHighlight");
    selectedElement.insertAdjacentHTML( 'afterend',`<p class="error">${errorMsg}</p>`);
}
