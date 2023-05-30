let select = function () {
    // let parent_input = document.querySelector('.select__current');
    let selectHeader = document.querySelectorAll('.select__header');
    let selectItem = document.querySelectorAll('.select__item');

    selectHeader.forEach(item => {
        item.addEventListener('click', selectToggle)
    });

    selectItem.forEach(item => {
        item.addEventListener('click', selectChoose)
    });

    function selectToggle() {
        this.parentElement.classList.toggle('is-active');
    }

    function selectChoose() {
        let text = this.innerText,
            select = this.closest('.select'),
            image = '';
            currentText = select.querySelectorAll('.select__current'),
            currentImage = select.querySelector('.current__image'),
            inputText = select.querySelector('.select__current-input'),
            valueID = this.getAttribute('value');

        if(select.querySelector('.card_image')) {
            image = select.querySelector('.card_image').getAttribute("src");
        }
        
        currentText.forEach((item) => {
            item.innerText = text;
            item.removeAttribute('value');
            item.setAttribute('value', text);
            item.style.color = '#000';
        })

        // currentImage.src(image);
        if(image !== '')  $(currentImage).attr("src", image);
        // console.log(image);
        // console.log(image);

        // inputText.removeAttribute('value');
        if(inputText) inputText.setAttribute('value', valueID);
        select.classList.remove('is-active');

    }

};


select();