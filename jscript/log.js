const btn = document.querySelector("button");

const error = (input) => {
    input.classList.add('error_input');
    input.value = '';
    input.placeholder = 'Ошибка';
}

btn.onclick = () => {    
    const inputs = document.querySelectorAll("input");
    let reg;
    let logic = true;
    inputs.forEach((input) => {        
        switch (input.id) {
            case 'login':
                console.log(111);
                reg = /^[a-zA-Z0-9_.]{1,20}$/;
                if (!reg.test(input.value) || input.value === '') {
                    logic = false;
                    error(input);
                }
                break;
            case 'pass':                
                reg = /^[a-zA-Z0-9_.]{1,20}$/;
                if (!reg.test(input.value) || input.value === '') {
                    logic = false;
                    error(input);
                }
                break;
            default:
                return;
        }
    })
    if (logic) {
        document.getElementById('log_form').onsubmit = () => {
            document.getElementById('log_form').action = 'handlers/MainFormHandlers/loginHandler.php';
        }
        
    }
}

const inputs = document.querySelectorAll('input');

inputs.forEach((input) => {
    input.onfocus = (e) => {
        e.target.classList.remove('error_input');
    }
})