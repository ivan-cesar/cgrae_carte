<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Cgrae</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<style>
        body {
            margin: 0;
            padding:0;
        }
    </style>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<form action="{{ route('storeImage') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <input type="hidden" name="image_data" id="image_data" value="">
        <div style="margin:auto">
                    <img src="{{asset('CADRE-PHOTO-POST-CGRAE.png')}}" alt="" srcset="" style="width: 100%;">
        </div>
         @include('flashmessage')
         
        <div class="file-upload">
            <div class="image-upload-wrap">
              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
              <div class="drag-text">
                <h3>Glisser-déposer un fichier ou sélectionner Ajouter une image</h3>
              </div>
            </div>
            <div class="file-upload-content">
                <!-- Utilisez le body comme élément de capture -->
                <img class="file-upload-image" id="screenshot" src="#" alt="your image" />
              <div class="image-title-wrap">
                <button type="button" onclick="removeUpload()" class="remove-image"><i class="fa-solid fa-trash"></i></button>
                <button type="button"  class="download-image" onclick="downloadImage()"><i class="fa-solid fa-download"></i></button>
                <button class="share-image" id="shareButton"><i class="fa-solid fa-share-nodes"></i></button>
              </div>
            </div>
          </div>
</form>
<!-- Include the Facebook SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v18.0" nonce="Ufh5YZDI"></script>

<!-- Place the Facebook share button wherever you want on your page -->

<script src="{{asset('main.js')}}"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        // JavaScript code ici
        var shareButton = document.getElementById("shareButton");

        shareButton.addEventListener("click", function() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    text: 'Découvrez cette page intéressante!',
                    url: window.location.href
                })
                .then(() => console.log('Partage réussi'))
                .catch((error) => console.error('Erreur de partage', error));
            } else {
                alert("La fonction de partage n'est pas prise en charge sur ce navigateur.");
            }
        });
    </script>
<script>


function removeUpload() {
    $('#screenshot').attr('src', '#');
}

function downloadImage() {
    // Utilisez le body comme élément de capture
    html2canvas(document.body).then(function(canvas) {
        var link = document.createElement("a");
        document.body.appendChild(link);
        link.download = "screenshot.png";
        link.href = canvas.toDataURL("image/png");
        link.target = "_blank";
        link.click();
    });
}
</script>
</body>
</html>
