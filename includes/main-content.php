<?php

function getMainContent($allContent, $user_search_query)
{
    echo " <div id='content'>
   <div class='product-container'>
       <div class='container'>
           <div class='row'>
         ";

    getPro($allContent, $user_search_query);

    echo "
           </div>
       </div>
   </div>
</div>

</div>
</div>
</div>";
}
