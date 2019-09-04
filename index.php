<!DOCTYYPE html>

<html>
  <head>
    <title>Chunking Upload Demo</title>
    <script src="vendor/moxiecode/plupload/js/plupload.full.min.js"></script>
    <script>

window.addEventListener("load", function () {
    var path = "vendor/moxiecode/plupload/js/`";
    var uploader = new plupload.Uploader({
          runtimes: 'html5,flash,silverlight,html4',
          // flash_swf_url: path + 'Moxie.swf',
          // silverlight_xap_url: path + '/Moxie.xap',
          browse_button: 'pickfiles',
          container: document.getElementById('container'),
          url: 'uploader.php',
          chunk_size: '1000kb',
          max_retries: 2,
          filters: {
            max_file_size: '100mb',
            mime_types: [{title: "SCOs", extensions: "zip"}]
          },
          init: {
        PostInit: function () {
            document.getElementById('filelist').innerHTML = '';
        },
        FilesAdded: function (up, files) {
            plupload.each(files, function (file) {
                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });



            uploader.start();
        },
        UploadProgress: function (up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
        },
        Error: function (up, err) {
            console.log(err);
        }
    },
        multipart_params : {
            "name1" : "value1",
            "name2" : "value2"
        }
        });
        uploader.init();
      });
    </script>
  </head>
  <body>
    <div id="container">
      <span id="pickfiles">[Upload files]</span>
    </div>
    <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
  </body>
</html>