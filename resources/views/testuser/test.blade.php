<!doctype html><html><head></head><body>

<h2>Fix for Chrome Removing File when 'cancel' clicked</h2>

Upload Image: <input id="imageUpload" type="file" onclick="fileClicked(event)" onchange="fileChanged(event)">
<br/><br/>
<label for="videoUpload">Upload Video:</label> <input id="videoUpload" type="file" onclick="fileClicked(event)" onchange="fileChanged(event)">
<br/><br/>
<div id="log"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    //This is All Just For Logging:
    var debug = true;//true: add debug logs when cloning
    var evenMoreListeners = true;//demonstrat re-attaching javascript Event Listeners (Inline Event Listeners don't need to be re-attached)
    if (evenMoreListeners) {
        var allFleChoosers = $("input[type='file']");
        addEventListenersTo(allFleChoosers);
        function addEventListenersTo(fileChooser) {
            fileChooser.change(function (event) { console.log("file( #" + event.target.id + " ) : " + event.target.value.split("\\").pop()) });
            fileChooser.click(function (event) { console.log("open( #" + event.target.id + " )") });
        }
    }
    (function () {
        var old = console.log;
        var logger = document.getElementById('log');
        console.log = function () {
            for (var i = 0; i < arguments.length; i++) {
                if (typeof arguments[i] == 'object') {
                    logger.innerHTML += (JSON && JSON.stringify ? JSON.stringify(arguments[i], undefined, 2) : arguments[i]) + '<br />';
                } else {
                    logger.innerHTML += arguments[i] + '<br />';
                }
            }
            old.apply(console, arguments);
        }
    })();

    var clone = {};

    // FileClicked()
    function fileClicked(event) {
        var fileElement = event.target;
        if (fileElement.value != "") {
            if (debug) { console.log("Clone( #" + fileElement.id + " ) : " + fileElement.value.split("\\").pop()) }
            clone[fileElement.id] = $(fileElement).clone(); //'Saving Clone'
        }
        //What ever else you want to do when File Chooser Clicked
    }

    // FileChanged()
    function fileChanged(event) {
        var fileElement = event.target;
        if (fileElement.value == "") {
            if (debug) { console.log("Restore( #" + fileElement.id + " ) : " + clone[fileElement.id].val().split("\\").pop()) }
            clone[fileElement.id].insertBefore(fileElement); //'Restoring Clone'
            $(fileElement).remove(); //'Removing Original'
            if (evenMoreListeners) { addEventListenersTo(clone[fileElement.id]) }//If Needed Re-attach additional Event Listeners
        }
        //What ever else you want to do when File Chooser Changed
    }
</script>
</body></html>
