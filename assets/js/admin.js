$(document).ready(function() {

  var translations_options = {
    valueNames: [ 'trl_key', 'trl_en', 'trl_fr', 'trl_es' ]
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

  $('.btn-save').on('click', function(e) {
    var node = $(this).parent().parent().find('.trl_value');
    var value = node.html().trim();
    var lang_id = node.attr('data-lng');
    var key_id = node.attr('data-key-id');

    $.ajax({
      type: "POST",
      url: "../assets/libs/ptms/ptms.php",
      data: { setTranslation: true, value: value, lang_id: lang_id, key_id: key_id },
      success: function(data) {
        var response = JSON.parse(data);
        console.log(response.status);
        if(response.status == true) {
          var nf = noty({ closeWith: ['click', 'backdrop'], layout: 'topRight', theme: 'relax', type: 'success', text: "Saved" });
        }else{
          var nf = noty({ closeWith: ['click', 'backdrop'], layout: 'topRight', theme: 'relax', type: 'error', text: response.error });
        }
      }
    })

  })

});
