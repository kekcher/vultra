const description = document.getElementById("description");
description.onclick = () =>{
    const signBox = document.getElementById('description_sign');
    description.classList.toggle('triangle_down');
    signBox.classList.toggle('sign_active');
};

const instruction = document.getElementById("instruction");
instruction.onclick = () =>{
    const signBox = document.getElementById('instruction_sign');
    instruction.classList.toggle('triangle_down');
    signBox.classList.toggle('sign_active');
}

const countBtn = document.getElementById('add_count');
countBtn.onclick = ()=>{
    document.getElementById('count_table').value = document.getElementById('count_table').value >= 50 ? 50 : document.getElementById('count_table').value;
    document.getElementById('add_table').action='handlers/SQLihandlers/SQLiFillHandler.php'
}

const atBtn = document.getElementById('atack_btn');
const defBtn = document.getElementById('defense_btn');
const logForm = document.getElementById('pass_form');
const regBox = logForm.querySelector('div');
const addRevBtn = document.getElementById('add_pass');

atBtn.onclick = (e) =>{       
    logForm.className = e.target.classList.contains('btn_active') ? 'none_active' : '';
    defBtn.className = '';
    regBox.className ='regular_container none_active';
    e.target.classList.toggle('btn_active');
}

defBtn.onclick = (e) =>{    
    logForm.className = e.target.classList.contains('btn_active') ? 'none_active' : '';
    atBtn.className = '';
    e.target.classList.toggle('btn_active');
    regBox.classList.toggle('none_active');
}

addRevBtn.onclick = ()=>{    
    let regular = document.getElementById('regular').value === '' ? /[#$%^&*()+\=\[\]{};':"\\|<>\/]+/ : new RegExp(document.getElementById('regular').value);
    let regNick = /^[a-zA-Z||а-яА-я0-9_.]{1,20}$/;        
    if(document.getElementById('login').value === '' || document.getElementById('pass').value === ''){
        return;
    }
    else{
        if(defBtn.classList.contains('btn_active')){
            if(document.getElementById('regular').value === ''){                
                if(!regular.test(document.getElementById('pass').value) && regNick.test(document.getElementById('login').value)){
                    logForm.action = 'handlers/SQLiHandlers/SQLiSendDataHandler.php';
                }
                else{
                    document.getElementById('regular').value = '';
                    document.getElementById('pass').value = '';
                    document.getElementById('login').value = '';
                    alert('Защита сработала! Логин всегда под защитой!');
                }
            }
            else{                
                if(regular.test(document.getElementById('pass').value) && regNick.test(document.getElementById('login').value)){
                    logForm.action = 'handlers/SQLiHandlers/SQLiSendDataHandler.php';
                }
                else{
                    document.getElementById('regular').value = '';
                    document.getElementById('pass').value = '';
                    document.getElementById('login').value = '';
                    alert('Защита сработала! Логин всегда под защитой!');
                }
            }
        }
        else{
            if(regNick.test(document.getElementById('login').value)){
                logForm.action = 'handlers/SQLiHandlers/SQLiSendDataHandler.php';
            }
            else{
                alert('Логин всегда под защитой!');
            }
        }
    }
}