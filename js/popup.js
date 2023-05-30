let parent = document.querySelector('.popup');

let regBtn = document.querySelector('.reg-link');
let authBtn = document.querySelector('.auth-link');
let editBtn = document.querySelector('.edit_count_box');


let regPopup = document.querySelector('.popup_reg');
let authPopup = document.querySelector('.popup_auth');
let editPopup = document.querySelector('.popup_edit');
let transactionPopup = document.querySelector('.popup_operation');
let newsPopup = document.querySelector('.popup_news');

let openTransaction = document.querySelectorAll('.statistic');
let openNews = document.querySelectorAll('.news');

console.log(openNews);

const openPopup = () => {
    if(regBtn) {
        regBtn.addEventListener('click', (e) => {
            e.preventDefault();
            regPopup.classList.toggle('active');
            closePopup(regPopup);
        })
        authBtn.addEventListener('click', (e) => {
            e.preventDefault();
            authPopup.classList.toggle('active');
            closePopup(authPopup);
        })
    }

    if(editBtn) {
        editBtn.addEventListener('click', (e) => {
            e.preventDefault();
            editPopup.classList.toggle('active');
            closePopup(editPopup);
        })
    }

    openTransaction.forEach((item) => {
        if(item) {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                // console.log(item);
                // console.log(item.getAttribute("href"));
                // document.location.href=item.getAttribute("href");
                loadOperation(item.getAttribute("transactionID"), item.getAttribute("type"), item.getAttribute("cardID"));
                transactionPopup.classList.toggle('active');
                closePopup(transactionPopup);
            })
        }
    })

    openNews.forEach((item) => {
        if(item) {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                console.log(item);
                // console.log(item);
                
                // document.location.href=item.getAttribute("href");
                loadNews(item.getAttribute("newsID"));
                newsPopup.classList.toggle('active');
                closePopup(newsPopup);
            })
        }
    })
    
}

openPopup();

function loadOperation(itemID, type, cardID) { //просто какая-нибудь функция 
    $.ajax({
        url: `../actions/getOperationModal.php/?id=${itemID}&type=${type}&idCard=${cardID}`,
        // файл, к которому обращается скрипт 
        success: function (data) {
            $('.popup_operation .popup_container').html(data);
        } //Здесь в блок с классом (или может быть ид) вставляется то, что ответил сервер, то есть получается загрузка контента без перезагрузки. 
    })
}

function loadNews(itemID) { //просто какая-нибудь функция 
   
    $.ajax({
        url: `../actions/getNewsModal.php/?id=${itemID}`,
        // файл, к которому обращается скрипт 
        success: function (data) {
            $('.popup_news .popup_container').html(data);
        } //Здесь в блок с классом (или может быть ид) вставляется то, что ответил сервер, то есть получается загрузка контента без перезагрузки. 
    })
}

const closePopup = (parent) => {
    let areaBox = document.querySelectorAll('.popup_area');
    let closeBtn = document.querySelectorAll('.close-icon-box');
    
    areaBox.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            parent.classList.remove('active');
        })
    })
   
   
    closeBtn.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            parent.classList.remove('active');
        })
    })
}






const editCount = () => {
    const formLog2 = document.querySelector('.popup_edit .popup_content');
    if(!formLog2) return false;
    const inputsLog = formLog2.querySelectorAll('.popup_edit input');
    const buttonLog = formLog2.querySelector('.popup_edit .form_button');
    const errorLog = document.querySelector('.popup_edit .error-log');
    const idProduct = document.querySelector('.cart_products .product').getAttribute('data');
    let isSentLog = false;

    const sendFormData2 = () => {
        const logFormData = new FormData();
    
        inputsLog.forEach(input => {
            logFormData.append(input.name, input.value);
            logFormData.append('id_cart', idProduct);
        })
    
        return logFormData;
    }
    
    async function sendServer2(url) {
        const responseLogServ = await fetch(url, {
            method: 'POST',
            body: sendFormData2()
        });
        const dataLog = await responseLogServ.json();
        return dataLog;
    }
    
    formLog2.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (isSentLog) return
        isSentLog = true;
        buttonLog.textContent = 'Отправка...'
        const responseLog = await sendServer2('actions/edit_count_product.php');
    
        if (responseLog.type === 'error') {
            errorLog.textContent = responseLog.body;
            errorLog.classList.add('active');
        } else {
            if (responseLog.type === 'success') {
    
                errorLog.textContent = responseLog.body
    
                errorLog.classList.add('active');
                errorLog.classList.add('success');
    
                inputsLog.forEach(el => {
                    el.value = "";
                })
    
                // labelLog.forEach(el => {
                //     el.classList.remove('active');
                // })
    
    
                const link = () => {
                    return document.location.href = '?page=profile';
                }
                setTimeout(link, 3000);
            }
        }
        isSentLog = false;
        buttonLog.textContent = 'Отправить';
    })
}

editCount();