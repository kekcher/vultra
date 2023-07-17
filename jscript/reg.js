const btn = document.querySelector("button");

const error = (input) =>{
    input.classList.add('error_input');
    input.value = '';
    input.placeholder = 'Ошибка';
}

btn.onclick = ()=>{
    const inputs = document.querySelectorAll("input");
    let reg;
    let logic = true;
    inputs.forEach((input)=>{
        switch(input.id){
            case 'name':
                reg = /^[А-Яа-я\-]+$/;
                if(!reg.test(input.value)||input.value === ''){
                    logic = false;
                    error(input);
                }
                break;
            case 'surname':
                reg = /^[А-Яа-я\-]+$/;
                if(!reg.test(input.value)||input.value === ''){
                    logic = false;
                    error(input);
                }
                break;
            case 'phone':
                reg = /(?:\+|\d)[\d\-\(\) ]{9,}\d/g;
                if(!reg.test(input.value)||input.value === ''){
                    logic = false;
                    error(input);
                }
                break;
            case 'login':
                reg = /^[a-zA-Z0-9_.]{1,20}$/;
                if(!reg.test(input.value)||input.value === ''){
                    logic = false;
                    error(input);
                }
                break;
            case 'pass':                
                reg = /^[a-zA-Z0-9_.]{1,20}$/;
                if(!reg.test(input.value)||input.value === ''){
                    logic = false;
                    error(input);
                }
                break;
            default:
                return;
        }
    })
    if(logic){        
        document.forms[0].onsubmit = () => {
            document.forms[0].action = 'handlers/MainFormHandlers/regHandler.php';                    
        }        
    }
}
const inputs = document.querySelectorAll('input');

inputs.forEach((input)=>{
    input.onfocus = (e) =>{
        e.target.classList.remove('error_input');
    }
})
