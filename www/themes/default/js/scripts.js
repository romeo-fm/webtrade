$(document).ready(function(){
    $("#goBack").click(function() {
        if (confirm('Все несохраненные данные будут потеряны. Вы точно хотите вернуться?')) {
            window.location = '/' + window.location.href.split("/")[3]
            //javascript:history.go(-1);
        } else {
            return false;
        }
    })

    $("#goBackNotConfirm").click(function() {
        window.location = '/' + window.location.href.split("/")[3]
    })

    $("#statusMsg, #statusUpdMsg, #statusErrMsg").click(function(){
        $(this).toggle();
    });
})
