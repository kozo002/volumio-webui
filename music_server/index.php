<!doctype html>
<html>
  <head lang="ja">
    <meta charset="utf-8" />
    <title>RasPi Music Server</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/falt-ui.css" />
    <link rel="stylesheet" href="css/panels.css">
    <script>
      document.addEventListener("DOMContentLoaded", function() {

        var SelectButton = (function() {
          function SelectButton(el) {
            this.el = el
            this.label = this.el.querySelector(".label");
          }

          SelectButton.prototype.disable = function() {
            this.el.setAttribute("class", this.el.getAttribute("class") + " disabled");
          }
          SelectButton.prototype.enable = function() {
            this.el.setAttribute("class", this.el.getAttribute("class").replace("disabled", ""));
          }
          SelectButton.prototype.selected = function() {
            this.label.setAttribute("class", this.label.getAttribute("class").replace("hide", ""));
          }
          SelectButton.prototype.deselected = function() {
            this.label.setAttribute("class", this.label.getAttribute("class") + " hide");
          }
          SelectButton.prototype.isSelected = function() {
            return !/hide/.test(this.label.getAttribute("class"))
          }

          return SelectButton;
        })();

        var apiRequest = function(path, callback) {
          request.open("POST", location.origin +  path, true);
          request.addEventListener("readystatechange", function(e) {
            if (request.readyState === 4) {
              callback(e)
            }
          });
          request.send();
        };

        var selectInput = document.querySelector(".select-input");
        var buttons = [].map.call(selectInput.querySelectorAll(".btn"), function(btn) { return btn });
        var apiPaths = [
          "/music_server/usb_dac.php",
          "/music_server/rca.php",
          "/music_server/audio_mini_jack.php"
        ];

        buttons.map(function(btn, index) {
          btn.addEventListener("click", function(e) {
            e.preventDefault();
            var selectButton = new SelectButton(btn);
            var apiPath = apiPaths[index];

            apiRequest(apiPath, function(e) {
              console.log(e)
            })
          });
        });

      });
    </script>
  </head>
  <body>
    <div class="container">
      <h1>RasPi Music Server</h1>

      <h4>Select Input</h4>
      <ul class="select-input">
        <li>
          <a href="#" class="btn btn-default btn-large">
            USB DAC
            <span class="label label-success hide">SELECTED</span>
          </a>
          <br/>
          <br/>
        </li>
        <li>
          <a href="#" class="btn btn-default btn-large">
            RCA
            <span class="label label-success hide">SELECTED</span>
          </a>
          <br/>
          <br/>
        </li>
        <li>
          <a href="#" class="btn btn-default btn-large">
            オーディオミニジャック
            <span class="label label-success hide">SELECTED</span>
          </a>
        </li>
      </ul>
    </div>
  </body>
</html>
