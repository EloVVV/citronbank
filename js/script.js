
const regInputs = () => {
    let input_elements = document.querySelectorAll(".profile_input_style");

    input_elements.forEach((item) => {

        item.addEventListener("keyup", () => {
            item.setAttribute("value", item.value);
        })
    });
}
regInputs();

const profileInputs = () => {
    let input_elements = document.querySelectorAll(".profile_info_inputs .profile_input_style");
    let input_edit_elements = document.querySelectorAll(".profile_edit_inputs .profile_input_style")

    input_elements.forEach((item) => {
        item.disabled = true;
    });
}
profileInputs();

const editProfile = () => {
    let parent_input_info = document.querySelector('.profile_info_inputs');
    let parent_input_edit = document.querySelector('.profile_edit_inputs');

    if(!parent_input_info || !parent_input_edit) return false;

    // let actionButton = document.querySelector('.profile_button_content');
    let editButton = document.querySelector('.profile_text-content .profile_edit_button');
    let saveButton = document.querySelector('.profile_text-content .profile_save_button');
    let backButton = document.querySelector('.profile_text-content .profile_back_button');
    
    function actionButton () {
        parent_input_edit.classList.toggle('active');
        parent_input_info.classList.toggle('no-active');
        backButton.classList.toggle('active');
        editButton.classList.toggle('no-active');
        saveButton.classList.toggle('active');
    }

    editButton.addEventListener('click', (e) => {
        e.preventDefault();
        actionButton(); 
        
    })
    backButton.addEventListener('click', (e) => {
        e.preventDefault();
        actionButton();
        
        // show("profile_edit_inputs", 300);
        // close("profile_info_inputs", 300);
    })
}

editProfile();

const getOnButton = () => {
    let selectorBox = document.querySelector('.selector_box');
    if(!selectorBox) return

    let textFormButton = document.querySelector('.input_text');
    let thirdName = document.querySelector('.third_name');

    selectorBox.onclick = () => {
        if(document.getElementById('highload1').checked) {
            thirdName.disabled = true;
            textFormButton.classList.toggle('active');
        } else {
            thirdName.disabled = false;
            textFormButton.classList.remove('.active');
        }
    };
};

getOnButton();


const getModalWindow = () => {
    let burgerMenu = document.querySelector('.burger-menu');
    let modalPopup = document.querySelector('.modal_popup');
    burgerMenu.addEventListener('click', (e) => {
        e.preventDefault();
        modalPopup.classList.toggle('active');
    })
}

getModalWindow();


// document.getElementById("profile_edit_inputs").style.opacity=0;

                    
// function show(id, speed) { 
//     let vars;
//     document.getElementById(id).classList.toggle('active');
//     var ID = setInterval(function() { 
//         (vars=Number(document.getElementById(id).style.opacity));
//         if (vars>1) {
//             clearInterval(ID);
//         }
//         vars += 0.1; document.getElementById(id).style.opacity=vars;
//     }, speed);
// }

// function close(id, speed) { 
//     let vars;
//     document.getElementById(id).classList.toggle('no-active');
//     var ID = setInterval(function() { 
//         (vars=Number(document.getElementById(id).style.opacity));
//         if (vars<1) {
//             clearInterval(ID);
//         }
//         vars -= 0.1; document.getElementById(id).style.opacity=vars;
//     }, speed);
// }

// const infoInputs = (item) => {
//     let parent = document.querySelector(item);
//     if(parent.display !== 'flex') console.log('инфы нету');
// }
// const editInputs = (item) => {
//     let parent = document.querySelector(item);
//     if(parent.display !== 'flex') console.log('ред. нет');
    
// }

// infoInputs('.profile_info_inputs');
// editInputs('.profile_edit_inputs');


// const saveProfileData = () => {
//     let parentForm = document.querySelector('.profile_text-content');
//     let saveBtn = document.querySelector('.profile_save_button');

//     saveBtn.addEventListener('click', (e) => {
//         e.preventDefault();
        
//         parentForm.insertAdjacentHTML('beforeend', `
//             require('');
//         `)
//     })
// }

// saveProfileData();

let phone_input = document.querySelector('.phone_input');

$('.phone_input').mask("+7(999)999-99-99");

let card_input = document.querySelector('.card_input');

$('.card_input').mask("9999 9999 9999 9999");


let sum_input = document.querySelector('.sum_input');
console.log(sum_input);

// $('.sum_input').mask("999999");

// $('sum_input').on("change", function() {
//     var val = Math.abs(parseInt(this.value, 10) || 1);
//     this.value = val > 25 ? 24 : val;
// });


// function handleChange(sum_input) {
//     if (sum_input.value < 0) sum_input.value = 0;
//     if (sum_input.value > 100) sum_input.value = 100;
// }


// $('body').on('input', '.sum_input', function(){
// 	var value = this.value.replace(/[^0-9]/g, ',');
// 	if (value < $(this).data('min')) {
// 		this.value = $(this).data('min');
// 	} else if (value > $(this).data('max')) {
// 		this.value = $(this).data('max');
// 	} else {
// 		this.value = value;
// 	}
// });

$('.body').on('input', '.sum_input').keypress(function(event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});


function clearMessage() {
    const message = document.querySelector('.error_message_block');
    if(!message) return;

    const link = () => {
        // return document.location.href = '?page=transaction_for_card';
        message.style.opacity = "0";
        message.style.overflow = "hidden";
        message.style.display = "absolute";
        message.style.visible = "hidden";
        message.style.top = "-100%";
    }
    setTimeout(link, 3000);
}

clearMessage();