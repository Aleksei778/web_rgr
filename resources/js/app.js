import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', () => {
    const editorElements = document.querySelectorAll('.ckeditor');

    editorElements.forEach(element => {
        ClassicEditor
            .create(element, {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Параграф', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Заголовок 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Заголовок 2', class: 'ck-heading_heading2' }
                    ]
                }
            })
            .then(editor => {
                console.log('Editor initialized', editor);
            })
            .catch(error => {
                console.log('Error while init editor: ', error);
            })
    });
});