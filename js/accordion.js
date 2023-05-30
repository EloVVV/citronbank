function getAccordion () {
    let openLink = document.querySelector('.user_profile_box');
    if(!openLink) return false;

    openLink.addEventListener('click', (e) => {
        e.preventDefault();
        let parent = document.querySelectorAll('.profile_menu');
        parent.forEach(item => {
            item.classList.toggle('active');
        })
       
    });
}

getAccordion();


function getAccordionModal () {
    let openLink = document.querySelector('.modal_popup .user_profile_box');
    if(!openLink) return false;

    openLink.addEventListener('click', (e) => {
        e.preventDefault();
        let parent = document.querySelectorAll('.profile_menu_modal');
        parent.forEach(item => {
            item.classList.toggle('active');
        })
       
    });
}

getAccordionModal();