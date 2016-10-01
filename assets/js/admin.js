var translations_options = {
  valueNames: [ 'trl_key', 'trl_en', 'trl_fr', 'trl_es' ],
  page: 3,
  plugins: [
    ListPagination({})
  ]
};

var translationList = new List('translations', translations_options);

var autolist = new AutoList();
var editor = new MediumEditor('.trl_value', {
  buttonLabels: 'fontawesome',
  toolbar: {
    buttons: ['bold', 'italic', 'underline', 'anchor']
  },
  paste: {
    forcePlainText: false,
    cleanPastedHTML: true
  },
  extensions: {
    'autolist': autolist
  }
});

editor.subscribe('blur', function (event, editable) {
    vNotify.success({text: editable.innerHTML.trim(), title:editable.getAttribute("data-key-id")+" / "+editable.getAttribute("data-lng")});
});
