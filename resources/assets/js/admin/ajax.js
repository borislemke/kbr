var aurl = baseUrl + '/system/ajax/';

var Ajax = {

    post: function(method, ajaxIn, doneFunc) {

        Ajax.base(method, ajaxIn, doneFunc, 'POST');
    },

    destroy: function(targetUrl, token, doneFunc) {

        NProgress.start();

        $.ajax({

            url: aurl + targetUrl,

            type: 'POST',

            dataType: 'json',

            data: token,

            async: true,

            error: function(xhr, status, message){

            if(development) consoleLog(xhr.responseText);

        }}).done(function(data) {

            doneFunc(data);
        });
    },

    get: function(targetUrl, doneFunc, doneParam) {

        NProgress.start();

        return $.ajax({

            url: aurl + targetUrl,

            type: 'GET',

            dataType: 'json',

            async: true,

            error: function(xhr, status, message){

            if(development) consoleLog(xhr.responseText);

        }}).done(function(data) {

            if(development) consoleLog(data);

            if(!!data.monolog) Monolog.notify(data.monolog.title, data.monolog.message);

            if(!!doneParam) {

                doneFunc(doneParam);

                return true;
            }

            doneFunc(data);
        });
    },

    base: function(targetUrl, dataIn, doneFunc, ajaxType) {

        NProgress.start();

        $.ajax({

            url: targetUrl,

            type: ajaxType,

            data: dataIn,

            processData: false,  // tell jQuery not to process the data. IMPORTANT for file upload.

            contentType: false,   // tell jQuery not to set contentType. IMPORTANT for file upload.

            dataType: 'json',

            async: true,

            error: function(xhr, status, message){

            consoleLog(xhr.responseText);

        }}).done(function(data) {

            if(development) consoleLog(data);

            switch(data.status) {

                case 200:

                    Monolog.notify(data.monolog.title, data.monolog.message);

                    doneFunc(data);

                    break;

                default:

                    Monolog.notify(data.monolog.title, data.monolog.message);

                    consoleLog(data);
            }
        });
    }
}
