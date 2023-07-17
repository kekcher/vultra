const description = document.getElementById("description");
description.onclick = () => {
    const signBox = document.getElementById('description_sign');
    description.classList.toggle('triangle_down');
    signBox.classList.toggle('sign_active');
};

const instruction = document.getElementById("instruction");
instruction.onclick = () => {
    const signBox = document.getElementById('instruction_sign');
    instruction.classList.toggle('triangle_down');
    signBox.classList.toggle('sign_active');
}

const countBtn = document.getElementById('add_count');
countBtn.onclick = () => {
    document.getElementById('count_table').value = document.getElementById('count_table').value >= 100 ? 100 : document.getElementById('count_table').value;
    document.getElementById('add_table').action = 'handlers/ACEHandlers/ACEFillHandler.php'    
}

const atBtn = document.getElementById('atack_btn');
const defBtn = document.getElementById('defense_btn');
const fileForm = document.getElementById('file_form');

const defType = document.getElementById('def_type');
const defSize = document.getElementById('def_size');
const textType = document.getElementById("type");
const textSize = document.getElementById("size");

atBtn.onclick = (e) => {
    fileForm.className = e.target.classList.contains('btn_active') ? 'none_active' : '';
    defBtn.className = '';
    e.target.classList.toggle('btn_active');
    defType.className = 'regular_container none_active';
    defSize.className = 'regular_container none_active';
    textType.value = '';
    textSize.value = '';
}

defBtn.onclick = (e) => {
    fileForm.className = e.target.classList.contains('btn_active') ? 'none_active' : '';
    atBtn.className = '';
    e.target.classList.toggle('btn_active');
    defType.classList.toggle('none_active');
    defSize.classList.toggle('none_active');
}

const inputFile = document.getElementById('fileupload');

inputFile.onchange = (e) => {
    document.getElementById('filename').textContent = e.target.files[0].name
}

const loadBtn = document.getElementById('load');

loadBtn.onclick = () =>{
    if (defBtn.classList.contains('btn_active')){
        const regType = /^[a-zA-Z0-9_.]/;
        const regSize = /^\d+$/;
        if(textType.value === '' || textSize.value === ''){
            alert("Поля не должны быть пустыми!");
        }
        else{
            if(regType.test(textType.value) && regSize.test(textSize.value)){
                fileForm.action = 'handlers/ACEHandlers/ACESendDataHandler.php';
            }
            else{
                alert('Поля защищены!!!');
            }
        }
    }
    else{
        fileForm.action = 'handlers/ACEHandlers/ACESendDataHandler.php';
    }
}