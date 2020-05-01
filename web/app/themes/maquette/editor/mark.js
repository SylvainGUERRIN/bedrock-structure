(function () {
    tinymce.PluginManager.add('mark', function (editor, url) {
        editor.addButton('mark',{
            title: 'Surligner',
            cmd: 'mark',
            image: url + '/mark.svg'
        })
        editor.addCommand('mark', function () {
            let selected_text = editor.selection.getContent({
                'format': 'html'
            })
            let MatchMark = selected_text.match(/<\/?mark>/g)
            let html = selected_text
            if (MatchMark) {
                html = html.replace(/<\/?mark>/g, '')
            } else {
                html = `<mark>${html}</mark>`
            }
            editor.execCommand('mceReplaceContent', false, html)
        })
    })
})()
