function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-upload-wrap').hide();
            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();
            $('.image-title').html(input.files[0].name);

            // Mettez à jour l'input caché avec les données de l'image en base64
            $('#image_data').val(e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        removeUpload();
    }
}

function removeUpload() {
$('.file-upload-input').replaceWith($('.file-upload-input').clone());
$('.file-upload-content').hide();
$('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
$('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function () {
$('.image-upload-wrap').removeClass('image-dropping');
});

// Ajoutez ceci à votre fichier main.js

document.querySelector('.share-image').addEventListener('mouseenter', function() {
    document.querySelector('.share-menu').style.display = 'flex';
  });
  
  document.querySelector('.share-menu').addEventListener('mouseleave', function() {
    document.querySelector('.share-menu').style.display = 'none';
  });
  
  // Vous pouvez également ajouter des liens réels pour le partage dans les écouteurs d'événements ci-dessous
  
document.querySelector('.share-facebook').addEventListener('click', function() {
    // Utilisez html2canvas pour capturer le contenu de la page
    html2canvas(document.body).then(function(canvas) {
        // Convertissez le canvas en une URL de données
        var imageData = canvas.toDataURL('image/png');

        // Partagez l'image sur Facebook en utilisant l'API Graph
        FB.api('/me/photos', 'POST', {
            url: imageData,
            caption: 'Description de l\'image'
        }, function(response) {
            if (response && !response.error) {
                alert('Image partagée sur Facebook avec succès');
            } else {
                alert('Erreur lors du partage sur Facebook');
            }
        });
    });
});
  
document.querySelector('.share-mail').addEventListener('click', function() {
    var subject = "Capture d'écran";
    var body = "Veuillez trouver la capture d'écran en pièce jointe.";
    // Obtenez le canvas avec l'image capturée
    html2canvas(document.body).then(function(canvas) {
        // Convertissez le contenu du canvas en une URL de données
        var attachment = canvas.toDataURL("image/png");
        // Encodez l'image en base64 pour l'inclure dans le lien mailto
        attachment = attachment.replace(/^data:image\/(png|jpg);base64,/, "");
        // Construisez le lien mailto avec la pièce jointe
        var mailtoLink = "mailto:?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body) + "&attachment=" + attachment;
        // Ouvrez le client de messagerie par défaut avec le lien mailto
        window.location.href = mailtoLink;
    });
});

  
  document.querySelector('.share-telegram').addEventListener('click', function() {
  // Utilisez html2canvas pour capturer le contenu de la page
    html2canvas(document.body).then(function(canvas) {
        // Convertissez le canvas en une URL de données
        var imageData = canvas.toDataURL('image/png');

        // Créez le lien de partage sur Telegram avec l'URL de l'image
        var telegramLink = "https://t.me/share/url?url=" + encodeURIComponent(imageData);
        
        // Ouvrez le lien de partage sur Telegram dans une nouvelle fenêtre
        window.open(telegramLink, '_blank');
    });
  });

$(document).ready(function() {
    // Ajoutez un gestionnaire d'événements pour le formulaire
    $('form').submit(function (e) {
        e.preventDefault(); // Empêchez la soumission du formulaire par défaut

        // Envoyez les données du formulaire au serveur en utilisant Ajax
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                // Gérez la réponse du serveur si nécessaire
                alert(response);
                console.log(response);
            },
            error: function (error) {
                // Gérez les erreurs si elles existent
                alert(error);
                console.log(error);
            }
        });
    });
});
  

