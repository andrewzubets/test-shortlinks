import './bootstrap';

async function copyToClipboard(textToCopy, onSuccess, onFail) {
    // Navigator clipboard api needs a secure context (https)
    if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(textToCopy)
            .then(onSuccess)
            .catch(onFail);
    } else {
        // Use the 'out of viewport hidden text area' trick
        const textArea = document.createElement("textarea");
        textArea.value = textToCopy;

        // Move textarea out of the viewport so it's not visible
        textArea.style.position = "absolute";
        textArea.style.left = "-999999px";

        document.body.prepend(textArea);
        textArea.select();

        try {
            document.execCommand('copy');
            onSuccess();
        } catch (error) {
            console.error(error);
            onFail();
        } finally {
            textArea.remove();
        }
    }
}

let copyUrlOutputBtn = document.getElementById('copyUrlOutputBtn');
if(copyUrlOutputBtn !== null) {
    function showInfoAlert(text, alertType) {
        let copyInfoAlert = document.getElementById('copyInfoAlert');
        copyInfoAlert.text = text;
        copyInfoAlert.className = 'alert alert-' + alertType;

        setTimeout(function () {
            copyInfoAlert.className = 'd-none';
        }, 6000);
    }
    copyUrlOutputBtn.onclick = function () {
        let text = document.getElementById('urlOutput').value;

        copyToClipboard(text, function () {
            showInfoAlert( 'Скопировано в буфер обмена!', 'success');
        },
        function () {
            showInfoAlert( 'Не удалось скопировать в буфер обмена!', 'danger');
        });
    };
}
