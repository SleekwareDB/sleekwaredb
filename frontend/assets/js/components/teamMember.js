const { default: axios } = require('axios')
const $ = require('jquery')
const JSONEditor = require('jsoneditor')
const { base_url, autoSaveIndicator, make_alert } = require('../helpers/app');

$.noConflict()
(function ($) {

    async function setEditorData(data) {
        const options = {
            mode: 'tree',
            name: "jsonContent",
            templates: [
                {
                    text: 'Password',
                    title: 'Insert Password',
                    field: 'password',
                    className: 'jsoneditor-type-password',
                },
                {
                    text: 'Address',
                    title: 'Insert a Address Node',
                    field: 'AddressTemplate',
                    value: {
                        'street': '',
                        'city': '',
                        'state': '',
                        'ZIP code': ''
                    }
                }
            ],
            onCreateMenu: function (items, node) {
                let path = node.path
                items.forEach(function (item, index, items) {
                    if (items[index].text == "Remove") {
                        let originalRemoveClick = items[index].click;
                        items[index].click = () => {
                            console.log('Do something BEFORE the original remove click method ', path);
                            originalRemoveClick();
                            console.log('Do something AFTER the original remove click method', path);
                        };
                    }
                })
                return items
            },
            onEvent: function(node, event) {
                if (node.value !== undefined && event.type === 'focus') {
                    if (node.field == 'password') {
                        console.log(event.type + ' value ' + node.value)
                    }
                }
            },
            onChangeJSON: async function (json) {
                try {
                    var request = await axios.post(base_url('ajax/teams/update'), json, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    })
                    if (request.data.status) {
                        autoSaveIndicator()
                    }
                } catch (error) {
                    console.log(error)
                }
            },
            onEditable: function (node) {
                switch (node.field) {
                    case '_id':
                        return false
                    case 'uuid':
                        return false
                    case 'role':
                        return false
                    case 'createdAt':
                        return false
                    case 'updatedAt':
                        return false
                    case 'deletedAt':
                        return false
                    default:
                        return true
                }
            }
        }
        let collectionEditor = document.getElementById('memberEditor')
        if (collectionEditor) {
            const editor = new JSONEditor(collectionEditor, options)
            editor.set(data)
        }
    }

    (async function() {
        try {
            const response = await axios.get(base_url('ajax/teams/all'), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            })
            const members = response.data.data
            setEditorData(members)
        } catch (error) {
            console.log(error)
        }
    })()
})
