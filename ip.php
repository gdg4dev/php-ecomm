    <div class="container">
 
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>
var url_string =window.location.href ; //window.location.href

if(url_string === location.protocol + '//' + location.host + location.pathname){
            var XHR = new XMLHttpRequest()
            
            XHR.onreadystatechange = function(){
                if(XHR.readyState === 4 && XHR.status === 200){
                    var data = JSON.parse(XHR.responseText)
                  $(".container").text(data.query)
                  window.location = "?ip=" + data.query
                }
            }
            
            XHR.open("GET", "http://ip-api.com/json/?fields=16510975&lang=en")
            XHR.send()
                }
           
    </script>
<?php 
if(isset($_GET['ip'])){
    $ip = $_GET['ip'];
   function getIp(){
       global $ip;
       echo $ip;
       return $ip;
   }

   getIp();

}

?>