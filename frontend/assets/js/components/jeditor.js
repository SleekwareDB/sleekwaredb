const $ = require('jquery')
const JSONEditor = require('jsoneditor');

const jeditor = {
    init: function () {
        const collectionEditor = document.getElementById('collectionEditor');
        if (collectionEditor) {
            const options = {
                mode: 'form',
                name: "jsonContent",
                onEvent: function (node, event) {
                    if (node.value !== undefined && event.type === 'blur') {
                        console.log(event.type + ' value ' + node.value)
                    }
                }
            }
            const editor = new JSONEditor(collectionEditor, options)

            $(document).on('click', '#setJSON', function () {
                const json = {
                    "array": [1, 2, [3, 4, 5]],
                    "boolean": true,
                    "htmlcode": '&quot;',
                    "escaped_unicode": '\\u20b9',
                    "unicode": '\u20b9,\uD83D\uDCA9',
                    "return": '\n',
                    "null": null,
                    "number": 123,
                    "object": { "a": "b", "c": "d", "e": [1, 2, 3] },
                    "string": "Hello World",
                    "url": "http://jsoneditoronline.org",
                    "[0]": "zero"
                }
                editor.set(json)
            })

            $(document).on('click', '#saveJSON', function () {
                const json = editor.get()
                console.log(json)
            })

            setInterval(function () {
                $('#autosave').removeClass().addClass('badge badge-success').html("Data saved")
                setTimeout(function () {
                    $('#autosave').removeClass().addClass('badge badge-danger').html("Data not saved")
                }, 2000)
                console.log(editor.get())
            }, 10000);
        }
    }
}

module.exports = jeditor
