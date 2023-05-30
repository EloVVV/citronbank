function formStart() {
    const formLog = document.querySelector('.feedback_form');
    if (!formLog) return false;
    const inputsLog = formLog.querySelectorAll('.feedback_input');
    const buttonLog = formLog.querySelector('.button-form');
    const errorLog = document.querySelector('.error-log');

    let isSentLog = false;

    const sendFormData = () => {
        const logFormData = new FormData();

        inputsLog.forEach(input => {
            logFormData.append(input.name, input.value);
        })

        return logFormData;
    }

    async function sendServer(url) {
        const responseLogServ = await fetch(url, {
            method: 'POST',
            body: sendFormData()
        });
        const dataLog = await responseLogServ.json();
        return dataLog;
    }

    formLog.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (isSentLog) return
        isSentLog = true;
        buttonLog.textContent = 'Отправка...'
        const responseLog = await sendServer('actions/send_feedback.php');

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

                const link = () => {
                    return document.location.href = '?';
                }
                setTimeout(link, 3000);
            }
        }
        isSentLog = false;
        buttonLog.textContent = 'Отправить';
    })
}

formStart();