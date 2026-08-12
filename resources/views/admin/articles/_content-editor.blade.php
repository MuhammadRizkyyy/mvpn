@php
    $fieldId = $fieldId ?? 'content';
    $fieldName = $name ?? 'content';
    $editorValue = old($fieldName, $value ?? '');
@endphp

<div>
    <label for="{{ $fieldId }}" class="mb-1.5 block text-xs font-medium text-neutral-600">
        {{ $label ?? 'Isi Artikel' }}
        @if($help ?? null)
            <span class="font-normal text-neutral-400">{{ $help }}</span>
        @endif
    </label>

    <div class="overflow-hidden rounded-lg border border-neutral-300 focus-within:border-navy-500">
        <div id="{{ $fieldId }}-toolbar" class="border-b border-neutral-200 bg-neutral-50 !p-2">
            <span class="ql-formats">
                <select class="ql-header">
                    <option value="2">Heading</option>
                    <option value="3">Subheading</option>
                    <option selected>Normal</option>
                </select>
            </span>
            <span class="ql-formats">
                <button type="button" class="ql-bold"></button>
                <button type="button" class="ql-italic"></button>
                <button type="button" class="ql-underline"></button>
            </span>
            <span class="ql-formats">
                <button type="button" class="ql-blockquote"></button>
                <button type="button" class="ql-list" value="ordered"></button>
                <button type="button" class="ql-list" value="bullet"></button>
            </span>
            <span class="ql-formats">
                <button type="button" class="ql-link"></button>
                <button type="button" class="ql-clean"></button>
            </span>
        </div>
        <div id="{{ $fieldId }}-editor" style="min-height: {{ $minHeight ?? '220px' }};" class="bg-white text-sm"></div>
    </div>

    <textarea name="{{ $fieldName }}" id="{{ $fieldId }}" class="hidden">{{ $editorValue }}</textarea>
</div>

<style>
    #{{ $fieldId }}-editor.ql-container {
        min-height: {{ $minHeight ?? '220px' }};
    }
    #{{ $fieldId }}-editor .ql-editor {
        min-height: {{ $minHeight ?? '220px' }};
    }
</style>

<script>
(function () {
    function initEditor() {
        var textarea = document.getElementById('{{ $fieldId }}');
        var quill = new Quill('#{{ $fieldId }}-editor', {
            theme: 'snow',
            modules: { toolbar: '#{{ $fieldId }}-toolbar' },
        });

        if (textarea.value.trim()) {
            quill.clipboard.dangerouslyPasteHTML(textarea.value);
        }

        window.__quillEditors = window.__quillEditors || {};
        window.__quillEditors['{{ $fieldId }}'] = quill;

        var form = textarea.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                var html = quill.root.innerHTML;
                textarea.value = (html === '<p><br></p>') ? '' : html;
            });
        }
    }

    if (window.Quill) {
        initEditor();
        return;
    }

    if (!document.getElementById('quill-snow-css')) {
        var link = document.createElement('link');
        link.id = 'quill-snow-css';
        link.rel = 'stylesheet';
        link.href = '{{ asset('vendor/quill/quill.snow.css') }}';
        document.head.appendChild(link);
    }

    var existingScript = document.getElementById('quill-js');
    if (existingScript) {
        existingScript.addEventListener('load', initEditor);
        return;
    }

    var script = document.createElement('script');
    script.id = 'quill-js';
    script.src = '{{ asset('vendor/quill/quill.min.js') }}';
    script.onload = initEditor;
    document.head.appendChild(script);
})();
</script>
